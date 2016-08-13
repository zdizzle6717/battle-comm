<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilderEx.php');

$cfg = <<<JSON
{"type": "delete", "table": "tournament_rounds", "values": [], "wheres": [{"table": "tournament_rounds", "column": "rounds_id", "bool": "and", "operator": "=", "value": {"from": "form", "value": "rounds_id", "required": true, "default": ""}}]}
JSON;

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$conn = new SqlConnectionEx();
$conn->execute(SqlBuilderEx($cfg), $isAjax);

if (!$isAjax) {
	header('Location: ' . (isset($_GET['redirectUrl']) ? $_GET['redirectUrl'] : $_SERVER['HTTP_REFERER']));
}
?>