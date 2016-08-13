<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (($_SERVER["REQUEST_METHOD"] == "POST") && (isset($_SERVER["HTTP_REFERER"]) && strpos(urldecode($_SERVER["HTTP_REFERER"]), urldecode($_SERVER["SERVER_NAME"].$_SERVER["PHP_SELF"])) > 0) && isset($_POST)) {
  $UpdateQuery = new WA_MySQLi_Query($battlecomm_sqli);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "user_login";
  $UpdateQuery->bindColumn("email", "s", "".((isset($_POST["Email"]))?$_POST["Email"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("firstName", "s", "".((isset($_POST["FirstName"]))?$_POST["FirstName"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("lastName", "s", "".((isset($_POST["LastName"]))?$_POST["LastName"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("user_handle", "s", "".((isset($_POST["Handle"]))?$_POST["Handle"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->addFilter("id", "=", "i", "".$_SESSION['SecurityAssist_id']  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "index.php";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); 
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: My Account</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/magnificent-popup/magnificent-popup.css">
<link href="../Styles/form-blue.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
	/* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
  /* dmxDataSet name "PlayerProfile" */
       jQuery.dmxDataSet(
         {"id": "PlayerProfile", "url": "../../dmxDatabaseSources/PlayerProfileEdit.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "PlayerProfile" */
  /* dmxDataSet name "RoundAssignment" */
       jQuery.dmxDataSet(
         {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundAssignment" */
</script>
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
			<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>{{LoggedInUser.data[0].firstName}} {{LoggedInUser.data[0].lastName}}'s Profile Details</h2>
			<h4>&nbsp;</h4>
			</p>
                             <form class="formoid-default-skyblue" style="max-width:480px;min-width:150px" method="post"><div class="title"><h3>Edit Profile Details</h3></div>
  <div class="element-input"><label class="title">First Name</label><input name="FirstName" type="text" class="large" id="FirstName" value="{{PlayerProfile.data[0].firstName}}" /></div>
  <div class="element-input"><label class="title">Last Name</label><input name="LastName" type="text" class="large" id="LastName" value="{{PlayerProfile.data[0].lastName}}" /></div>
  <div class="element-input"><label class="title">Handle</label><input name="Handle" type="text" class="large" id="Handle" value="{{PlayerProfile.data[0].user_handle}}" /></div>
  <div class="element-input"><label class="title">Email</label><input name="Email" type="text" class="large" id="Email" value="{{PlayerProfile.data[0].email}}" /></div>
<div class="submit"><input type="submit" value="Submit"/></div></form></p>
            
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 