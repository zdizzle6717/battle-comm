<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_game_player", "columns": [{"table": "tournament_game_player", "column": "*"}], "wheres": [{"table": "tournament_game_player", "column": "Game_session", "bool": "and", "operator": "=", "value": {"from": "form", "value": "game_session_ID", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "tourney_round_id", "bool": "and", "operator": "=", "value": {"from": "form", "value": "player_round_ID", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "table_id", "bool": "and", "operator": "=", "value": {"from": "form", "value": "player_table_ID", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>