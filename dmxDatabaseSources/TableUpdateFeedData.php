<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tableUpdates", "columns": [{"table": "tableUpdates", "column": "title", "alias": "", "sortable": false}, {"table": "tableUpdates", "column": "description", "alias": "", "sortable": false}, {"table": "tableUpdates", "column": "when", "alias": "", "sortable": false}], "wheres": [], "orders": [{"table": "tableUpdates", "column": "when", "direction": "ASC"}], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>