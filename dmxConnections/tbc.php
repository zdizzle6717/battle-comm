<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$dmxConnectionString = "mysql:host=battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com;port=3306;dbname=hyberion_battlecomm;charset=utf8;user=bcadmin;password=Xdxn9\zX5s";
$dmxConnectionLimit = 1000;
$dmxConnectionDebug = false;

$dmxConnectionMeta = <<<JSON
{"allTables": ["assignedfactions", "bc_news", "binarymenuchoice", "club", "club_user_membership", "club_user_types", "clubs_games_affiliation", "event_request", "factions", "game_categories", "game_system", "matched_tiebreakers", "news_categories", "notification_request", "pages", "players", "product_orders", "products", "products_images", "products_orig"], "allViews": [], "tables": {"products_images": {"columns": {"prod_image_id": {"type": "int", "primary": true}, "prod_id": {"type": "int"}, "prod_image_name": {"type": "varchar", "size": 80}, "Image_file_name": {"type": "varchar", "size": 90}, "prod_image_alt": {"type": "varchar", "size": 200}, "prod_image_caption": {"type": "text", "size": 65535}, "prod_image_display": {"type": "enum", "size": 3, "defaultValue": "yes"}, "prod_image_type": {"type": "varchar", "size": 10}, "prod_image_h": {"type": "int"}, "prod_image_v": {"type": "int"}}}}}
JSON;
?>
