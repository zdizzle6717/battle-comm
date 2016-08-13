<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "randomPlayerInfo", "columns": [{"table": "randomPlayerInfo", "column": "player_handle", "alias": "", "sortable": false}, {"table": "randomPlayerInfo", "column": "randomPlayerKey", "alias": "", "sortable": false}, {"table": "randomPlayerInfo", "column": "playerFirstName", "alias": "", "sortable": false}, {"table": "randomPlayerInfo", "column": "playerLastName", "alias": "", "sortable": false}, {"table": "randomPlayerInfo", "column": "playerEmail", "alias": "", "sortable": false}], "wheres": [], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>