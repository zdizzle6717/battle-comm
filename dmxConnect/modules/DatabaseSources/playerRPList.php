<?php
$exports = <<<'JSON'
{
    "name": "playerRPList",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "id"}, {"table": "user_login", "column": "email"}, {"table": "user_login", "column": "lastName"}, {"table": "user_login", "column": "firstName"}, {"table": "user_login", "column": "user_points"}], "wheres": [{"table": "user_login", "column": "email", "bool": "and", "operator": "contains", "value": {"from": "form", "value": "listFilter", "required": false, "default": ""}}, {"table": "user_login", "column": "lastName", "bool": "or", "operator": "contains", "value": {"from": "form", "value": "listFilter", "required": false, "default": ""}}, {"table": "user_login", "column": "firstName", "bool": "or", "operator": "contains", "value": {"from": "form", "value": "listFilter", "required": false, "default": ""}}], "orders": [], "joins": []}
    }
}
JSON;
?>