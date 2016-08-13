<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "venue", "columns": [{"table": "venue", "column": "venue_id", "alias": "", "sortable": false}, {"table": "venue", "column": "venue_logo_icon", "alias": "", "sortable": false}, {"table": "venue", "column": "venue_Name", "alias": "", "sortable": false}, {"table": "venue", "column": "venue_city", "alias": "", "sortable": false}], "wheres": [], "orders": [{"table": "venue", "column": "venue_Name", "direction": "ASC"}], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>