<?php
$exports = <<<'JSON'
{
    "name": "GameSystems",
    "module": "dbconnector",
    "action": "select",
    "options": {
    		"connection" : "xampp_local",
        "sql": {"type": "select", "table": "game_system", "columns": [{"table": "game_system", "column": "game_system_id"}, {"table": "game_system", "column": "game_system_Title"}], "wheres": [], "orders": [], "joins": []}
    }
}
JSON;
?>