<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_players", "columns": [{"table": "tournament_players", "column": "tournament_players_id", "alias": "", "sortable": false}, {"table": "tournament_players", "column": "tournament_id", "alias": "", "sortable": false}, {"table": "tournament_players", "column": "user_login_id", "alias": "", "sortable": false}, {"table": "tournament_players", "column": "userHandle", "alias": "", "sortable": false}, {"table": "tournament_players2", "column": "*", "alias": "", "sortable": false}], "wheres": [], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>