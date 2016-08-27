<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament", "columns": [{"table": "tournament", "column": "*", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "tournament", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "td", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "tournament_rounds", "clauses": [{"table": "tournament_rounds", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"table": "tournament", "column": "tournament_id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>