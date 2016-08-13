<?php
# FileName="WADYN_MYSQLI_CONN.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_tournamentGameJoin = "battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com";
$database_tournamentGameJoin = "hyberion_battlecomm";
$username_tournamentGameJoin = "bcadmin";
$password_tournamentGameJoin = "Xdxn9\zX5s";
@session_start();

$tournamentGameJoin = new mysqli($hostname_tournamentGameJoin, $username_tournamentGameJoin, $password_tournamentGameJoin, $database_tournamentGameJoin);

?>