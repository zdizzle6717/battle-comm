<?php
# FileName="WADYN_MYSQLI_CONN.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_battlecomm_sqli = "battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com";
$database_battlecomm_sqli = "hyberion_battlecomm";
$username_battlecomm_sqli = "bcadmin";
$password_battlecomm_sqli = "Xdxn9\zX5s";
@session_start();

$battlecomm_sqli = new mysqli($hostname_battlecomm_sqli, $username_battlecomm_sqli, $password_battlecomm_sqli, $database_battlecomm_sqli);

?>