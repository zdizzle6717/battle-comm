<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "game_system", "columns": [{"table": "game_system", "column": "game_system_id", "alias": "", "sortable": false}, {"table": "game_system", "column": "game_system_Title", "alias": "", "sortable": false}, {"table": "game_system", "column": "games_time", "alias": "", "sortable": false}, {"table": "game_system", "column": "noOfPlayers", "alias": "", "sortable": false}], "wheres": [{"table": "game_system", "column": "game_system_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "gs", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>