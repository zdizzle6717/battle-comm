<?php
$exports = <<<'JSON'
{
    "name": "loggedinPlayer",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "id", "alias": "", "sortable": false}, {"table": "user_login", "column": "email", "alias": "", "sortable": false}, {"table": "user_login", "column": "firstName", "alias": "", "sortable": false}, {"table": "user_login", "column": "lastName", "alias": "", "sortable": false}, {"table": "user_login", "column": "user_handle", "alias": "", "sortable": false}, {"table": "user_login", "column": "user_club"}, {"table": "user_login", "column": "user_icon", "alias": "", "sortable": false}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}], "orders": [], "joins": []}
    }
}
JSON;
?>