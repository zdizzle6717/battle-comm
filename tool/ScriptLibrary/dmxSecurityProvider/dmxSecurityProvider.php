<?php
/*
 DMXzone Security Provider
 Version: 1.1.0
 (c) 2013-2014 DMXzone.com
*/

if (session_id() == '') {
    session_start();
}

function _session($name) {
	if (isset($_SESSION[$name])) {
		return $_SESSION[$name];
	}

	return NULL;
}

function _request($name) {
	if (isset($_POST[$name])) {
		return $_POST[$name];
	} elseif (isset($_GET[$name])) {
		return $_GET[$name];
	}

	return NULL;
}

class SecurityCookie
{
	private $key;
	private $cfg;

	public function __construct($cfg) {
		if (!isset($cfg->secret)) exit('NO SECRET SET!');
		if (!isset($cfg->name)) $cfg->name = 'dmxSecurity';
		if (!isset($cfg->domain)) $cfg->domain = NULL;
		if (!isset($cfg->path)) $cfg->path = '/';
		if (!isset($cfg->expire)) $cfg->expire = 30;

		$this->key = hash('sha256', $cfg->secret, TRUE);

		$this->cfg = $cfg;
	}

	public function exists() {
		return isset($_COOKIE[$this->cfg->name]);
	}

	public function read() {
		if ($this->exists()) {
			$encrypted = base64_decode($_COOKIE[$this->cfg->name]);
			$iv = substr($encrypted, 0, 16);
			return explode($iv, str_replace("\0", "", mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, substr($encrypted, 16), MCRYPT_MODE_CBC, $iv)));
		}

		return NULL;
	}

	public function write($value) {
		srand((double) microtime() * 1000000);
		$value = is_array($value) ? $value : array($value);
		$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
		$encrypted = $iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, implode($iv, $value), MCRYPT_MODE_CBC, $iv);
		$this->setcookie(base64_encode($encrypted), $this->cfg->expire);
	}

	public function clear() {
		if ($this->exists()) {
			$this->setcookie(FALSE, -1);
		}
	}

	private function setCookie($value, $expire) {
		setcookie($this->cfg->name, $value, strtotime($expire . ' days'), $this->cfg->path, $this->cfg->domain, 0, 1);
	}
}

function SecurityProvider($cfg) {
	return new SecurityProvider($cfg);
}

class SecurityProvider
{
	private $provider;
	private $cookie;
	private $identity;

	public function __construct($cfg) {
		$cfg = json_decode($cfg);

		$providerClass = $cfg->provider.'SecurityProvider';

		$this->provider = new $providerClass($cfg);
		$this->cookie = new SecurityCookie($cfg);
		$this->setIdentity(_session('dmxSecurityId'));

		if (!$this->identity && $this->cookie->exists()) {
			list($username, $password) = $this->cookie->read();
			$this->login($username, $password, TRUE);
		}

		switch (_request('action')) {
			case 'login':
				$this->login(_request('username'), _request('password'), _request('remember'));
			case 'validate':
				if ($this->identity) $this->output((object)array(
					'identity' => $this->identity
				));
				else $this->unauthorized();
				break;

			case 'logout':
				$this->logout();
				exit();
				break;
		}
	}

	public function login($username, $password, $remember = FALSE) {
		$this->setIdentity($this->provider->validate($username, $password));

		if ($this->identity && $remember) {
			$this->cookie->write(array($username, $password));
		}
	}

	public function logout() {
		$this->setIdentity(FALSE);
	}

	public function restrict($opts = array()) {
		if (is_string($opts) && $opts[0] == '{') {
			$opts = json_decode($opts);
		} else {
			$opts = (object)array('permissions' => $opts);
		}
		if (!$this->identity) $this->login(_request('username'), _request('password'));
		if (!$this->identity) $this->unauthorized($opts->loginUrl);
		if ($opts->permissions) {
			$opts->permissions = is_array($opts->permissions) ? $opts->permissions : array($opts->permissions);
			if (!$this->provider->permissions($this->identity, $opts->permissions)) $this->forbidden($opts->forbiddenUrl);
		}
	}

	private function setIdentity($id) {
		if ($id) {
			$_SESSION['dmxSecurityId'] = $this->identity = $id;
		} else {
			$this->identity = FALSE;
			$this->cookie->clear();
			unset($_SESSION['dmxSecurityId']);
		}
	}

	private function unauthorized($loginUrl = NULL)	 {
		if ($loginUrl) {
			header('Location: ' . $loginUrl);
			exit();
		}
		header($_SERVER["SERVER_PROTOCOL"] . ' 401 Unauthorized');
		exit('Unauthorized');
	}

	private function forbidden($forbiddenUrl = NULL)	 {
		if ($forbiddenUrl) {
			header('Location: ' . $forbiddenUrl);
			exit();
		}
		header($_SERVER["SERVER_PROTOCOL"] . ' 403 Forbidden');
		exit('Forbidden');
	}

	private function output($obj) {
		header('Content-type: application/json; charset=utf-8');
		exit(json_encode($obj));
	}
}

class SingleSecurityProvider
{
	private $username;
	private $password;

	public function __construct($cfg) {
		$this->username = $cfg->username;
		$this->password = $cfg->password;
	}

	public function validate($username, $password) {
		if ($username == $this->username && $password == $this->password) {
			return $username;
		}

		return FALSE;
	}

	public function permissions($identity, $permissions) {
		return TRUE;
	}
}

class StaticSecurityProvider
{
	private $users;
	private $permissions;

	public function __construct($cfg) {
		$this->users = $cfg->users;
		$this->permissions = $cfg->permissions;
	}

	public function validate($username, $password) {
		if (isset($this->users->$username) && $this->users->$username == $password) {
			return $username;
		}

		return FALSE;
	}

	public function permissions($identity, $permissions) {
		foreach ($permissions as $permission) {
			if (!in_array($identity, $this->permissions->$permission)) return FALSE;
		}

		return TRUE;
	}
}

?>