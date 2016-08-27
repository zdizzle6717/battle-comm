<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "id", "alias": "", "sortable": false}, {"table": "user_login", "column": "email", "alias": "", "sortable": false}, {"table": "user_login", "column": "firstName", "alias": "", "sortable": false}, {"table": "user_login", "column": "lastName", "alias": "", "sortable": false}, {"table": "user_login", "column": "user_handle", "alias": "", "sortable": false}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>