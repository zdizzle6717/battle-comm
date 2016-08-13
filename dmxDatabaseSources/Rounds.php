<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/local localhost.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_rounds", "columns": [{"table": "tournament_rounds", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_rounds", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "tourney", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>