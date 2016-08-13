<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilderEx.php');

$cfg = <<<JSON
{"type": "insert", "table": "players", "values": [{"table": "players", "column": "playerHandle", "value": {"from": "form", "value": "playerHandle", "required": false, "default": ""}}, {"table": "players", "column": "playerFirstName", "value": {"from": "form", "value": "playerFirstName", "required": false, "default": ""}}, {"table": "players", "column": "playerLastName", "value": {"from": "form", "value": "playerLastName", "required": false, "default": ""}}, {"table": "players", "column": "playerEmail", "value": {"from": "form", "value": "playerEmail", "required": false, "default": ""}}, {"table": "players", "column": "testingAdmin", "value": {"from": "form", "value": "testingAdmin", "required": false, "default": ""}}], "wheres": []}
JSON;

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$conn = new SqlConnectionEx();
$conn->execute(SqlBuilderEx($cfg), $isAjax);

if (!$isAjax) {
	header('Location: ' . (isset($_GET['redirectUrl']) ? $_GET['redirectUrl'] : $_SERVER['HTTP_REFERER']));
}
?>