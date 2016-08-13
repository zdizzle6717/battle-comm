<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "players", "columns": [{"table": "players", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "players", "column": "active", "bool": "and", "operator": "=", "value": "yes"}], "orders": [{"table": "players", "column": "totalPoints", "direction": "DESC"}], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>