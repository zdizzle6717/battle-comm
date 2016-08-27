<?php
/*
 DMXzone Database Connector
 Version: 1.2.0
 (c) 2013-2014 DMXzone.com
*/

define('E_FATAL', E_ERROR | E_USER_ERROR | E_PARSE | E_CORE_ERROR | E_COMPILE_ERROR | E_RECOVERABLE_ERROR);

error_reporting(0);
ini_set('default_charset','utf-8');
ini_set('display_errors', 0);
set_error_handler('error_handler');
set_exception_handler('exception_handler');
register_shutdown_function('fatal_handler');

class Error
{
	public $code = 0;
	public $message = '';
	public $file = '';
	public $line = 0;
	public $trace = NULL;

	static public $warnings = array();

	static public function register($code, $message, $file, $line, $trace = NULL, $fatal = FALSE) {
		$error = new Error($code, $message, $file, $line, $trace);

		if ($fatal || $code & E_FATAL) {
			header($_SERVER["SERVER_PROTOCOL"] . ' 500 Internal Server Error');
			header('Content-type: application/json; charset=utf-8');
			exit($error);
		}

		array_push(self::$warnings, $error);
	}

	public function __construct($code, $message, $file, $line, $trace = NULL) {
		$this->code = $code;
		$this->message = $message;
		$this->file = $file;
		$this->line = $line;
		$this->trace = $trace;
	}

	public function __toString() {
		global $dmxConnectionDebug;

		if ($dmxConnectionDebug === TRUE) {
			$obj = clone $this;
			$obj->warnings = Error::$warnings;
			return json_encode($obj);
		}

		return $this->message;
	}
}

function error_handler($errNo, $errStr, $errFile, $errLine) {
	Error::register($errNo, $errStr, $errFile, $errLine);
	return TRUE;
}

function exception_handler($e) {
	Error::register($e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine(), $e->getTrace() , TRUE);
}

function fatal_handler() {
	$error = error_get_last();
	if($error && ($error['type'] & E_FATAL)) {
		Error::register($error["type"], $error["message"], $error["file"], $error["line"]);
	}
}

function date_from_format($format, $string) {
	$tokens = str_split($format);
	$result = '';
	$p = 0;

	$year = 1900;
	$month = 1;
	$day = 1;
	$hour = 0;
	$minutes = 0;
	$seconds = 0;

	$skip = FALSE;
	foreach ($tokens as $token) {
		if ($skip) {
			$skip = FALSE;
			$p += 1;
			continue;
		}

		switch ($token) {
			case 'Y':
				$year = (int)substr($string, $p, 4);
				$p += 4;
				break;
			case 'm':
				$month = (int)substr($string, $p, 2);
				$p += 2;
				break;
			case 'd':
				$day = (int)substr($string, $p, 2);
				$p += 2;
				break;
			case 'H':
				$hour = (int)substr($string, $p, 2);
				$p += 2;
				break;
			case 'i':
				$minutes = (int)substr($string, $p, 2);
				$p += 2;
				break;
			case 's':
				$seconds = (int)substr($string, $p, 2);
				$p += 2;
				break;
			case '\\':
				// skip next
				$skip = TRUE;
				break;
			default:
				// skip
				$p += 1;
				break;
		}
	}

	$result = new DateTime();
	$result->setDate($year, $month, $day);
	$result->setTime($hour, $minutes, $seconds);

	return $result;
}

class Adapter
{
	public $typesMap = NULL;

	public $LikeFormat = array(
		'starts with'     => "%s LIKE (%s || '%%') ESCAPE '!'",
		'not starts with' => "%s NOT LIKE (%s || '%%') ESCAPE '!'",
		'ends with'       => "%s LIKE ('%%' || %s) ESCAPE '!'",
		'not ends with'   => "%s NOT LIKE ('%%' || %s) ESCAPE '!'",
		'contains'        => "%s LIKE ('%%' || %s || '%%') ESCAPE '!'",
		'not contains'    => "%s NOT LIKE ('%%' || %s || '%%') ESCAPE '!'"
	);

	public function getIdentifierQuoteCharacter() {
		return '"';
	}

	public function getVarcharMaxLength() {
		return 4000;
	}

	public function getVarcharDefaultLength() {
		return 255;
	}

	public function getDateTimeFormatString() {
		return 'Y-m-d H:i:s';
	}

	public function getDateTimeTzFormatString()
	{
		return 'Y-m-d H:i:s';
	}

