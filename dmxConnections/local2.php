<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$dmxConnectionString = "mysql:host=localhost;port=;dbname=battlecomm;charset=utf8;user=root;password=letmein12341234";
$dmxConnectionLimit = 1000;
$dmxConnectionDebug = false;

$dmxConnectionMeta = <<<JSON
{"allTables": ["as_comments", "as_login_attempts", "as_social_logins", "as_user_details", "as_user_roles", "as_users", "bc_news", "club", "club_user_membership", "club_user_types", "clubs_games_affiliation", "email_submissions", "event_request", "factions", "game_categories", "game_system", "games_tournament_round", "matched_tiebreakers", "news_categories", "notification_request", "pages", "players", "tbl_state", "tournament", "tournament_game", "tournament_game_player", "tournament_game_tiebreaker_lookup", "tournament_match", "tournament_players", "tournament_players2", "tournament_rounds", "tournament_tiebreaker", "tourney_admin", "user_account_status", "user_icons", "user_login", "user_profile", "usergroups", "users_assigned_permissions", "venue"], "allViews": []}
JSON;
?>