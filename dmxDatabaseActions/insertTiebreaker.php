<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilderEx.php');

$cfg = <<<JSON
{"type": "insert", "table": "matched_tiebreakers", "values": [{"table": "matched_tiebreakers", "column": "match_id", "value": {"from": "form", "value": "match_id", "required": false, "default": ""}}, {"table": "matched_tiebreakers", "column": "tournament_ID", "value": {"from": "form", "value": "tournament_ID", "required": false, "default": ""}}, {"table": "matched_tiebreakers", "column": "match_name", "value": {"from": "form", "value": "match_name", "required": false, "default": ""}}, {"table": "matched_tiebreakers", "column": "mission_id", "value": {"from": "form", "value": "mission_id", "required": false, "default": ""}}, {"table": "matched_tiebreakers", "column": "mission_name", "value": {"from": "form", "value": "mission_name", "required": false, "default": ""}}, {"table": "matched_tiebreakers", "column": "tiebreaker_points", "value": {"from": "form", "value": "tiebreaker_points", "required": false, "default": ""}}], "wheres": []}
JSON;

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$conn = new SqlConnectionEx();
$conn->execute(SqlBuilderEx($cfg), $isAjax);

if (!$isAjax) {
	header('Location: ' . (isset($_GET['redirectUrl']) ? $_GET['redirectUrl'] : $_SERVER['HTTP_REFERER']));
}
?>