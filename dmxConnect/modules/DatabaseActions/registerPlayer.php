<?php
$exports = <<<'JSON'
{
    "name": "registerPlayer",
    "module": "dbconnector",
    "action": "update",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "insert", "table": "tournament_players", "values": [{"table": "tournament_players", "column": "user_confirmed", "value": {"from": "form", "value": "user_confirmed", "required": false, "default": ""}}, {"table": "tournament_players", "column": "userHandle", "value": {"from": "form", "value": "userHandle", "required": false, "default": ""}}, {"table": "tournament_players", "column": "firstName", "value": {"from": "form", "value": "firstName", "required": false, "default": ""}}, {"table": "tournament_players", "column": "lastName", "value": {"from": "form", "value": "lastName", "required": false, "default": ""}}, {"table": "tournament_players", "column": "email_Address", "value": {"from": "form", "value": "email_Address", "required": false, "default": ""}}, {"table": "tournament_players", "column": "tournament_id", "value": {"from": "form", "value": "tournament_id", "required": false, "default": ""}}, {"table": "tournament_players", "column": "user_login_id", "value": {"from": "form", "value": "user_login_id", "required": false, "default": ""}}, {"table": "tournament_players", "column": "clubID", "value": {"from": "form", "value": "clubID", "required": false, "default": ""}}], "wheres": []}
    }
}
JSON;
?>