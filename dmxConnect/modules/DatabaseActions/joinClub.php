<?php
$exports = <<<'JSON'
{
    "name": "joinClub",
    "module": "dbconnector",
    "action": "update",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "update", "table": "user_login", "values": [{"table": "user_login", "column": "user_club", "value": {"from": "form", "value": "user_club", "required": false, "default": ""}}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}]}
    }
}
JSON;
?>