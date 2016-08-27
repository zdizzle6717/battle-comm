<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "*", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "td", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "tournament_game_player", "clauses": [{"table": "tournament_game_player", "column": "tourney_game_player_id", "bool": "and", "operator": "=", "value": {"table": "user_login", "column": "id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>