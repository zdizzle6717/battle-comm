<?php
$exports = <<<'JSON'
{
    "name": "state",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "local localhost",
        "sql": {"type": "select", "table": "tbl_state", "columns": [{"table": "tbl_state", "column": "state_id", "alias": "", "sortable": false}, {"table": "tbl_state", "column": "state_name"}, {"table": "tbl_state", "column": "state_abbr", "alias": "", "sortable": false}], "wheres": [], "orders": [{"table": "tbl_state", "column": "state_abbr", "direction": "ASC"}], "joins": []}
    }
}
JSON;
?>