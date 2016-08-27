<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "Assigned_factions", "columns": [{"table": "Assigned_factions", "column": "*", "alias": "", "sortable": false}, {"table": "factions", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "Assigned_factions", "column": "tourneyID", "bool": "and", "operator": "=", "value": {"from": "url", "value": "tourney", "required": true, "default": ""}}, {"table": "Assigned_factions", "column": "roundID", "bool": "and", "operator": "=", "value": {"from": "url", "value": "rd", "required": true, "default": ""}}, {"table": "Assigned_factions", "column": "matchID", "bool": "and", "operator": "=", "value": {"from": "url", "value": "gs", "required": true, "default": ""}}, {"table": "Assigned_factions", "column": "playerID", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "factions", "clauses": [{"table": "factions", "column": "faction_id", "bool": "and", "operator": "=", "value": {"table": "Assigned_factions", "column": "factionsID"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>