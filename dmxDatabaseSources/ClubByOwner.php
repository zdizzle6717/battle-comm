<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "club", "columns": [{"table": "club", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "club", "column": "clubOwner", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>