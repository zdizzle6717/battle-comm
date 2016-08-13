<?php require_once('../Connections/local.php'); ?>
<?php require_once("../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userloginupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["email"])?$_POST["email"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"0")  ."","email","',none,''","".((isset($_POST["email"]))?$_POST["email"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["user_handle"])?$_POST["user_handle"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"0")  ."","user_handle","',none,''","".((isset($_POST["user_handle"]))?$_POST["user_handle"]:"")  ."",true,4);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_main_phone"])?$_POST["user_main_phone"]:"") . "",false,true,false,5);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_mobile_phone"])?$_POST["user_mobile_phone"]:"") . "",false,true,false,6);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_work_phone"])?$_POST["user_work_phone"]:"") . "",false,true,false,7);
  $WAFV_Errors .= WAValidateZC((isset($_POST["user_zip"])?$_POST["user_zip"]:"") . "",true,false,false,false,false,8);
  $WAFV_Errors .= WAValidateDT((isset($_POST["user_Date_of_Birth"])?$_POST["user_Date_of_Birth"]:"") . "",true,"","","",false,"","","",false,9);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userloginupdate");
   }
 }
 ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}
?>
<?php
$Paramid_WADAuser_login = "-1";
if (isset($_GET['id'])) {
  $Paramid_WADAuser_login = $_GET['id'];
}
mysql_select_db($database_local, $local);
$query_WADAuser_login = sprintf("SELECT id, email, firstName, lastName, user_handle, user_main_phone, user_mobile_phone, user_work_phone, user_street_address, user_apt_suite, user_city, user_state, user_zip, user_Date_of_Birth, user_bio, user_facebook, user_twitter, user_instagram, user_google_plus, user_youtube, user_twitch, user_website, user_points, user_visibility, user_share_contact, user_share_name, user_share_status, user_newsletter, user_marketing, user_sms, user_allow_play FROM user_login WHERE id = %s", GetSQLValueString($Paramid_WADAuser_login, "int"));
$WADAuser_login = mysql_query($query_WADAuser_login, $local) or die(mysql_error());
$row_WADAuser_login = mysql_fetch_assoc($WADAuser_login);
$totalRows_WADAuser_login = mysql_num_rows($WADAuser_login);
?>
<?php
mysql_select_db($database_local, $local);
$query_WADAMenuuser_state = "SELECT state_name, state_abbr FROM tbl_state ORDER BY state_name ASC";
$WADAMenuuser_state = mysql_query($query_WADAMenuuser_state, $local) or die(mysql_error());
$row_WADAMenuuser_state = mysql_fetch_assoc($WADAMenuuser_state);
$totalRows_WADAMenuuser_state = mysql_num_rows($WADAMenuuser_state);
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_redirectURL = "user_login_update.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_indexField = "id";
  $WA_fieldNamesStr = "email|firstName|lastName|user_handle|user_main_phone|user_mobile_phone|user_work_phone|user_street_address|user_apt_suite|user_city|user_state|user_zip|user_Date_of_Birth|user_bio|user_facebook|user_twitter|user_instagram|user_google_plus|user_youtube|user_twitch|user_website|user_points|user_visibility|user_share_contact|user_share_name|user_share_status|user_newsletter|user_marketing|user_sms|user_allow_play";
  $WA_fieldValuesStr = "".((isset($_POST["email"]))?$_POST["email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["firstName"]))?$_POST["firstName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["lastName"]))?$_POST["lastName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_handle"]))?$_POST["user_handle"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_main_phone"]))?$_POST["user_main_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_mobile_phone"]))?$_POST["user_mobile_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_work_phone"]))?$_POST["user_work_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_street_address"]))?$_POST["user_street_address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_apt_suite"]))?$_POST["user_apt_suite"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_city"]))?$_POST["user_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_state"]))?$_POST["user_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_zip"]))?$_POST["user_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_Date_of_Birth"]) && $_POST["user_Date_of_Birth"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["user_Date_of_Birth"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["user_bio"]))?$_POST["user_bio"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_facebook"]))?$_POST["user_facebook"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitter"]))?$_POST["user_twitter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_instagram"]))?$_POST["user_instagram"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_google_plus"]))?$_POST["user_google_plus"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_youtube"]))?$_POST["user_youtube"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitch"]))?$_POST["user_twitch"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_website"]))?$_POST["user_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_points"]))?$_POST["user_points"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_visibility"]))?$_POST["user_visibility"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_contact"]))?$_POST["user_share_contact"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_name"]))?$_POST["user_share_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_status"]))?$_POST["user_share_status"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_newsletter"]))?$_POST["user_newsletter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_marketing"]))?$_POST["user_marketing"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_sms"]))?$_POST["user_sms"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_allow_play"]))?$_POST["user_allow_play"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = "=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  
  $WA_where_fieldValuesStr = "".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."";
  $WA_where_columnTypesStr = "',none,''";
  $WA_where_comparisonStr = "=";
  $WA_where_fieldNames = explode("|", $WA_indexField);
  $WA_where_fieldValues = explode($WA_AB_Split, $WA_where_fieldValuesStr);
  $WA_where_columns = explode("|", $WA_where_columnTypesStr);
  $WA_where_comparisons = explode("|", $WA_where_comparisonStr);
  
  $WA_connectionDB = $database_local;
  mysql_select_db($WA_connectionDB, $WA_connection);
  @session_start();
  $updateParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WhereObj = WA_AB_generateWhereClause($WA_where_fieldNames, $WA_where_columns, $WA_where_fieldValues,  $WA_where_comparisons );
  $WA_Sql = "UPDATE `" . $WA_table . "` SET " . $updateParamsObj->WA_setValues . " WHERE " . $WhereObj->sqlWhereClause . "";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  if ($WA_redirectURL != "")  {
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
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
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: Edit Account</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/form_clean.css">
    <link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../webassist/jq_validation/Bloom.css">
    <link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
    <link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
     <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
	<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
$(function(){
	$('#user_Date_of_Birth').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_user_Date_of_Birth
	});
});
function closeDatePicker_user_Date_of_Birth() {
	var tElm = $('#user_Date_of_Birth');
	if (typeof user_Date_of_Birth_Spry != null && typeof user_Date_of_Birth_Spry != "undefined" && user_Date_of_Birth_Spry.validate) {
		user_Date_of_Birth_Spry.validate();
	}
	tElm.blur();
}
</script>
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
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
			<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>{{LoggedInUser.data[0].firstName}} {{LoggedInUser.data[0].lastName}}'s Account Details</h2>
                        	<div class="full_width">
