<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$exports = <<<'JSON'
{
    "name": "tbc",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "mysql",
        "connectionString": "mysql:host=localhost;port=;dbname=battlecomm;charset=utf8;user=root;password=root",
        "limit" : 1000,
        "debug" : false,
        "meta"  : {"allTables": ["assignedfactions", "bc_news", "binarymenuchoice", "club", "club_user_membership", "club_user_types", "clubs_games_affiliation", "event_request", "factions", "game_categories", "game_system", "matched_tiebreakers", "news_categories", "notification_request", "pages", "players", "product_orders", "products", "products_images", "products_orig"], "allViews": [], "tables": {"products_images": {"columns": {"prod_image_id": {"type": "int", "primary": true}, "prod_id": {"type": "int"}, "prod_image_name": {"type": "varchar", "size": 80}, "Image_file_name": {"type": "varchar", "size": 90}, "prod_image_alt": {"type": "varchar", "size": 200}, "prod_image_caption": {"type": "text", "size": 65535}, "prod_image_display": {"type": "enum", "size": 3, "defaultValue": "yes"}, "prod_image_type": {"type": "varchar", "size": 10}, "prod_image_h": {"type": "int"}, "prod_image_v": {"type": "int"}}}}}
    }
}
JSON;
?>