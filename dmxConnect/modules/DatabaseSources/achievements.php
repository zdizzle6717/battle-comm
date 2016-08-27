<?php
$exports = <<<'JSON'
{
    "name": "achievements",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "achievements", "columns": [{"table": "achievements", "column": "*"}], "wheres": [], "orders": [{"table": "achievements", "column": "achievementName", "direction": "ASC"}], "joins": []}
    }
}
JSON;
?>