<div id="Update_Basic_Default_ProgressWrapper">
<form class="clean" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
 <span class="fieldsetDescription">
 Required = *
 </span>
 <div class="full_width">
<fieldset>
	<legend>Player Info</legend>
<ol>
    <li> <label for="firstName" class="sublabel" > First Name:</label>
  <input id="firstName" name="firstName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","firstName"):"".$row_WADAuser_login["firstName"]."")); ?>" class="formTextfield_Large" tabindex="2" title="Please enter a value.">
    </li> 
    <li> <label for="lastName" class="sublabel" > Last Name:</label>
  <input id="lastName" name="lastName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","lastName"):"".$row_WADAuser_login["lastName"]."")); ?>" class="formTextfield_Large" tabindex="3" title="Please enter a value.">
    </li> 
    <li> <label for="email" class="sublabel" > Email:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="email" name="email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","email"):"".$row_WADAuser_login["email"]."")); ?>" class="formTextfield_Medium" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="email_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(1,2:)
    }
  }
}?>
    </li> 
    <li> <label for="user_handle" class="sublabel" > Handle/Nickname:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="user_handle" name="user_handle" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_handle"):"".$row_WADAuser_login["user_handle"]."")); ?>" class="formTextfield_Large" tabindex="4" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "3" . ",") !== false || "3" == "") || (strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_handle_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(3,4:)
    }
  }
}?>
    </li> 
    <li> <label for="user_main_phone" class="sublabel" > Main Phone:</label>
  <input id="user_main_phone" name="user_main_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_main_phone"):"".$row_WADAuser_login["user_main_phone"]."")); ?>" class="formTextfield_Medium" tabindex="5" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Update_Basic_Default').user_main_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Update_Basic_Default').user_main_phone,0,true);">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_main_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(5:)
    }
  }
}?>
    </li> 
    <li> <label for="user_mobile_phone" class="sublabel" > Mobile Phone:</label>
  <input id="user_mobile_phone" name="user_mobile_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_mobile_phone"):"".$row_WADAuser_login["user_mobile_phone"]."")); ?>" class="formTextfield_Medium" tabindex="6" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Update_Basic_Default').user_mobile_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Update_Basic_Default').user_mobile_phone,0,true);">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_mobile_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(6:)
    }
  }
}?>
    </li> 
    <li> <label for="user_work_phone" class="sublabel" > Work Phone:</label>
  <input id="user_work_phone" name="user_work_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_work_phone"):"".$row_WADAuser_login["user_work_phone"]."")); ?>" class="formTextfield_Medium" tabindex="7" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Update_Basic_Default').user_work_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Update_Basic_Default').user_work_phone,0,true);">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_work_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(7:)
    }
  }
}?>
    </li> 
    <li> <label for="user_street_address" class="sublabel" > Street Address:</label>
  <input id="user_street_address" name="user_street_address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_street_address"):"".$row_WADAuser_login["user_street_address"]."")); ?>" class="formTextfield_Large" tabindex="8" title="Please enter a value.">
    </li> 
    <li> <label for="user_apt_suite" class="sublabel" > Apt/Suite:</label>
  <input id="user_apt_suite" name="user_apt_suite" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_apt_suite"):"".$row_WADAuser_login["user_apt_suite"]."")); ?>" class="formTextfield_Small" tabindex="9" title="Please enter a value.">
    </li> 
    <li> <label for="user_city" class="sublabel" > City:</label>
  <input id="user_city" name="user_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_city"):"".$row_WADAuser_login["user_city"]."")); ?>" class="formTextfield_Medium" tabindex="10" title="Please enter a value.">
    </li> 
    <li> <label for="user_state" class="sublabel" > State:</label>
      <select class="formMenufield_Large" name="user_state" id="user_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_state"):"".$row_WADAuser_login["user_state"]."")); ?>" tabindex="11" title="Please enter a value.">
