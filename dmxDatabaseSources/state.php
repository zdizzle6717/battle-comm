<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/local localhost.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tbl_state", "columns": [{"table": "tbl_state", "column": "state_id", "alias": "", "sortable": false}, {"table": "tbl_state", "column": "state_name"}, {"table": "tbl_state", "column": "state_abbr", "alias": "", "sortable": false}], "wheres": [], "orders": [{"table": "tbl_state", "column": "state_abbr", "direction": "ASC"}], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>