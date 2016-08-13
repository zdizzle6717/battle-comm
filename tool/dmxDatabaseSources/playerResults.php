<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_game_player", "columns": [{"table": "tournament_game_player", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_game_player", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "tourney", "required": true, "default": ""}}, {"table": "tournament_game_player", "column": "tourney_round_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "rd", "required": true, "default": ""}}], "orders": [{"table": "tournament_game_player", "column": "total_points", "direction": "DESC"}], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>