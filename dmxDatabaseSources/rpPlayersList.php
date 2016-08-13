<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "id"}, {"table": "user_login", "column": "email", "sortable": true}, {"table": "user_login", "column": "lastName", "sortable": true}, {"table": "user_login", "column": "firstName"}, {"table": "user_login", "column": "user_points"}], "wheres": [], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>