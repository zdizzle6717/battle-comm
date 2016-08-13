<?php
$exports = <<<'JSON'
{
    "name": "userBioUpdate",
    "module": "dbconnector",
    "action": "update",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "update", "table": "user_login", "values": [{"table": "user_login", "column": "user_bio", "value": {"from": "form", "value": "user_bio", "required": false, "default": ""}}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}]}
    }
}
JSON;
?>