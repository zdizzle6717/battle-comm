<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "id"}, {"table": "user_login", "column": "user_club"}, {"table": "club", "column": "club_key"}, {"table": "club", "column": "club_name"}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "club", "clauses": [{"table": "club", "column": "club_key", "bool": "and", "operator": "=", "value": {"table": "user_login", "column": "user_club"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>