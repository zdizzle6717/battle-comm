<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilderEx.php');

$cfg = <<<JSON
{"type": "insert", "table": "tournament_game_player", "values": [{"table": "tournament_game_player", "column": "player_id", "value": {"from": "form", "value": "playerID", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "player_handle", "value": {"from": "form", "value": "player_handle", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "tourney_round_id", "value": {"from": "form", "value": "round_id", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "tourney_round_title", "value": {"from": "form", "value": "tourney_round_title", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "tournament_id", "value": {"from": "form", "value": "tournamentID", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "game_id", "value": {"from": "form", "value": "GameID", "required": false, "default": ""}}, {"table": "tournament_game_player", "column": "game_title", "value": {"from": "form", "value": "gameTitle", "required": false, "default": ""}}], "wheres": []}
JSON;

$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

$conn = new SqlConnectionEx();
$conn->execute(SqlBuilderEx($cfg), $isAjax);

if (!$isAjax) {
	header('Location: ' . (isset($_GET['redirectUrl']) ? $_GET['redirectUrl'] : $_SERVER['HTTP_REFERER']));
}
?>