<?php
$exports = <<<'JSON'
{
    "name": "PersonalClubs",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "user_login", "columns": [{"table": "user_login", "column": "id"}, {"table": "user_login", "column": "user_club"}, {"table": "club", "column": "club_key"}, {"table": "club", "column": "club_name"}], "wheres": [{"table": "user_login", "column": "id", "bool": "and", "operator": "=", "value": {"from": "session", "value": "SecurityAssist_id", "required": true, "default": ""}}], "orders": [], "joins": [{"type": "inner", "table": "club", "clauses": [{"table": "club", "column": "club_key", "bool": "and", "operator": "=", "value": {"table": "user_login", "column": "user_club"}}]}]}
    }
}
JSON;
?>