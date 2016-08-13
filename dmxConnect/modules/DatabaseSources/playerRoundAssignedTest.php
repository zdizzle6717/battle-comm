<?php
$exports = <<<'JSON'
{
    "name": "playerRoundAssignedTest",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "tournament_players", "columns": [{"table": "tournament_players", "column": "*"}], "wheres": [{"table": "tournament_players", "column": "user_login_id", "bool": "and", "operator": "=", "value": {"from": "form", "value": "user_login_id", "required": true, "default": "6"}}], "orders": [], "joins": []}
    }
}
JSON;
?>