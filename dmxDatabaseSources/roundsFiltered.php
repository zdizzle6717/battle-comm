<?php
$base = realpath(dirname(__FILE__)) . '/';
require($base.'../dmxConnections/xampp_local.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/sqlBuilder.php');
require_once($base.'../ScriptLibrary/dmxDatabaseConnector/adapters/mysql/sqlBuilder.php');

$cfg = <<<JSON
{"type": "select", "table": "tournament_rounds", "columns": [{"table": "tournament_rounds", "column": "rounds_id", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "tournament_id", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "Round_Title", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "startTime", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "endTime", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "num_participants", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "games_id", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "games_title", "alias": "", "sortable": false}, {"table": "tournament_rounds", "column": "notes_rules_changes", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_rounds", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "tourney", "required": true, "default": ""}}, {"table": "tournament_rounds", "column": "rounds_id", "bool": "and", "operator": "=", "value": {"from": "url", "value": "rd", "required": true, "default": ""}}], "orders": [], "joins": []}
JSON;

$conn = new SqlConnection();
$conn->execute(SqlBuilder($cfg), TRUE);
?>