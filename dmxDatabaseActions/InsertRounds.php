<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilderEx.php');

$cfg = <<<JSON
{"type": "insert", "table": "tournament_rounds", "values": [{"table": "tournament_rounds", "column": "tournament_id", "value": {"from": "form", "value": "tournament_id", "required": false, "default": ""}}, {"table": "tournament_rounds", "column": "adminName", "value": {"from": "form", "value": "adminName", "required": false, "default": ""}}, {"table": "tournament_rounds", "column": "Round_Title", "value": {"from": "form", "value": "Round_Title", "required": false, "default": ""}}, {"table": "tournament_rounds", "column": "startTime", "value": {"from": "form", "value": "startTime", "required": false, "default": ""}}, {"table": "tournament_rounds", "column": "endTime", "value": {"from": "form", "value": "endTime", "required": false, "default": ""}}, {"table": "tournament_rounds", "column": "num_participants", "value": {"from": "form", "value": "num_participants", "required": false, "default": ""}}, {"table": "tournament_rounds", "column": "games_id", "value": {"from": "form", "value": "games_id", "required": false, "default": ""}}, {"table": "tournament_rounds", "column": "games_title", "value": {"from": "form", "value": "games_title", "required": false, "default": ""}}, {"table": "tournament_rounds", "column": "notes_rules_changes", "value": {"from": "form", "value": "notes_rules_changes", "required": false, "default": ""}}], "wheres": []}
JSON;

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$conn = new SqlConnectionEx();
$conn->execute(SqlBuilderEx($cfg), $isAjax);

if (!$isAjax) {
	header('Location: ' . (isset($_GET['redirectUrl']) ? $_GET['redirectUrl'] : $_SERVER['HTTP_REFERER']));
}
?>