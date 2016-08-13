<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "club", "columns": [{"table": "club", "column": "*", "alias": "", "sortable": false}, {"table": "venue", "column": "*", "alias": "", "sortable": false}], "wheres": [], "orders": [{"table": "club", "column": "club_name", "direction": "ASC"}], "joins": [{"type": "inner", "table": "venue", "clauses": [{"table": "venue", "column": "venue_id", "bool": "and", "operator": "=", "value": {"table": "club", "column": "club_key"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>