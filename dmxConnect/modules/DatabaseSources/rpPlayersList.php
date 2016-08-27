<?php
$exports = <<<'JSON'
{
    "name": "rpPlayersList",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "id"}, {"table": "user_login", "column": "email", "sortable": true}, {"table": "user_login", "column": "lastName", "sortable": true}, {"table": "user_login", "column": "firstName"}, {"table": "user_login", "column": "user_points"}], "wheres": [], "orders": [], "joins": []}
    }
}
JSON;
?>