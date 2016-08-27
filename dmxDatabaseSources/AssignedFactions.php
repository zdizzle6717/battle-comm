<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "AssignedFactions", "columns": [{"table": "AssignedFactions", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "AssignedFactions", "column": "player_id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}, {"table": "AssignedFactions", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "td", "required": true, "default": ""}}, {"table": "AssignedFactions", "column": "round_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "rd", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>