	public function getDateFormatString() {
		return 'Y-m-d';
	}

	public function getTimeFormatString() {
		return 'H:i:s';
	}

	public function getWildcards() {
		return array('%', '_');
	}

	public function getConcatExpression() {
		return join(' || ', func_get_args());
	}

	public function escapeLikeValue($str) {
		return preg_replace('/[!%_]/i', '!$0', $str);
	}

	public function quoteIdentifier($str) {
		if ($str == '*') return '*';

		$c = $this->getIdentifierQuoteCharacter();

		return $c . str_replace($c, $c.$c, $str) . $c;
	}

	public function modifyLimitQuery($query, $limit, $offset = NULL) {
		if ($limit !== NULL) {
			$limit = (int)$limit;
		}

		if ($offset !== NULL) {
			$offset = (int)$offset;
		}

		return $this->doModifyLimitQuery($query, $limit, $offset);
	}

	protected function doModifyLimitQuery($query, $limit, $offset) {
		if ($limit !== NULL) {
			$query .= ' LIMIT ' . $limit;
		}

		if ($offset !== NULL) {
			$query .= ' OFFSET ' . $offset;
		}

		return $query;
	}
}

function SqlBuilder($cfg) {
	global $adapter;
	//$SqlBuilder = 'SqlBuilder_'.$adapter;
	$SqlBuilder = 'SqlBuilder';
	return new $SqlBuilder($cfg, $adapter);
}

class SqlBuilder
{
	public $type = 'select';
	public $table = '';
	public $joins = array();
	public $values = array();
	public $wheres = array();
	public $orders = array();
	public $columns = array();
	public $params = array();
	public $sortables = array();
	public $offset = 0;
	public $limit = 1000;

	public $meta;

	public $adapter = NULL;

	public function __construct($cfg, $adapter = NULL) {
		global $dmxConnectionMeta;

		if (isset($cfg)) {
			$cfg = trim($cfg);
			if (substr($cfg, 0, 1) == '{') {
				$this->parseConfig($cfg);
			} else {
				$this->table = $cfg;
			}
		}

		if (isset($dmxConnectionMeta)) {
			$this->meta = json_decode($dmxConnectionMeta);

			if ($this->meta === NULL) {
				throw new Exception('Error parsing meta data!');
			}
		}

		$adapterClass = "Adapter";
		if ($adapter) {
			$adapterClass = "Adapter_$adapter";
		}

		$this->adapter = new $adapterClass();
	}

	public function reset() {
		$this->joins = array();
		$this->values = array();
		$this->wheres = array();
		$this->orders = array();
		$this->columns = array();
		$this->params = array();
		$this->sortables = array();
	}

	public function parseConfig($cfg) {
		$this->reset();

		$cfg = json_decode($cfg);

		if ($cfg === NULL) {
			throw new Exception('Error parsing config!');
		}

		foreach ($cfg as $key => $value) {
			$this->$key = $value;
		}
	}

	public function select($select = NULL) {
		$this->type = 'select';

		if (empty($select)) {
			return $this;
		}

		$selects = is_array($select) ? $select : func_get_args();

		array_push($this->columns, $selects);

		return $this;
	}

	public function from($table = NULL) {
		if (!isset($table)) return $this->table;
		$this->table = $table;
		return $this;
	}

	public function join($table, $column, $operator, $value, $type = 'INNER') {
		array_push($this->joins, (object)array(
			'table'    => $table,
			'column'   => $column,
			'operator' => $operator,
			'value'    => $value,
			'type'     => $type
		));

		return $this;
	}

	public function where($column, $operator, $value = NULL, $bool = 'AND') {
		array_push($this->wheres, (object)array(
			'table'    => (isset($column->table) ? $column->table : $this->table),
			'column'   => (isset($column->column) ? $column->column : $column),
			'operator' => (is_null($value) ? '=' : $operator),
			'value'    => (is_null($value) ? $operator : $value),
			'bool'     => $bool
		));

		return $this;
	}

	public function andWhere($column, $operator, $value) {
		return $this->where($column, $operator, $value);
	}

	public function orWhere($column, $operator, $value) {
		return $this->where($column, $operator, $value, 'OR');
	}

	public function orderBy($sort, $order = 'ASC') {
		array_push($this->orders, (object)array(
			'column'    => $sort,
			'direction' => $order
		));

		return $this;
	}

	public function toString() {
		if (isset($this->sql)) return $this->sql;
		return $this->toSQL();
	}

	public function __toString() {
		return $this->toString();
	}

