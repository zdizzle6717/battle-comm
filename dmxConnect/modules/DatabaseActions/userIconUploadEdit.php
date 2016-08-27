<?php
$exports = <<<'JSON'
{
    "name": "userIconUploadEdit",
    "module": "dbconnector",
    "action": "update",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "update", "table": "user_login", "values": [{"table": "user_login", "column": "user_icon", "value": {"from": "form", "value": "user_icon", "required": false, "default": ""}}, {"table": "user_login", "column": "imagePath", "value": {"from": "form", "value": "imagePath", "required": false, "default": ""}}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": false, "default": ""}}]}
    }
}
JSON;
?>