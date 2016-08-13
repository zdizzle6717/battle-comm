<?php require_once("../../../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../../../Connections/local.php'); ?>
<?php require_once("../../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userprofileupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidatePN((isset($_POST["user_main_phone"])?$_POST["user_main_phone"]:"") . "",false,true,false,1);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_mobile_phone"])?$_POST["user_mobile_phone"]:"") . "",false,true,false,2);
  $WAFV_Errors .= WAValidateDT((isset($_POST["user_birthday"])?$_POST["user_birthday"]:"") . "",true,"","","",false,"","","",false,3);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userprofileupdate");
   }
 }
 ?>
<?php require_once("../../../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../../../webassist/database_management/wa_appbuilder_php.php"); ?>
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
$Paramiduser_profile_WADAuser_profile = "-1";
if (isset($_GET['iduser_profile'])) {
  $Paramiduser_profile_WADAuser_profile = $_GET['iduser_profile'];
}
mysql_select_db($database_local, $local);
$query_WADAuser_profile = sprintf("SELECT iduser_profile, userID, user_main_phone, user_mobile_phone, user_work_phone, user_street_address, user_apt_suite, user_city, user_zip, user_dateJoined, user_birthday, user_bio, user_facebook, user_twitter, user_instagram, user_google_plus, user_youtube, user_twitch, user_website, user_internal_notes, user_security_level, user_points, user_cash_value, user_visibility, user_share_contact, user_share_social, user_share_name, user_share_status, user_newsletter, user_marketing, user_allow_sms, user_mobile_carrier, user_allow_play_requests, user_icon, totalWins, totalLoss, totalDraw, accountActive FROM user_profile WHERE iduser_profile = %s", GetSQLValueString($Paramiduser_profile_WADAuser_profile, "int"));
$WADAuser_profile = mysql_query($query_WADAuser_profile, $local) or die(mysql_error());
$row_WADAuser_profile = mysql_fetch_assoc($WADAuser_profile);
$totalRows_WADAuser_profile = mysql_num_rows($WADAuser_profile);
?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../../uploads/player/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "".($row_WADAuser_profile["user_icon"])  ."",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["Update"]) || isset($_POST["Update_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "user_icon", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_profile";
  $WA_redirectURL = "user_profile_results.php?iduser_profile=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAuser_profile"])?"&pageNum_WADAuser_profile=".intval($_GET["pageNum_WADAuser_profile"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "iduser_profile";
  $WA_fieldNamesStr = "userID|user_main_phone|user_mobile_phone|user_work_phone|user_street_address|user_apt_suite|user_city|user_zip|user_dateJoined|user_birthday|user_bio|user_facebook|user_twitter|user_instagram|user_google_plus|user_youtube|user_twitch|user_website|user_internal_notes|user_security_level|user_points|user_cash_value|user_visibility|user_share_contact|user_share_social|user_share_name|user_share_status|user_newsletter|user_marketing|user_allow_sms|user_mobile_carrier|user_allow_play_requests|user_icon|totalWins|totalLoss|totalDraw|accountActive";
  $WA_fieldValuesStr = "".((isset($_POST["userID"]))?$_POST["userID"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_main_phone"]))?$_POST["user_main_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_mobile_phone"]))?$_POST["user_mobile_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_work_phone"]))?$_POST["user_work_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_street_address"]))?$_POST["user_street_address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_apt_suite"]))?$_POST["user_apt_suite"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_city"]))?$_POST["user_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_zip"]))?$_POST["user_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_dateJoined"]) && $_POST["user_dateJoined"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["user_dateJoined"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["user_birthday"]) && $_POST["user_birthday"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["user_birthday"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["user_bio"]))?$_POST["user_bio"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_facebook"]))?$_POST["user_facebook"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitter"]))?$_POST["user_twitter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_instagram"]))?$_POST["user_instagram"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_google_plus"]))?$_POST["user_google_plus"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_youtube"]))?$_POST["user_youtube"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitch"]))?$_POST["user_twitch"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_website"]))?$_POST["user_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_internal_notes"]))?$_POST["user_internal_notes"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_security_level"]))?$_POST["user_security_level"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_points"]))?$_POST["user_points"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_cash_value"]))?$_POST["user_cash_value"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_visibility"]))?$_POST["user_visibility"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_contact"]))?$_POST["user_share_contact"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_social"]))?$_POST["user_share_social"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_name"]))?$_POST["user_share_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_status"]))?$_POST["user_share_status"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_newsletter"]))?$_POST["user_newsletter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_marketing"]))?$_POST["user_marketing"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_allow_sms"]))?$_POST["user_allow_sms"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_mobile_carrier"]))?$_POST["user_mobile_carrier"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_allow_play_requests"]))?$_POST["user_allow_play_requests"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["totalWins"]))?$_POST["totalWins"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["totalLoss"]))?$_POST["totalLoss"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["totalDraw"]))?$_POST["totalDraw"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["accountActive"]))?$_POST["accountActive"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | = | = | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE ";
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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../../webassist/jq_validation/Bloom.css">
<link type="text/css" href="../../../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
$(function(){
	$('#user_birthday').datepicker({
		changeMonth: true,
		changeYear: true,
		onClose: closeDatePicker_user_birthday
	});
});
function closeDatePicker_user_birthday() {
	var tElm = $('#user_birthday');
	if (typeof user_birthday_Spry != null && typeof user_birthday_Spry != "undefined" && user_birthday_Spry.validate) {
		user_birthday_Spry.validate();
	}
	tElm.blur();
}
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="file:///C|/xampp/htdocs/testBC/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Default" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
          <legend class="groupHeader">Update</legend>
    <div class="lineGroup"> <label for="user_main_phone" class="sublabel" > Phone:</label>
  <input id="user_main_phone" name="user_main_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_main_phone"):"".$row_WADAuser_profile["user_main_phone"]."")); ?>" class="formTextfield_Medium" tabindex="1" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Update_Basic_Default').user_main_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Update_Basic_Default').user_main_phone,0,true);">
	   <?php