	public function toSQL() {
		$this->sql = $this->{'compile'.ucfirst($this->type)}();
		return $this->sql;
	}

	// helper functions

	protected function filterSortables($var) {
		return isset($var->sortable) && $var->sortable;
	}

	protected function filterOrders($var) {
		$key = (isset($var->table) ? $var->table : $this->table)
			 . '.'
			 . (isset($var->column) ? $var->column : $var);

		if (isset($this->ordersCheck[$key])) return FALSE;
		$this->ordersCheck[$key] = TRUE;
		return TRUE;
	}

	protected function escape($value) {
		if (is_numeric($value)) return $value;

		if (preg_match('/\s+AS\s+/i', $value)) {
			$segments = preg_split('/\s+AS\s+/i', $value);
			return $this->escape($segments[0]) . ' AS ' . $this->escape($segments[1]);
		}

		return implode('.', array_map(array(&$this->adapter, 'quoteIdentifier'), explode('.', $value)));
	}

	protected function parseColumn($obj) {
		if (is_string($obj)) return $obj;
		if (isset($obj->alias)) {
			if (!is_string($obj->alias) || $obj->alias === '') {
				unset($obj->alias);
			}
		}
		return (isset($obj->table) ? $obj->table.'.' : '') . $obj->column . (isset($obj->alias) ? ' AS '.$obj->alias : '');
	}

	protected function columnize($columns) {
		return implode(', ', array_map(array(&$this, 'column'), $columns));
	}

	protected function column($column) {
		return $this->escape($this->parseColumn($column));
	}

	protected function parameterize($obj) {
		$obj->value = getParamValue($obj->value);
		if (!is_array($obj->value)) $obj->value = array($obj->value);
		$values = array_fill(0, count($obj->value), $obj);
		return implode(', ', array_map(array(&$this, 'parameter'), $values, array_keys($values)));
	}

	protected function parameter($obj, $index = NULL) {
		if (isset($obj->value->column)) {
			return $this->column($obj->value);
		}

		if (!isset($obj->table)) $obj->table = $this->table;

		$param = clone $obj;

		if (property_exists($this->meta, 'tables')) {
			if (property_exists($this->meta->tables, $param->table)) {
				$meta = $this->meta->tables->{$param->table}->columns->{$param->column};
				if (isset($meta->type)) $param->type = $meta->type;
				if (isset($meta->size)) $param->size = $meta->size;
			}
		} elseif (property_exists($this->meta, $param->table)) {
			if (property_exists($this->meta->{$param->table}, $param->column)) {
				$meta = $this->meta->{$param->table}->{$param->column};
				if (isset($meta->type)) $param->type = $meta->type;
				if (isset($meta->size)) $param->size = $meta->size;
			}
		}

		if (isset($this->adapter->typeMapping[$param->type])) {
			$param->type = $this->adapter->typeMapping[$param->type];
		}

		if (isset($index)) {
			$param->value = $param->value[$index];
		}

		array_push($this->params, $param);

		return '?';
	}

	protected function result($obj, $prop) {
		return @$obj->$prop;
	}

	// compile functions

	public function compileCount() {
		$this->params = array();
		$components = array('from','joins','wheres');
		return 'SELECT COUNT(*) AS total ' . implode(' ', array_map(array(&$this, 'compileComponent'), $components));
	}

	public function compileSelect() {
		$components = array('columns','from','joins','wheres','orders');

		$this->params = array();
		if (count($this->columns) == 0) $this->columns = array('*');

		return $this->adapter->modifyLimitQuery(
			implode(' ', array_map(array(&$this, 'compileComponent'), $components)),
			$this->limit,
			$this->offset
		);
	}

	protected function compileComponent($component) {
		$result = method_exists($this, $component) ? $this->$component() : @$this->$component;
		return $this->{'compile'.ucfirst($component)}($result);
	}

	protected function compileColumns($columns) {
		return 'SELECT ' . $this->columnize($columns);
	}

	protected function compileFrom($table) {
		return 'FROM ' . $this->escape($table);
	}

	protected function compileJoins($joins) {
		return implode(' ', array_map(array(&$this, 'compileJoin'), $joins));
	}

	protected function compileJoin($join) {
		return strtoupper($join->type) . ' JOIN ' . $this->escape($join->table) . ' ON ' . preg_replace('/^(AND|OR)\s*/i', '', implode(' ', array_map(array(&$this, 'compileWhere'), $join->clauses)));
	}

