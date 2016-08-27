<?php
$exports = <<<'JSON'
{
    "name": "tournamentAdminFilterClear",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "tournament", "columns": [{"table": "tournament", "column": "*", "alias": "", "sortable": false}], "wheres": [], "orders": [], "joins": []}
    }
}
JSON;
?>