<option value="">Choose State...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuuser_state['state_abbr']?>"<?php if (!(strcmp($row_WADAMenuuser_state['state_abbr'], (isset($_GET["invalid"])?ValidatedField("userloginupdate","user_state"):"".$row_WADAuser_login["user_state"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuuser_state['state_name']?></option>
        <?php
} while ($row_WADAMenuuser_state = mysql_fetch_assoc($WADAMenuuser_state));
  $rows = mysql_num_rows($WADAMenuuser_state);
  if($rows > 0) {
      mysql_data_seek($WADAMenuuser_state, 0);
	  $row_WADAMenuuser_state = mysql_fetch_assoc($WADAMenuuser_state);
  }
?>
</select>
    </li> 
    <li> <label for="user_zip" class="sublabel" > Zip Code:</label>
  <input id="user_zip" name="user_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_zip"):"".$row_WADAuser_login["user_zip"]."")); ?>" class="formTextfield_Medium" tabindex="12" pattern="(\d{5}([\-]\d{4})?)" title="Please enter a value.">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "8" . ",") !== false || "8" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_zip_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(8:)
    }
  }
}?>
    </li> 
    <li> <label for="user_Date_of_Birth" class="sublabel" > Birthday:</label>
  <input id="user_Date_of_Birth" name="user_Date_of_Birth" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_Date_of_Birth"):"".(($row_WADAuser_login["user_Date_of_Birth"])?date("n/d/Y",strtotime($row_WADAuser_login["user_Date_of_Birth"])):"")."")); ?>" class="formTextfield_Medium" tabindex="13" title="Please enter a value.">
	   <?php
if (ValidatedField('userloginupdate','userloginupdate'))  {
  if ((strpos((",".ValidatedField("userloginupdate","userloginupdate").","), "," . "9" . ",") !== false || "9" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_Date_of_Birth_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_update.php userloginupdate(9:)
    }
  }
}?>
    </li>
</ol> 
</fieldset>
</div>
<div class="full_width">
<ol>
    <li> <h3 for="user_bio" class="sublabel" > Player Bio:</h3>
    <div style="display:inline-block;width:100%;"><?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_bio",false):"".$row_WADAuser_login["user_bio"].""))  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "Normal";
