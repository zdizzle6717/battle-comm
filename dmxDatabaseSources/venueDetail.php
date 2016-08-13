<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "venue", "columns": [{"table": "venue", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "venue", "column": "venue_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "ven", "required": true, "default": ""}}], "orders": [{"table": "venue", "column": "venue_Name", "direction": "ASC"}], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>