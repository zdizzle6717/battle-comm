<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_game_player", "columns": [{"table": "tournament_game_player", "column": "tourney_game_player_id", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "player_id", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "player_handle", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "tourney_round_id", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "tourney_round_title", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "tournament_id", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_game_player", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "tourney", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "Game_session", "bool": "and", "operator": "=", "value": {"from": "url", "value": "gs", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "tourney_round_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "rd", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "tourney_game_player_id", "bool": "and", "operator": "<>", "value": {"from": "url", "value": "pl", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>