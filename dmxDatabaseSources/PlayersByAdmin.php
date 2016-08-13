<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "players", "columns": [{"table": "players", "column": "playerId", "alias": "", "sortable": false}, {"table": "players", "column": "playerHandle", "alias": "", "sortable": false}, {"table": "players", "column": "playerFirstName", "alias": "", "sortable": false}, {"table": "players", "column": "playerLastName", "alias": "", "sortable": false}, {"table": "players", "column": "playerEmail", "alias": "", "sortable": false}, {"table": "players", "column": "testingAdmin", "alias": "", "sortable": false}, {"table": "players", "column": "active", "alias": "", "sortable": false}], "wheres": [{"table": "players", "column": "testingAdmin", "bool": "and", "operator": "=", "value": {"from": "session", "value": "svAdminName", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>