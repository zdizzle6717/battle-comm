<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_players", "columns": [{"table": "tournament_players", "column": "*"}], "wheres": [{"table": "tournament_players", "column": "user_login_id", "bool": "and", "operator": "=", "value": {"from": "form", "value": "user_login_id", "required": true, "default": "6"}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>