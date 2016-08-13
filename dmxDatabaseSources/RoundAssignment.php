<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_game_player", "columns": [{"table": "tournament_game_player", "column": "*", "alias": "", "sortable": false}, {"table": "tournament", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_game_player", "column": "player_id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": "6"}}], "orders": [], "joins": [{"type": "inner", "table": "tournament", "clauses": [{"table": "tournament", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"table": "tournament_game_player", "column": "tournament_id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>