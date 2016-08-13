<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: Logged Out</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/magnificent-popup/magnificent-popup.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
</head>
	<?php include 'Templates/parts/header.php'; ?>  
        <?php include 'Templates/parts/container-top.php'; ?>  
<?php 
@session_start();
if ("" == ""){
  // WA_ClearSession
	$clearAll = TRUE;
	$clearThese = explode(",","");
	if($clearAll){
		foreach ($_SESSION as $key => $value){
			unset($_SESSION[$key]);
		}
	}
	else{
		foreach($clearThese as $value){
			unset($_SESSION[$value]);
		}
	}
}
?>
<div id="LogOutContainer" class="WAATK">
  <h1>Log Out</h1>
  You have successfully logged out. <br/>
  <h3><a href="/">Return home?</a></h3>
  </div>
	<?php include 'Templates/parts/container-bottom.php'; ?>
<?php include 'Templates/parts/footer.php'; ?>