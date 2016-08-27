<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "*", "alias": "", "sortable": false}, {"table": "tournament_players", "column": "*", "alias": "", "sortable": false}], "wheres": [], "orders": [{"table": "user_login", "column": "totalPoints", "direction": "DESC"}], "joins": [{"type": "inner", "table": "tournament_players", "clauses": [{"table": "tournament_players", "column": "user_login_id", "bool": "and", "operator": "=", "value": {"table": "user_login", "column": "id"}}]}]}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>