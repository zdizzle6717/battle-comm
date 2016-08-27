<?php
$exports = <<<'JSON'
{
    "name": "RoundAssignment",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "tournament_game_player", "columns": [{"table": "tournament_game_player", "column": "*", "alias": "", "sortable": false}, {"table": "tournament", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "tournament_game_player", "column": "player_id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": "6"}}], "orders": [], "joins": [{"type": "inner", "table": "tournament", "clauses": [{"table": "tournament", "column": "tournament_id", "bool": "and", "operator": "=", "value": {"table": "tournament_game_player", "column": "tournament_id"}}]}]}
    }
}
JSON;
?>