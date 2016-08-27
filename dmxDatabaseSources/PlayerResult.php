<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_game_player", "columns": [{"table": "tournament_game_player", "column": "game_result", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "Game_info", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "game_points", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "mission_points", "alias": "", "sortable": false}, {"table": "tournament_game_player", "column": "total_points", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_game_player", "column": "tourney_game_player_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "pr", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>