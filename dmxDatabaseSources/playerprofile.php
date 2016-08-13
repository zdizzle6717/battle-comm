<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "user_profile", "columns": [{"table": "user_profile", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "user_profile", "column": "iduser_profile", "bool": "and", "operator": "=", "value": {"from": "url", "value": "id", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>