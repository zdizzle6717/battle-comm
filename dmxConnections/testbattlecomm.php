<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$dmxConnectionString = "mysql:host=localhost;port=;dbname=hyberion_battlecomm;charset=utf8;user=hyberion_dbadmin;password=opensesame1234";
$dmxConnectionLimit = 1000;
$dmxConnectionDebug = false;

$dmxConnectionMeta = <<<JSON
{"allTables": ["bc_news", "club", "club_user_membership", "club_user_types", "clubs_games_affiliation", "event_request", "factions", "game_categories", "game_system", "matched_tiebreakers", "news_categories", "notification_request", "pages", "players", "tbl_state", "tournament", "tournament_game", "tournament_game_player", "tournament_game_tiebreaker_lookup", "tournament_match", "tournament_players", "tournament_rounds", "tournament_tiebreaker", "tourney_admin", "user_account_status", "user_icons", "user_login", "user_profile", "usergroups", "users_assigned_permissions", "venue"], "allViews": []}
JSON;
?>