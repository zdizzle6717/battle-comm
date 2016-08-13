<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament", "columns": [{"table": "tournament", "column": "*", "alias": "", "sortable": false}, {"table": "game_categories", "column": "*", "alias": "", "sortable": false}, {"table": "game_system", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "tournament", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "tourney", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "game_system", "clauses": [{"table": "game_system", "column": "game_system_id", "bool": "and", "operator": "=", "value": {"table": "tournament", "column": "game_id"}}]}, {"type": "inner", "table": "game_categories", "clauses": [{"table": "game_categories", "column": "game_category", "bool": "and", "operator": "=", "value": {"table": "game_system", "column": "games_category"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>