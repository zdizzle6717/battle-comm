<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_game_player", "columns": [{"table": "tournament_game_player", "column": "*", "alias": "", "sortable": false}, {"table": "user_login", "column": "firstName", "alias": "", "sortable": false}, {"table": "user_login", "column": "lastName", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_game_player", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "td", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "table_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "tb", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "tourney_round_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "rd", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "Game_session", "bool": "and", "operator": "=", "value": {"from": "url", "value": "gs", "required": true, "default": ""}}], "orders": [{"table": "tournament_game_player", "column": "player_id", "direction": "ASC"}], "joins": [{"type": "inner", "table": "user_login", "clauses": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"table": "tournament_game_player", "column": "player_id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>