if (ValidatedField('userprofileupdate','userprofileupdate'))  {
  if ((strpos((",".ValidatedField("userprofileupdate","userprofileupdate").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_main_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_update.php userprofileupdate(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_mobile_phone" class="sublabel" > Mobile Phone:</label>
  <input id="user_mobile_phone" name="user_mobile_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_mobile_phone"):"".$row_WADAuser_profile["user_mobile_phone"]."")); ?>" class="formTextfield_Medium" tabindex="2" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Update_Basic_Default').user_mobile_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Update_Basic_Default').user_mobile_phone,0,true);">
	   <?php
if (ValidatedField('userprofileupdate','userprofileupdate'))  {
  if ((strpos((",".ValidatedField("userprofileupdate","userprofileupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_mobile_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_update.php userprofileupdate(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_work_phone" class="sublabel" > Work Phone:</label>
  <input id="user_work_phone" name="user_work_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_work_phone"):"".$row_WADAuser_profile["user_work_phone"]."")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_street_address" class="sublabel" > Street Address:</label>
  <input id="user_street_address" name="user_street_address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_street_address"):"".$row_WADAuser_profile["user_street_address"]."")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_apt_suite" class="sublabel" > Apt/Suite:</label>
  <input id="user_apt_suite" name="user_apt_suite" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_apt_suite"):"".$row_WADAuser_profile["user_apt_suite"]."")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_city" class="sublabel" > City:</label>
  <input id="user_city" name="user_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_city"):"".$row_WADAuser_profile["user_city"]."")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_zip" class="sublabel" > Zip Code:</label>
  <input id="user_zip" name="user_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_zip"):"".$row_WADAuser_profile["user_zip"]."")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_birthday" class="sublabel" > user_birthday:</label>
  <input id="user_birthday" name="user_birthday" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_birthday"):"".(($row_WADAuser_profile["user_birthday"])?date("n/d/Y",strtotime($row_WADAuser_profile["user_birthday"])):"")."")); ?>" class="formTextfield_Medium" tabindex="8" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileupdate','userprofileupdate'))  {
  if ((strpos((",".ValidatedField("userprofileupdate","userprofileupdate").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_birthday_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_update.php userprofileupdate(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_bio" class="sublabel" > About/Bio:</label><div style="display:inline-block"><?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_bio",false):"".$row_WADAuser_profile["user_bio"].""))  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../../../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "Full";
$CKEditor_config["wa_preset_file"] = "Full.xml";
$CKEditor_config["width"] = "514px";
$CKEditor_config["height"] = "350px";
$CKEditor_config["dialog_startupFocusTab"] = false;
$CKEditor_config["fullPage"] = false;
$CKEditor_config["tabSpaces"] = 4;
$CKEditor_config["toolbar"] = array(
array( 'Cut','Copy','Paste','SpellCheck'),
array( 'Undo','Redo'),
array( 'Bold','Italic','Underline','Subscript','Superscript'),
array( 'NumberedList','BulletedList','-','Outdent','Indent'),
array( 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array( 'Link','Unlink','Anchor'),
array( 'Table','Rule','SpecialChar'),
array( 'FontName','FontSize'),
array( 'TextColor','BGColor'));
$CKEditor_config["contentsLangDirection"] = "ltr";
$CKEditor_config["entities"] = false;
$CKEditor_config["pasteFromWordRemoveFontStyles"] = false;
$CKEditor_config["pasteFromWordRemoveStyles"] = false;
$CKEditor->editor("user_bio", $CKEditor_initialValue, $CKEditor_config);
?></div>
    </div> 
    <div class="lineGroup"> <label for="user_facebook" class="sublabel" > Facebook:</label>
  <input id="user_facebook" name="user_facebook" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_facebook"):"".$row_WADAuser_profile["user_facebook"]."")); ?>" class="formTextfield_Medium" tabindex="9" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_twitter" class="sublabel" > Twitter:</label>
  <input id="user_twitter" name="user_twitter" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_twitter"):"".$row_WADAuser_profile["user_twitter"]."")); ?>" class="formTextfield_Medium" tabindex="10" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_instagram" class="sublabel" > Instagram:</label>
  <input id="user_instagram" name="user_instagram" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_instagram"):"".$row_WADAuser_profile["user_instagram"]."")); ?>" class="formTextfield_Medium" tabindex="11" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_google_plus" class="sublabel" > Google+:</label>
  <input id="user_google_plus" name="user_google_plus" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_google_plus"):"".$row_WADAuser_profile["user_google_plus"]."")); ?>" class="formTextfield_Medium" tabindex="12" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_youtube" class="sublabel" > YouTube:</label>
  <input id="user_youtube" name="user_youtube" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_youtube"):"".$row_WADAuser_profile["user_youtube"]."")); ?>" class="formTextfield_Medium" tabindex="13" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_twitch" class="sublabel" > Twitch:</label>
  <input id="user_twitch" name="user_twitch" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_twitch"):"".$row_WADAuser_profile["user_twitch"]."")); ?>" class="formTextfield_Medium" tabindex="14" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_website" class="sublabel" > Website:</label>
  <input id="user_website" name="user_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_website"):"".$row_WADAuser_profile["user_website"]."")); ?>" class="formTextfield_Medium" tabindex="15" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_internal_notes" class="sublabel" > Notes:</label>
  <textarea name="user_internal_notes" id="user_internal_notes" class="formTextarea_Medium" rows="1" cols="1" tabindex="16" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_internal_notes"):"".$row_WADAuser_profile["user_internal_notes"]."")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="user_security_level" class="sublabel" > Security Level:</label>
      <select class="formMenufield_Medium" name="user_security_level" id="user_security_level" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_security_level"):"".$row_WADAuser_profile["user_security_level"]."")); ?>" tabindex="17" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="user_points" class="sublabel" > Points:</label>
  <input id="user_points" name="user_points" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_points"):"".$row_WADAuser_profile["user_points"]."")); ?>" class="formTextfield_Medium" tabindex="18" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_cash_value" class="sublabel" > Cash Value:</label>
  <input id="user_cash_value" name="user_cash_value" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_cash_value"):"".$row_WADAuser_profile["user_cash_value"]."")); ?>" class="formTextfield_Medium" tabindex="19" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_visibility" class="sublabel" > Visibility:</label>
      <select class="formMenufield_Medium" name="user_visibility" id="user_visibility" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_visibility"):"".$row_WADAuser_profile["user_visibility"]."")); ?>" tabindex="20" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="user_share_contact" class="sublabel" > Share Contact Information:</label>
  <input id="user_share_contact" name="user_share_contact" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_share_contact"):"".$row_WADAuser_profile["user_share_contact"]."")); ?>" class="formTextfield_Medium" tabindex="21" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_share_social" class="sublabel" > Share Social Links:</label>
  <input id="user_share_social" name="user_share_social" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_share_social"):"".$row_WADAuser_profile["user_share_social"]."")); ?>" class="formTextfield_Medium" tabindex="22" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_share_name" class="sublabel" > Share Name:</label>
  <input id="user_share_name" name="user_share_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_share_name"):"".$row_WADAuser_profile["user_share_name"]."")); ?>" class="formTextfield_Medium" tabindex="23" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_share_status" class="sublabel" > Share Status:</label>
  <input id="user_share_status" name="user_share_status" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_share_status"):"".$row_WADAuser_profile["user_share_status"]."")); ?>" class="formTextfield_Medium" tabindex="24" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_newsletter__1" class="sublabel" > Subscribe Newsletter:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_newsletter__1">
          yes&nbsp;<input type="radio" name="user_newsletter" id="user_newsletter__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_newsletter"):"".$row_WADAuser_profile["user_newsletter"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="25" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_newsletter__2">
          no&nbsp;<input type="radio" name="user_newsletter" id="user_newsletter__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_newsletter"):"".$row_WADAuser_profile["user_newsletter"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="26"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_marketing__1" class="sublabel" > Subscribe Marketing:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_marketing__1">
          yes&nbsp;<input type="radio" name="user_marketing" id="user_marketing__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_marketing"):"".$row_WADAuser_profile["user_marketing"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="27" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_marketing__2">
          no&nbsp;<input type="radio" name="user_marketing" id="user_marketing__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_marketing"):"".$row_WADAuser_profile["user_marketing"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="28"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_allow_sms" class="sublabel" > Allow SMS:</label>
  <input id="user_allow_sms" name="user_allow_sms" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_allow_sms"):"".$row_WADAuser_profile["user_allow_sms"]."")); ?>" class="formTextfield_Medium" tabindex="29" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_mobile_carrier" class="sublabel" > Mobile Carrier:</label>
  <input id="user_mobile_carrier" name="user_mobile_carrier" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_mobile_carrier"):"".$row_WADAuser_profile["user_mobile_carrier"]."")); ?>" class="formTextfield_Medium" tabindex="30" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_allow_play_requests" class="sublabel" > Allow Play Requests:</label>
  <input id="user_allow_play_requests" name="user_allow_play_requests" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_allow_play_requests"):"".$row_WADAuser_profile["user_allow_play_requests"]."")); ?>" class="formTextfield_Medium" tabindex="31" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_icon" class="sublabel" > user_icon:</label>
  <input name="user_icon" type="file" id="user_icon" size="30" tabindex="32" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="totalWins" class="sublabel" > Total Wins:</label>
  <input id="totalWins" name="totalWins" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","totalWins"):"".$row_WADAuser_profile["totalWins"]."")); ?>" class="formTextfield_Medium" tabindex="33" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="totalLoss" class="sublabel" > Total Loss:</label>
  <input id="totalLoss" name="totalLoss" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","totalLoss"):"".$row_WADAuser_profile["totalLoss"]."")); ?>" class="formTextfield_Medium" tabindex="34" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="totalDraw" class="sublabel" > Total Draw:</label>
  <input id="totalDraw" name="totalDraw" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","totalDraw"):"".$row_WADAuser_profile["totalDraw"]."")); ?>" class="formTextfield_Medium" tabindex="35" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="accountActive__1" class="sublabel" > Account Active:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="accountActive__1">
          yes&nbsp;<input type="radio" name="accountActive" id="accountActive__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileupdate","accountActive"):"".$row_WADAuser_profile["accountActive"].""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="36" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="accountActive__2">
          no&nbsp;<input type="radio" name="accountActive" id="accountActive__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileupdate","accountActive"):"".$row_WADAuser_profile["accountActive"].""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="37"></label>
		</span>
</span>
    </div> 
        <span class="buttonFieldGroup" >
  <input id="userID" name="userID" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","userID"):"".$row_WADAuser_profile["userID"]."")); ?>">
  <input id="user_dateJoined" name="user_dateJoined" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","user_dateJoined"):"".(($row_WADAuser_profile["user_dateJoined"])?date("n/d/Y",strtotime($row_WADAuser_profile["user_dateJoined"])):"")."")); ?>">
<input type="submit" value="Update" class="formButton Modular" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileupdate","WADAUpdateRecordID"):$_GET["iduser_profile"])); ?>" />
</form></div><div id="Update_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Default', 'Update_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Update_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
<script src="../../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../../webassist/jq_validation/jquery.h5validate.js"></script>
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

</body>
</html>
<?php
mysql_free_result($WADAuser_profile);
?>
