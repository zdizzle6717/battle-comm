<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_tiebreaker", "columns": [{"table": "tournament_tiebreaker", "column": "tourney_tiebreaker_id", "alias": "", "sortable": false}, {"table": "tournament_tiebreaker", "column": "point_value", "alias": "", "sortable": false}, {"table": "tournament_tiebreaker", "column": "tiebreaker_name", "alias": "", "sortable": false}], "wheres": [], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>