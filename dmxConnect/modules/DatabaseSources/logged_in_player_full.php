<?php
$exports = <<<'JSON'
{
    "name": "logged_in_player_full",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "*", "alias": "", "sortable": false}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}], "orders": [], "joins": []}
    }
}
JSON;
?>