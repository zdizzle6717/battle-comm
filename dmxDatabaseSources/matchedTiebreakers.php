<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "matched_tiebreakers", "columns": [{"table": "matched_tiebreakers", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "matched_tiebreakers", "column": "tournament_ID", "bool": "and", "operator": "=", "value": {"from": "url", "value": "td", "required": true, "default": ""}}, {"table": "matched_tiebreakers", "column": "match_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "rd", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>