	protected function compileWheres($wheres) {
		if (count($wheres) > 0) {
			return 'WHERE ' . preg_replace('/^(AND|OR)\s*/i', '', implode(' ', array_map(array(&$this, 'compileWhere'), $wheres)));
		}
	}

	protected function compileWhere($where) {
		$operators = array(
			'=' => 'Basic', '<>' => 'Basic',
			'<' => 'Basic', '>' => 'Basic',
			'<=' => 'Basic', '>=' => 'Basic',
			'in' => 'In', 'not in' => 'In',
			'is null' => 'Null', 'is not null' => 'Null',
			'starts with' => 'Like', 'not starts with' => 'Like',
			'ends with' => 'Like', 'not ends with' => 'Like',
			'contains' => 'Like', 'not contains' => 'Like',
			'between' => 'Between'
		);

		$where->whereType = $operators[$where->operator];

		return strtoupper(isset($where->bool) ? $where->bool : 'AND') . ' ' . $this->{'compileWhere'.$where->whereType}($where);
	}

	protected function compileWhereBasic($where) {
		return $this->column($where) . ' ' . $where->operator . ' ' . $this->parameter($where);
	}

	protected function compileWhereBetween($where) {
		return $this->column($where) . ' BETWEEN ' . $this->parameter($where, 0) . ' AND ' . $this->parameter($where, 1);
	}

	protected function compileWhereIn($where) {
		return $this->column($where) . ' ' . strtoupper($where->operator) . ' (' . $this->parameterize($where) . ')';
	}

	protected function compileWhereNull($where) {
		return $this->column($where) . ' ' . strtoupper($where->operator);
	}

	protected function compileWhereLike($where) {
		return sprintf($this->adapter->LikeFormat[$where->operator], $this->column($where), $this->parameter($where));
	}

	protected function compileOrders($orders) {
		$sortables = array_filter($this->columns, array(&$this, 'filterSortables'));

		if (isset($_GET['sort'])) {
			$sort = $_GET['sort'];
			$dir = isset($_GET['dir']) && strtoupper($_GET['dir']) == 'DESC' ? 'DESC' : 'ASC';

			if ($sort != '') {
				foreach ($sortables as $sortable) {
					if ((isset($sortable->alias) && $sortable->alias == $sort) || $sortable->column == $sort) {
						$sortable->direction = $dir;
						array_unshift($orders, $sortable);
					}
				}
			}
		}

		$this->ordersCheck = array();
		$orders = array_filter($orders, array(&$this, 'filterOrders'));

		if (count($orders) > 0) {
			return 'ORDER BY ' . implode(', ', array_map(array(&$this, 'compileOrder'), $orders));
		}
	}

	protected function compileOrder($order) {
		unset($order->alias);
		return $this->column($order) . (isset($order->direction) ? ' ' . $order->direction : '');
	}
}

class SqlConnection
{
	private $offset = 0;
	private $limit = 1000;

	public function __construct() {
		global $dmxConnectionLimit;

		$this->setLimit($dmxConnectionLimit);

		if (isset($_GET['offset'])) $this->setOffset($_GET['offset']);
		if (isset($_GET['limit'])) $this->setLimit($_GET['limit']);
	}

	public function setOffset($offset) {
		$offset = intval($offset, 10);
		if (is_finite($offset) && $offset >= 0) {
			$this->offset = $offset;
		}
	}

	public function setLimit($limit) {
		$limit = intval($limit, 10);
		if (is_finite($limit) && $limit > 0) {
			$this->limit = $limit;
		}
	}

