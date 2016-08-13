<?php require_once("../../../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../../../Connections/local.php'); ?>
<?php require_once("../../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userprofileinsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidatePN((isset($_POST["user_main_phone"])?$_POST["user_main_phone"]:"") . "",false,true,false,1);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_mobile_phone"])?$_POST["user_mobile_phone"]:"") . "",false,true,false,2);
  $WAFV_Errors .= WAValidateDT((isset($_POST["user_birthday"])?$_POST["user_birthday"]:"") . "",true,"","","",false,"","","",false,3);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userprofileinsert");
   }
 }
 ?>
<?php require_once("../../../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../../uploads/player/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["Insert"]) || isset($_POST["Insert_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "user_icon", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_profile";
  $WA_sessionName = "WADA_Insert_user_profile";
  $WA_redirectURL = "user_profile_update.php?iduser_profile=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "userID|user_main_phone|user_mobile_phone|user_work_phone|user_street_address|user_apt_suite|user_city|user_zip|user_dateJoined|user_birthday|user_bio|user_facebook|user_twitter|user_instagram|user_google_plus|user_youtube|user_twitch|user_website|user_internal_notes|user_security_level|user_points|user_cash_value|user_visibility|user_share_contact|user_share_social|user_share_name|user_share_status|user_newsletter|user_marketing|user_allow_sms|user_mobile_carrier|user_allow_play_requests|user_icon|totalWins|totalLoss|totalDraw|accountActive";
  $WA_fieldValuesStr = "".((isset($_POST["userID"]))?$_POST["userID"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_main_phone"]))?$_POST["user_main_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_mobile_phone"]))?$_POST["user_mobile_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_work_phone"]))?$_POST["user_work_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_street_address"]))?$_POST["user_street_address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_apt_suite"]))?$_POST["user_apt_suite"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_city"]))?$_POST["user_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_zip"]))?$_POST["user_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_dateJoined"]) && $_POST["user_dateJoined"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["user_dateJoined"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["user_birthday"]) && $_POST["user_birthday"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["user_birthday"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["user_bio"]))?$_POST["user_bio"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_facebook"]))?$_POST["user_facebook"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitter"]))?$_POST["user_twitter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_instagram"]))?$_POST["user_instagram"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_google_plus"]))?$_POST["user_google_plus"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_youtube"]))?$_POST["user_youtube"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitch"]))?$_POST["user_twitch"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_website"]))?$_POST["user_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_internal_notes"]))?$_POST["user_internal_notes"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_security_level"]))?$_POST["user_security_level"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_points"]))?$_POST["user_points"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_cash_value"]))?$_POST["user_cash_value"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_visibility"]))?$_POST["user_visibility"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_contact"]))?$_POST["user_share_contact"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_social"]))?$_POST["user_share_social"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_name"]))?$_POST["user_share_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_status"]))?$_POST["user_share_status"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_newsletter"]))?$_POST["user_newsletter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_marketing"]))?$_POST["user_marketing"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_allow_sms"]))?$_POST["user_allow_sms"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_mobile_carrier"]))?$_POST["user_mobile_carrier"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_allow_play_requests"]))?$_POST["user_allow_play_requests"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["totalWins"]))?$_POST["totalWins"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["totalLoss"]))?$_POST["totalLoss"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["totalDraw"]))?$_POST["totalDraw"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["accountActive"]))?$_POST["accountActive"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  mysql_select_db($WA_connectionDB, $WA_connection);
  @session_start();
  $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
  $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
  $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
  $_SESSION[$WA_sessionName] = mysql_insert_id($WA_connection);
  if ($WA_redirectURL != "")  {
    $WA_redirectURL = str_replace("[Insert_ID]",$_SESSION[$WA_sessionName],$WA_redirectURL);
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
<link href="../../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Insert_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Default" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Insert</legend>
    <div class="lineGroup"> <label for="user_main_phone" class="sublabel" > Phone:</label>
  <input id="user_main_phone" name="user_main_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_main_phone"):"")); ?>" class="formTextfield_Medium" tabindex="1" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').user_main_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').user_main_phone,0,true);">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_main_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_mobile_phone" class="sublabel" > Mobile Phone:</label>
  <input id="user_mobile_phone" name="user_mobile_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_mobile_phone"):"")); ?>" class="formTextfield_Medium" tabindex="2" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').user_mobile_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').user_mobile_phone,0,true);">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_mobile_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_work_phone" class="sublabel" > Work Phone:</label>
  <input id="user_work_phone" name="user_work_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_work_phone"):"")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_street_address" class="sublabel" > Street Address:</label>
  <input id="user_street_address" name="user_street_address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_street_address"):"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_apt_suite" class="sublabel" > Apt/Suite:</label>
  <input id="user_apt_suite" name="user_apt_suite" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_apt_suite"):"")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_city" class="sublabel" > City:</label>
  <input id="user_city" name="user_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_city"):"")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_zip" class="sublabel" > Zip Code:</label>
  <input id="user_zip" name="user_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_zip"):"")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_birthday" class="sublabel" > user_birthday:</label>
  <input id="user_birthday" name="user_birthday" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_birthday"):"")); ?>" class="formTextfield_Medium" tabindex="8" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_birthday_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_bio" class="sublabel" > About/Bio:</label><div style="display:inline-block"><?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_bio",false):""))  ."";
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
  <input id="user_facebook" name="user_facebook" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_facebook"):"")); ?>" class="formTextfield_Medium" tabindex="9" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_twitter" class="sublabel" > Twitter:</label>
  <input id="user_twitter" name="user_twitter" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_twitter"):"")); ?>" class="formTextfield_Medium" tabindex="10" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_instagram" class="sublabel" > Instagram:</label>
  <input id="user_instagram" name="user_instagram" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_instagram"):"")); ?>" class="formTextfield_Medium" tabindex="11" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_google_plus" class="sublabel" > Google+:</label>
  <input id="user_google_plus" name="user_google_plus" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_google_plus"):"")); ?>" class="formTextfield_Medium" tabindex="12" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_youtube" class="sublabel" > YouTube:</label>
  <input id="user_youtube" name="user_youtube" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_youtube"):"")); ?>" class="formTextfield_Medium" tabindex="13" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_twitch" class="sublabel" > Twitch:</label>
  <input id="user_twitch" name="user_twitch" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_twitch"):"")); ?>" class="formTextfield_Medium" tabindex="14" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_website" class="sublabel" > Website:</label>
  <input id="user_website" name="user_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_website"):"")); ?>" class="formTextfield_Medium" tabindex="15" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_internal_notes" class="sublabel" > Notes:</label>
  <textarea name="user_internal_notes" id="user_internal_notes" class="formTextarea_Medium" rows="1" cols="1" tabindex="16" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_internal_notes"):"")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="user_security_level" class="sublabel" > Security Level:</label>
      <select class="formMenufield_Medium" name="user_security_level" id="user_security_level" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_security_level"):"")); ?>" tabindex="17" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="user_points" class="sublabel" > Points:</label>
  <input id="user_points" name="user_points" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_points"):"")); ?>" class="formTextfield_Medium" tabindex="18" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_cash_value" class="sublabel" > Cash Value:</label>
  <input id="user_cash_value" name="user_cash_value" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_cash_value"):"")); ?>" class="formTextfield_Medium" tabindex="19" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_visibility" class="sublabel" > Visibility:</label>
      <select class="formMenufield_Medium" name="user_visibility" id="user_visibility" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_visibility"):"")); ?>" tabindex="20" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="user_share_contact" class="sublabel" > Share Contact Information:</label>
  <input id="user_share_contact" name="user_share_contact" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_share_contact"):"")); ?>" class="formTextfield_Medium" tabindex="21" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_share_social" class="sublabel" > Share Social Links:</label>
  <input id="user_share_social" name="user_share_social" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_share_social"):"")); ?>" class="formTextfield_Medium" tabindex="22" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_share_name" class="sublabel" > Share Name:</label>
  <input id="user_share_name" name="user_share_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_share_name"):"")); ?>" class="formTextfield_Medium" tabindex="23" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_share_status" class="sublabel" > Share Status:</label>
  <input id="user_share_status" name="user_share_status" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_share_status"):"")); ?>" class="formTextfield_Medium" tabindex="24" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_newsletter__1" class="sublabel" > Subscribe Newsletter:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_newsletter__1">
          yes&nbsp;<input type="radio" name="user_newsletter" id="user_newsletter__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_newsletter"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="25" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_newsletter__2">
          no&nbsp;<input type="radio" name="user_newsletter" id="user_newsletter__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_newsletter"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="26"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_marketing__1" class="sublabel" > Subscribe Marketing:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_marketing__1">
          yes&nbsp;<input type="radio" name="user_marketing" id="user_marketing__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_marketing"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="27" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_marketing__2">
          no&nbsp;<input type="radio" name="user_marketing" id="user_marketing__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_marketing"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="28"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_allow_sms" class="sublabel" > Allow SMS:</label>
  <input id="user_allow_sms" name="user_allow_sms" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_allow_sms"):"")); ?>" class="formTextfield_Medium" tabindex="29" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_mobile_carrier" class="sublabel" > Mobile Carrier:</label>
  <input id="user_mobile_carrier" name="user_mobile_carrier" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_mobile_carrier"):"")); ?>" class="formTextfield_Medium" tabindex="30" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_allow_play_requests" class="sublabel" > Allow Play Requests:</label>
  <input id="user_allow_play_requests" name="user_allow_play_requests" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_allow_play_requests"):"")); ?>" class="formTextfield_Medium" tabindex="31" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_icon" class="sublabel" > user_icon:</label>
  <input name="user_icon" type="file" id="user_icon" size="30" tabindex="32" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="totalWins" class="sublabel" > Total Wins:</label>
  <input id="totalWins" name="totalWins" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","totalWins"):"")); ?>" class="formTextfield_Medium" tabindex="33" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="totalLoss" class="sublabel" > Total Loss:</label>
  <input id="totalLoss" name="totalLoss" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","totalLoss"):"")); ?>" class="formTextfield_Medium" tabindex="34" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="totalDraw" class="sublabel" > Total Draw:</label>
  <input id="totalDraw" name="totalDraw" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","totalDraw"):"")); ?>" class="formTextfield_Medium" tabindex="35" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="accountActive__1" class="sublabel" > Account Active:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="accountActive__1">
          yes&nbsp;<input type="radio" name="accountActive" id="accountActive__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","accountActive"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="36" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="accountActive__2">
          no&nbsp;<input type="radio" name="accountActive" id="accountActive__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","accountActive"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="37"></label>
		</span>
</span>
    </div> 
        <span class="buttonFieldGroup" >
  <input id="userID" name="userID" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","userID"):"")); ?>">
  <input id="user_dateJoined" name="user_dateJoined" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_dateJoined"):"")); ?>">
<input type="submit" value="Insert" class="formButton Modular" id="Insert" name="Insert" />
        </span>
        </fieldset>
</form></div><div id="Insert_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Default', 'Insert_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
<script src="../../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Insert_Basic_Default_Opts = {
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
function Insert_Basic_Default_Validate() {
    $("#Insert_Basic_Default").h5Validate(Insert_Basic_Default_Opts);
  }
$(document).ready(function () {
  Insert_Basic_Default_Validate()
  ConvertServerErrors(Insert_Basic_Default_Opts);
});
</script>

</body>
</html>
