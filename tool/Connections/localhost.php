<?php
# FileName="WADYN_MYSQLI_CONN.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_localhost = "localhost";
$database_localhost = "battlecomm";
$username_localhost = "root";
$password_localhost = "letmein12341234";
@session_start();
$foundConnection = false;
if ($foundConnection == false) {
  $domains = explode(",","testbattlecomm.com");
  for ($domindex = 0; $domindex<sizeof($domains) && !$foundConnection; $domindex++) {
    $domainCheck = trim($domains[$domindex]);
    if (strpos(strtolower($_SERVER["SERVER_NAME"]),strtolower($domainCheck)) !== false && ($domainCheck == "" || strpos(strtolower($_SERVER["SERVER_NAME"]),strtolower($domainCheck)) == strlen($_SERVER["SERVER_NAME"])-strlen($domainCheck))) {
      $hostname_localhost = "localhost";
      $database_localhost = "hyberion_battlecomm";
      $username_localhost = "hyberion_dbadmin";
      $password_localhost = "opensesame1234";
      $foundConnection = true;
    } 
  } 
} 

$localhost = new mysqli($hostname_localhost, $username_localhost, $password_localhost, $database_localhost);

?>