<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament", "columns": [{"table": "tournament", "column": "tournament_id", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_name", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_startDate", "alias": "", "sortable": false}, {"table": "tournament", "column": "Tournament_endDate", "alias": "", "sortable": false}], "wheres": [], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>