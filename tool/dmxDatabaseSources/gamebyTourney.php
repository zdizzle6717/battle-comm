<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament", "columns": [], "wheres": [], "orders": [], "joins": [{"type": "inner", "table": "game_system", "clauses": [{"table": "game_system", "column": "game_system_id", "bool": "and", "operator": "=", "value": {"table": "tournament", "column": "game_id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>