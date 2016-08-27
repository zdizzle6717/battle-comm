<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "factions", "columns": [{"table": "factions", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "factions", "column": "game_system_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "gsi", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "game_system", "clauses": [{"table": "game_system", "column": "game_system_id", "bool": "and", "operator": "=", "value": {"table": "factions", "column": "game_system_id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>