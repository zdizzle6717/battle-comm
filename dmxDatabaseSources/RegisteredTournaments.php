<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_players", "columns": [{"table": "tournament_players", "column": "user_login_id", "alias": "", "sortable": false}, {"table": "tournament_players", "column": "tournament_id", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_name", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_startDate", "alias": "", "sortable": false}, {"table": "tournament", "column": "Tournament_endDate", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_players", "column": "user_login_id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "tournament", "clauses": [{"table": "tournament", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"table": "tournament_players", "column": "tournament_id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>