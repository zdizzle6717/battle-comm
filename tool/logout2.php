<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Logged Out</title>
</head>

<body>
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
  You have successfully logged out. </div>
</body>
</html>
