<?php
# FileName="WADYN_CONN.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_local_local = "localhost";
$database_local_local = "hyberion_battlecomm";
$username_local_local = "hyberion_dbadmin";
$password_local_local = "opensesame1234";
@session_start();
$foundConnection = false;
if ($foundConnection == false) {
  $domains = explode(",","testbattlecomm.com");
  for ($domindex = 0; $domindex<sizeof($domains) && !$foundConnection; $domindex++) {
    $domainCheck = trim($domains[$domindex]);
    if (strpos(strtolower($_SERVER["SERVER_NAME"]),strtolower($domainCheck)) !== false && ($domainCheck == "" || strpos(strtolower($_SERVER["SERVER_NAME"]),strtolower($domainCheck)) == strlen($_SERVER["SERVER_NAME"])-strlen($domainCheck))) {
      $hostname_local_local = "localhost";
      $database_local_local = "hyberion_battlecomm";
      $username_local_local = "hyberion_dbadmin";
      $password_local_local = "opensesame1234";
      $foundConnection = true;
    } 
  } 
} 

$local_local = mysql_pconnect($hostname_local_local, $username_local_local, $password_local_local) or trigger_error(mysql_error(),E_USER_ERROR); 

?>