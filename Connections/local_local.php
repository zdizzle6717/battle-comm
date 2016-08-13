<?php
# FileName="WADYN_CONN.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_local = "battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com";
$database_local = "hyberion_battlecomm";
$username_local = "bcadmin";
$password_local = "Xdxn9\zX5s";
@session_start();
$foundConnection = false;
if ($foundConnection == false) {
  $domains = explode(",","testbattlecomm.com");
  for ($domindex = 0; $domindex<sizeof($domains) && !$foundConnection; $domindex++) {
    $domainCheck = trim($domains[$domindex]);
    if (strpos(strtolower($_SERVER["SERVER_NAME"]),strtolower($domainCheck)) !== false && ($domainCheck == "" || strpos(strtolower($_SERVER["SERVER_NAME"]),strtolower($domainCheck)) == strlen($_SERVER["SERVER_NAME"])-strlen($domainCheck))) {
      $hostname_local = "battlecomm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com";
	  $database_local = "battlecomm_main";
	  $username_local = "bcadmin";
	  $password_local = "Xdxn9\zX5s";
      $foundConnection = true;
    } 
  } 
} 

$local = mysql_pconnect($hostname_local, $username_local, $password_local) or trigger_error(mysql_error(),E_USER_ERROR); 

?>