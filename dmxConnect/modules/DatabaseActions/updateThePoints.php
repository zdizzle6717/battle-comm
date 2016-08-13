<?php
$exports = <<<'JSON'
{
    "name": "updateThePoints",
    "module": "dbconnector",
    "action": "update",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "update", "table": "user_login", "values": [{"table": "user_login", "column": "user_points", "value": {"from": "form", "value": "rpValue", "required": false, "default": ""}}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "form", "value": "userIdent", "required": false, "default": ""}}]}
    }
}
JSON;
?>