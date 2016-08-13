<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilderEx.php');

$cfg = <<<JSON
{"type": "update", "table": "tournament_game_player", "values": [{"table": "tournament_game_player", "column": "tourney_game_player_id", "value": {"from": "form", "value": "tourney_game_player_id", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "game_result", "value": {"from": "form", "value": "game_result", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "Game_info", "value": {"from": "form", "value": "Game_info", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "game_points", "value": {"from": "form", "value": "game_points", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "mission_points", "value": {"from": "form", "value": "mission_points", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "total_points", "value": {"from": "form", "value": "total_points", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "Notes_comments", "value": {"from": "form", "value": "Notes_comments", "required": false, "default": ""}}], "wheres": [{"table": "tournament_game_player", "column": "tourney_game_player_id", "bool": "and", "operator": "=", "value": {"from": "form", "value": "tourney_game_id", "required": true, "default": ""}}]}
JSON;

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$conn = new SqlConnectionEx();
$conn->execute(SqlBuilderEx($cfg), $isAjax);

if (!$isAjax) {
	header('Location: ' . (isset($_GET['redirectUrl']) ? $_GET['redirectUrl'] : $_SERVER['HTTP_REFERER']));
}
?>