$CKEditor_config["wa_preset_file"] = "Normal.xml";
$CKEditor_config["width"] = "100%";
$CKEditor_config["height"] = "250px";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["toolbar"] = array(
array( 'Bold','Italic','Underline'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'NumberedList','BulletedList','-','Outdent','Indent'),
array( 'FontName','FontSize'),
array( 'TextColor'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["entities"] = false;
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("user_bio", $CKEditor_initialValue, $CKEditor_config);
?></div>
    </li> 
</ol>
</div>
<div class="two_column_1" style="padding:1%;">
<fieldset>
	<legend>Social Links</legend>
<ol>
    <li> <label for="user_facebook" class="sublabel" > Facebook:</label>
  <input id="user_facebook" name="user_facebook" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_facebook"):"".$row_WADAuser_login["user_facebook"]."")); ?>" class="formTextfield_Medium" tabindex="14" title="Please enter a value.">
    </li> 
    <li> <label for="user_twitter" class="sublabel" > Twitter:</label>
  <input id="user_twitter" name="user_twitter" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_twitter"):"".$row_WADAuser_login["user_twitter"]."")); ?>" class="formTextfield_Medium" tabindex="15" title="Please enter a value.">
    </li> 
    <li> <label for="user_instagram" class="sublabel" > Instagram:</label>
  <input id="user_instagram" name="user_instagram" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_instagram"):"".$row_WADAuser_login["user_instagram"]."")); ?>" class="formTextfield_Medium" tabindex="16" title="Please enter a value.">
    </li> 
    <li> <label for="user_google_plus" class="sublabel" > Google +:</label>
  <input id="user_google_plus" name="user_google_plus" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_google_plus"):"".$row_WADAuser_login["user_google_plus"]."")); ?>" class="formTextfield_Medium" tabindex="17" title="Please enter a value.">
    </li> 
    <li> <label for="user_youtube" class="sublabel" > YouTube:</label>
  <input id="user_youtube" name="user_youtube" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_youtube"):"".$row_WADAuser_login["user_youtube"]."")); ?>" class="formTextfield_Medium" tabindex="18" title="Please enter a value.">
    </li> 
    <li> <label for="user_twitch" class="sublabel" > Twitch:</label>
  <input id="user_twitch" name="user_twitch" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_twitch"):"".$row_WADAuser_login["user_twitch"]."")); ?>" class="formTextfield_Medium" tabindex="19" title="Please enter a value.">
    </li> 
    <li> <label for="user_website" class="sublabel" > Personal Website:</label>
  <input id="user_website" name="user_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_website"):"".$row_WADAuser_login["user_website"]."")); ?>" class="formTextfield_Medium" tabindex="20" title="Please enter a value.">
    </li> 
</ol>
</fieldset>
</div>
<div class="two_column_1" style="padding:1%;">
<fieldset>
	<legend>Notification Settings</legend>
<ol>
    <li> <label for="user_visibility__1" class="sublabel" > Visible to Other Players:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_visibility__1">
          Yes&nbsp;<input type="radio" name="user_visibility" id="user_visibility__1" value="Yes" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_visibility"):"".$row_WADAuser_login["user_visibility"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="21" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_visibility__2">
          No&nbsp;<input type="radio" name="user_visibility" id="user_visibility__2" value="no" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_visibility"):"".$row_WADAuser_login["user_visibility"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="22"></label>
		</span>
</span>
    </li> 
    <li> <label for="user_share_contact__1" class="sublabel" > Share Contact Information:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_share_contact__1">
          Yes&nbsp;<input type="radio" name="user_share_contact" id="user_share_contact__1" value="Yes" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_share_contact"):"".$row_WADAuser_login["user_share_contact"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="23" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_share_contact__2">
          No&nbsp;<input type="radio" name="user_share_contact" id="user_share_contact__2" value="no" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_share_contact"):"".$row_WADAuser_login["user_share_contact"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="24"></label>
		</span>
