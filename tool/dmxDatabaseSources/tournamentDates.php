<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament", "columns": [{"table": "tournament", "column": "tournament_id", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_name", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_startDate", "alias": "", "sortable": false}, {"table": "tournament", "column": "No_of_Games", "alias": "", "sortable": false}, {"table": "tournament", "column": "game_title", "alias": "", "sortable": false}, {"table": "tournament", "column": "game_id", "alias": "", "sortable": false}, {"table": "game_system", "column": "game_system_id", "alias": "", "sortable": false}, {"table": "game_system", "column": "game_system_Title", "alias": "", "sortable": false}], "wheres": [{"table": "tournament", "column": "game_id", "bool": "and", "operator": ">", "value": "0"}], "orders": [], "joins": [{"type": "inner", "table": "game_system", "clauses": [{"table": "game_system", "column": "game_system_id", "bool": "and", "operator": "=", "value": {"table": "tournament", "column": "game_id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>