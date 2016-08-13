<?php

namespace lib\auth;

use \lib\App;

class Provider
{
	protected $app;
	protected $cfg;
	protected $provider;
	public $identity = FALSE;

	protected $cipher = MCRYPT_RIJNDAEL_128;
	protected $mode = MCRYPT_MODE_CBC;
	protected $key;

	public function __construct(App $app, $cfg, $name = NULL) {
		$this->app = $app;

		if (!isset($cfg->provider)) {
	      throw new \Exception('Security provider is Required');
	    }

		if (!isset($cfg->secret)) {
	      throw new \Exception('A secret is Required');
	    }

		if (empty($name) || $name == 'dmxSiteSecurity') {
			$name = 'dmxSecurity';
		}

		if (!isset($cfg->path)) {
			$cfg->path = '/';
		}

		if (!isset($cfg->expires)) {
			$cfg->expires = 30;
		}

		$cfg->httpOnly = TRUE;
		$cfg->name = $name;

		$providerClass = '\\lib\\auth\\' . ucfirst($cfg->provider) . 'Provider';

		$this->cfg = $cfg;
		$this->provider = new $providerClass($this->app, $cfg);
		$this->identity = $this->app->session->get($this->cfg->name . 'Id');

		$this->key = hash('sha256', $cfg->secret, TRUE);

		if (!$this->identity && isset($this->app->request->cookies[$cfg->name])) {
			$credentials = $this->readCookie();
			$this->login($credentials[0], $credentials[1], TRUE, TRUE);
		}
	}

	public function setIdentity($identity = FALSE) {
		$this->identity = $identity;
		$this->app->session->set($this->cfg->name . 'Id', $identity);

		if (!$identity) {
			$this->app->session->remove($this->cfg->name . 'Id');
			$this->app->response->clearCookie($this->cfg->name, $this->cfg);
		}
	}

	public function readCookie() {
		if (!isset($this->app->request->cookies[$this->cfg->name])) {
			return FALSE;
		}

		$data = base64_decode($this->app->request->cookies[$this->cfg->name]);
		$iv = substr($data, 0, 16);

		return explode($iv, str_replace("\0", '', mcrypt_decrypt($this->cipher, $this->key, substr($data, 16), $this->mode, $iv)));
	}

	public function writeCookie($username, $password) {
		srand((double) microtime() * 1000000);

		$iv = mcrypt_create_iv(mcrypt_get_iv_size($this->cipher, $this->mode), MCRYPT_RAND);
		$data = base64_encode($iv . mcrypt_encrypt($this->cipher, $this->key, implode($iv, array($username, $password)), $this->mode, $iv));

		$this->app->response->setCookie($this->cfg->name, $data, $this->cfg);
	}

	public function login($username, $password, $remember = FALSE, $autologin = FALSE) {
		$identity = $this->provider->validate($username, $password);

		if (!$autologin && !$identity) {
			$this->app->response->end(401);
		}

		$this->setIdentity($identity);

		if ($identity && $remember) {
			$this->writeCookie($username, $password);
		}

		return $this->identity;
	}

	public function logout() {
		$this->setIdentity();
	}

	public function restrict($opts) {
		if (!$this->identity) {
			if (isset($opts->loginUrl) && !empty($opts->loginUrl)) {
				header('Location: ' . $opts->loginUrl);
				die();
			} else {
				$this->app->response->end(401);
			}
		}

		if (isset($opts->permissions) && !empty($opts->permissions)) {
			$opts->permissions = is_array($opts->permissions) ? $opts->permissions : array($opts->permissions);
			if (!$this->provider->permissions($this->identity, $opts->permissions)) {
				if (isset($opts->forbiddenUrl) && !empty($opts->forbiddenUrl)) {
					header('Location: ' . $opts->forbiddenUrl);
					die();
				} else {
					$this->app->response->end(403);
				}
			}
		}
	}
}