</span>
    </li> 
    <li> <label for="user_share_name__1" class="sublabel" > Share Name:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_share_name__1">
          Yes&nbsp;<input type="radio" name="user_share_name" id="user_share_name__1" value="Yes" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_share_name"):"".$row_WADAuser_login["user_share_name"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="25" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_share_name__2">
          No&nbsp;<input type="radio" name="user_share_name" id="user_share_name__2" value="no" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_share_name"):"".$row_WADAuser_login["user_share_name"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="26"></label>
		</span>
</span>
    </li> 
    <li> <label for="user_share_status__1" class="sublabel" > Share Current Status:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_share_status__1">
          Yes&nbsp;<input type="radio" name="user_share_status" id="user_share_status__1" value="Yes" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_share_status"):"".$row_WADAuser_login["user_share_status"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="27" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_share_status__2">
          No&nbsp;<input type="radio" name="user_share_status" id="user_share_status__2" value="no" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_share_status"):"".$row_WADAuser_login["user_share_status"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="28"></label>
		</span>
</span>
    </li> 
    <li> <label for="user_newsletter__1" class="sublabel" > Subscribed to Newsletter:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_newsletter__1">
          Yes&nbsp;<input type="radio" name="user_newsletter" id="user_newsletter__1" value="Yes" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_newsletter"):"".$row_WADAuser_login["user_newsletter"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="29" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_newsletter__2">
          No&nbsp;<input type="radio" name="user_newsletter" id="user_newsletter__2" value="no" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_newsletter"):"".$row_WADAuser_login["user_newsletter"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="30"></label>
		</span>
</span>
    </li> 
    <li> <label for="user_marketing__1" class="sublabel" > Allow Marketing Communications:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_marketing__1">
          Yes&nbsp;<input type="radio" name="user_marketing" id="user_marketing__1" value="Yes" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_marketing"):"".$row_WADAuser_login["user_marketing"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="31" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_marketing__2">
          No&nbsp;<input type="radio" name="user_marketing" id="user_marketing__2" value="no" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_marketing"):"".$row_WADAuser_login["user_marketing"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="32"></label>
		</span>
</span>
    </li> 
    <li> <label for="user_sms__1" class="sublabel" > Allow SMS:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_sms__1">
          Yes&nbsp;<input type="radio" name="user_sms" id="user_sms__1" value="Yes" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_sms"):"".$row_WADAuser_login["user_sms"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="33" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_sms__2">
          No&nbsp;<input type="radio" name="user_sms" id="user_sms__2" value="no" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_sms"):"".$row_WADAuser_login["user_sms"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="34"></label>
		</span>
</span>
    </li> 
    <li> <label for="user_allow_play__1" class="sublabel" > Allow Play Requests:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_allow_play__1">
          Yes&nbsp;<input type="radio" name="user_allow_play" id="user_allow_play__1" value="Yes" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_allow_play"):"".$row_WADAuser_login["user_allow_play"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="35" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_allow_play__2">
          No&nbsp;<input type="radio" name="user_allow_play" id="user_allow_play__2" value="no" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_allow_play"):"".$row_WADAuser_login["user_allow_play"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="36"></label>
		</span>
</span>
    </li> 
</ol>
</fieldset>
</div>

	<div class="full_width" >
		<div class="center">
        <span class="buttonFieldGroup" >
  <input id="user_points" name="user_points" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","user_points"):"".$row_WADAuser_login["user_points"]."")); ?>">
<input type="submit" value="Update" class="Modular" id="Update" name="Update" />
        </span>
        </div>
    </div>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userloginupdate","WADAUpdateRecordID"):$_GET["id"])); ?>" />
</form></div><div id="Update_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Default', 'Update_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Update_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>
</div>
 
  		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 

<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
<script src="../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Update_Basic_Default_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Bloom",
    pointedAt: "left",
    fieldOffset: 10,
    fieldMargin: 2,
    position: "left",
    direction: "left",
    border: 1,
    offset: 25,
    closeText: "✖",
    percentWidth: 100,
    orientation: "bottom"
  };
function Update_Basic_Default_Validate() {
    $("#Update_Basic_Default").h5Validate(Update_Basic_Default_Opts);
  }
$(document).ready(function () {
  Update_Basic_Default_Validate()
  ConvertServerErrors(Update_Basic_Default_Opts);
});
</script>


<?php
mysql_free_result($WADAuser_login);
?>
<?php
mysql_free_result($WADAMenuuser_state);
?>