	public function getParamValue($obj) {
		if (is_object($obj)) {
			$value = $obj->value;
			$required = isset($obj->required) ? (bool)$obj->required : FALSE;
			$default = isset($obj->default) ? $obj->default : NULL;

			switch ($obj->from) {
				case 'form':
					$value = isset($_POST[$obj->value]) ? $_POST[$obj->value] : (isset($_GET[$obj->value]) ? $_GET[$obj->value] : $default);
					break;
				case 'url':
					$value = isset($_GET[$obj->value]) ? $_GET[$obj->value] : $default;
					break;
				case 'cookie':
					$value = isset($_COOKIE[$obj->value]) ? $_COOKIE[$obj->value] : $default;
					break;
				case 'session':
					if(session_id() == '' || !isset($_SESSION)) {
 			   		// session isn't started
					    session_start();
					}
					$value = isset($_SESSION[$obj->value]) ? $_SESSION[$obj->value] : $default;
					break;
			}

			if ($value == '') {
				$value = $default;
			}

			if ($required && ($value == '' || $value === NULL)) {
				header($_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request');
				header('Content-type: application/json; charset=utf-8');
				exit(json_encode((object)array(
					'message' => 'Parameter ' . $obj->value . ' is required!'
				)));
			}

			return $value;
		}

		return $obj;
	}

	public function getBindingType(Adapter $adapter, $type = NULL) {
		if (isset($type)) {
			switch ($type) {
				case 'boolean':
					return PDO::PARAM_BOOL;
				case 'smallint':
				case 'integer':
					return PDO::PARAM_INT;
			}
		}

		return PDO::PARAM_STR;
	}

	public function convertToDatabaseValue(Adapter $adapter, $value, $type = NULL) {
		if ($value === NULL) return NULL;

		if (isset($type)) {
			switch ($type) {
				case 'array':
				case 'object':
					return serialize($value);
				case 'boolean':
					return (bool)$value;
				case 'date':
					$date = new DateTime($value);
					return $date->format($adapter->getDateFormatString());
				case 'time':
					$date = new DateTime($value);
					return $date->format($adapter->getTimeFormatString());
				case 'datetime':
					$date = new DateTime($value);
					return $date->format($adapter->getDateTimeFormatString());
				case 'datetimetz':
					$date = new DateTime($value);
					return $date->format($adapter->getDateTimeTzFormatString());
				case 'smallint':
				case 'integer':
					return (int)$value;
			}
		}

		return $value;
	}

	public function convertToPHPValue(Adapter $adapter, $value, $type = NULL) {
		if ($value === NULL) return NULL;

		if (isset($type)) {
			switch ($type) {
				case 'array':
				case 'object':
					return unserialize($value);
				case 'boolean':
					return (bool)$value;
				case 'date':
					$date = date_from_format($adapter->getDateFormatString(), $value);
					return $date ? $date->format('Y-m-d') : $value;
				case 'time':
					$date = date_from_format($adapter->getTimeFormatString(), $value);
					return $date ? $date->format('H:i:s') : $value;
				case 'datetime':
					$date = date_from_format($adapter->getDateTimeFormatString(), $value);
					return $date ? $date->format('Y-m-d\TH:i:s') : $value;
				case 'datetimetz':
					$date = date_from_format($adapter->getDateTimeTzFormatString(), $value);
					return $date ? $date->format('Y-m-d\TH:i:sP') : $value;
				case 'smallint':
				case 'integer':
					return (int)$value;
				case 'float':
					return (double)$value;
			}
		}

		return $value;
	}

	public function open($dsn = NULL, $user = NULL, $password = NULL) {
		global $adapter, $dmxConnectionString, $dmxConnectionLimit, $paramMap;

		if (is_null($dsn)) {
			$dsn = $dmxConnectionString;
		}

		if (preg_match("/user=([^;]*)/i", $dsn, $match)) {
			$user = $match[1];
		}

		if (preg_match("/password=([^;]*)/i", $dsn, $match)) {
			$password = $match[1];
		}

		if (!preg_match('/^pgsql:/', $dsn)) {
			$dsn = preg_replace("/(user|password)=[^;]*;?/i", '', $dsn);
		}

		if (preg_match('/^mysql:/', $dsn)) {
			$options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
		}

		$this->pdo = new PDO($dsn, $user, $password, $options);
		$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

	public function execute($sql, $output = FALSE) {
		global $dmxConnectionDebug;

		$this->sql = $sql;

		if (!isset($this->pdo)) {
			$this->open();
		}

		$result = $this->{'execute'.ucfirst($sql->type)}($sql);

		if ($dmxConnectionDebug) {
			$result->debug = $sql;
		}

		if ($output) {
			$this->writeJSON($result);
		}

		return $result->data;
	}

	protected function executeSelect($sql) {
		$sql->limit = $this->limit;
		$sql->offset = $this->offset;

		$statement = $this->pdo->prepare($sql->compileCount());

		foreach ($sql->params as $key => $param) {
			if ($param->whereType == 'Like') {
				$param->bindValue = $sql->adapter->escapeLikeValue(strval($this->getParamValue($param->value)));
			} else {
				$param->bindValue = $this->convertToDatabaseValue($sql->adapter, $this->getParamValue($param->value), $param->type);
			}
			$param->bindType = $this->getBindingType($sql->adapter, $param->type);
			$statement->bindParam($key + 1, $param->bindValue, $param->bindType);
		}

		$statement->execute();

		$total = (int)$statement->fetchColumn();

		$statement = $this->pdo->prepare($sql->toSQL());

		foreach ($sql->params as $key => $param) {
			if ($param->whereType == 'Like') {
				$param->bindValue = $sql->adapter->escapeLikeValue(strval($this->getParamValue($param->value)));
			} else {
				$param->bindValue = $this->convertToDatabaseValue($sql->adapter, $this->getParamValue($param->value), $param->type);
			}
			$param->bindType = $this->getBindingType($sql->adapter, $param->type);
			$statement->bindParam($key + 1, $param->bindValue, $param->bindType);
		}

		$statement->execute();

		$data = $statement->fetchAll(PDO::FETCH_ASSOC);

		foreach ($data as $row => $rowData) {
			unset($data[$row]['dmx_rownum']);
			foreach ($rowData as $column => $value) {
				$type = NULL;
				foreach ($sql->meta as $columns) {
					if (property_exists($columns, $column)) {
						if (isset($sql->adapter->typeMapping[$columns->{$column}->type])) {
							$type = $sql->adapter->typeMapping[$columns->{$column}->type];
						} else {
							$type = $columns->{$column}->type;
						}
						break;
					}
				}
				$data[$row][$column] = $this->convertToPHPValue($sql->adapter, $value, $type);
			}
		}

		$currentUrl = $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
		$baseUrl = preg_replace('/&?(offset|callback|_)=[^&]*/i', '', $currentUrl);

		$showPrev = $this->offset > 0;
		$showNext = ($this->offset + $this->limit) < $total;

		$firstUrl = $baseUrl . '&offset=0';
		$prevUrl = $baseUrl . '&offset=' . max(0, $this->offset - $this->limit);
		$nextUrl = $baseUrl . '&offset=' . ($this->offset + $this->limit);
		$lastUrl = $baseUrl . '&offset=' . ((ceil($total / $this->limit) - 1) * $this->limit);

		return (object)array(
			'offset' => $this->offset,
			'limit'  => $this->limit,
			'total'  => $total,
			'link' => (object)array(
				'first'   => $showPrev ? $firstUrl : NULL,
				'prev'    => $showPrev ? $prevUrl : NULL,
				'current' => $currentUrl,
				'next'    => $showNext ? $nextUrl : NULL,
				'last'    => $showNext ? $lastUrl : NULL
			),
			'page' => (object)array(
				'current' => floor($this->offset / $this->limit) + 1,
				'total'   => ceil($total / $this->limit)
			),
			'data'   => $data
		);
	}

	protected function writeJSON($obj) {
		global $dmxConnectionDebug;

		$callback = isset($_GET['callback']) ? $_GET['callback'] : FALSE;

		header('Content-type: application/' . ($callback ? 'javascript' : 'json') . '; charset=utf-8');

		if ($dmxConnectionDebug === TRUE) {
			$obj->warnings = Error::$warnings;
		}

		if ($callback) {
			echo $callback . '(';
		}

		echo json_encode($obj);

		if ($callback) {
			echo ');';
		}
	}
}

function getParamValue($obj) {
	if (is_object($obj)) {
		$value = $obj->value;
		$required = isset($obj->required) ? (bool)$obj->required : FALSE;
		$default = isset($obj->default) ? $obj->default : NULL;

		switch ($obj->from) {
			case 'form':
				$value = isset($_POST[$obj->value]) ? $_POST[$obj->value] : (isset($_GET[$obj->value]) ? $_GET[$obj->value] : $default);
				break;
			case 'url':
				$value = isset($_GET[$obj->value]) ? $_GET[$obj->value] : $default;
				break;
			case 'cookie':
				$value = isset($_COOKIE[$obj->value]) ? $_COOKIE[$obj->value] : $default;
				break;
			case 'session':
				if(session_id() == '' || !isset($_SESSION)) {
			   		// session isn't started
				    session_start();
				}
				$value = isset($_SESSION[$obj->value]) ? $_SESSION[$obj->value] : $default;
				break;
		}

		if ($value == '') {
			$value = $default;
		}

		if ($required && ($value == '' || $value === NULL)) {
			header($_SERVER["SERVER_PROTOCOL"] . ' 400 Bad Request');
			header('Content-type: application/json; charset=utf-8');
			exit(json_encode((object)array(
				'message' => 'Parameter ' . $obj->value . ' from ' . $obj->from . ' is required!'
			)));
		}

		return $value;
	}

	return $obj;
}
?>