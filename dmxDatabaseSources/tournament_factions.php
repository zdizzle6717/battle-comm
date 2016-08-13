<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament", "columns": [{"table": "tournament", "column": "tournament_id", "alias": "", "sortable": false}, {"table": "tournament", "column": "tournament_name", "alias": "", "sortable": false}, {"table": "tournament", "column": "game_id", "alias": "", "sortable": false}], "wheres": [{"table": "tournament", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "td", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>