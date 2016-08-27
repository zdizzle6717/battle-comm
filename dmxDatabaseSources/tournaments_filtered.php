<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament", "columns": [{"table": "tournament", "column": "tournament_id", "alias": "", "sortable": false}, {"table": "tournament", "column": "WinPointValue", "alias": "", "sortable": false}, {"table": "tournament", "column": "DrawPointValue", "alias": "", "sortable": false}, {"table": "tournament", "column": "LossPointValue", "alias": "", "sortable": false}, {"table": "tournament", "column": "game_title", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_name", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_rounds", "alias": "", "sortable": false}, {"table": "tournament", "column": "No_of_Games", "alias": "", "sortable": false}, {"table": "tournament", "column": "game_id", "alias": "", "sortable": false}, {"table": "game_system", "column": "game_system_Title", "alias": "", "sortable": false}], "wheres": [{"table": "tournament", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "tourney", "required": true, "default": ""}}], "orders": [{"table": "tournament", "column": "tournament_name", "direction": "ASC"}], "joins": [{"type": "inner", "table": "game_system", "clauses": [{"table": "game_system", "column": "game_system_id", "bool": "and", "operator": "=", "value": {"table": "tournament", "column": "game_id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>