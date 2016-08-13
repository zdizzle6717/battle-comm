<?php require_once('../../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../../webassist/mysqli/queryobj.php'); ?>
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
  $UpdateGoTo = "../index.php";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="../../Styles/form-blue.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "PlayerProfile" */
       jQuery.dmxDataSet(
         {"id": "PlayerProfile", "url": "../../dmxDatabaseSources/PlayerProfileEdit.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "PlayerProfile" */
</script>
</head>

<body>
<p>Edit Profile 

<?php include("../../tool/nav.php"); ?>
</p>
 <p>&nbsp;</p>
<form class="formoid-default-skyblue" style="background-color:#FFFFFF;font-size:14px;font-family:'Open Sans','Helvetica Neue','Helvetica',Arial,Verdana,sans-serif;color:#666666;max-width:480px;min-width:150px" method="post"><div class="title"><h2>Profile Contact Edit</h2></div>
  <div class="element-input"><label class="title">First Name</label><input name="FirstName" type="text" class="large" id="FirstName" value="{{PlayerProfile.data[0].firstName}}" /></div>
  <div class="element-input"><label class="title">Last Name</label><input name="LastName" type="text" class="large" id="LastName" value="{{PlayerProfile.data[0].lastName}}" /></div>
  <div class="element-input"><label class="title">Handle</label><input name="Handle" type="text" class="large" id="Handle" value="{{PlayerProfile.data[0].user_handle}}" /></div>
  <div class="element-input"><label class="title">Email</label><input name="Email" type="text" class="large" id="Email" value="{{PlayerProfile.data[0].email}}" /></div>
<div class="submit"><input type="submit" value="Submit"/></div></form>
<p>&nbsp;</p>
</body>
</html>