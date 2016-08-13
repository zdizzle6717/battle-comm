<?php
mysql_select_db($database_local, $local);
$query_WADAMenuuser_state = "SELECT state_name, state_abbr FROM tbl_state ORDER BY state_name ASC";
$WADAMenuuser_state = mysql_query($query_WADAMenuuser_state, $local) or die(mysql_error());
$row_WADAMenuuser_state = mysql_fetch_assoc($WADAMenuuser_state);
$totalRows_WADAMenuuser_state = mysql_num_rows($WADAMenuuser_state);
?>
<?php require_once("../webassist/security_assist/wa_md5encryption.php"); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_sessionName = "WADA_Insert_user_login";
  $WA_redirectURL = "user_login_update.php?id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "user_handle|email|password|firstName|lastName|user_main_phone|user_mobile_phone|user_work_phone|user_street_address|user_apt_suite|user_city|user_state|user_zip|user_Date_of_Birth|user_bio|user_facebook|user_twitter|user_instagram|user_google_plus|user_youtube|user_twitch|user_website|user_points|user_visibility|user_share_contact|user_share_name|user_share_status|user_newsletter|user_marketing|user_sms|user_allow_play|user_icon";
  $WA_fieldValuesStr = "".((isset($_POST["user_handle"]))?$_POST["user_handle"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["email"]))?$_POST["email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["password"]))?WA_MD5Encryption($_POST["password"]):"")  ."" . $WA_AB_Split . "".((isset($_POST["firstName"]))?$_POST["firstName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["lastName"]))?$_POST["lastName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_main_phone"]))?$_POST["user_main_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_mobile_phone"]))?$_POST["user_mobile_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_work_phone"]))?$_POST["user_work_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_street_address"]))?$_POST["user_street_address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_apt_suite"]))?$_POST["user_apt_suite"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_city"]))?$_POST["user_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_state"]))?$_POST["user_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_zip"]))?$_POST["user_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_Date_of_Birth"]) && $_POST["user_Date_of_Birth"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["user_Date_of_Birth"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["user_bio"]))?$_POST["user_bio"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_facebook"]))?$_POST["user_facebook"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitter"]))?$_POST["user_twitter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_instagram"]))?$_POST["user_instagram"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_google_plus"]))?$_POST["user_google_plus"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_youtube"]))?$_POST["user_youtube"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitch"]))?$_POST["user_twitch"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_website"]))?$_POST["user_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_points"]))?$_POST["user_points"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_visibility"]))?$_POST["user_visibility"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_contact"]))?$_POST["user_share_contact"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_name"]))?$_POST["user_share_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_status"]))?$_POST["user_share_status"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_newsletter"]))?$_POST["user_newsletter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_marketing"]))?$_POST["user_marketing"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_sms"]))?$_POST["user_sms"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_allow_play"]))?$_POST["user_allow_play"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
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
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../uploads/player/".$_SESSION['SecurityAssist_id']  ."/",
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
<?php require_once('../Connections/local.php'); ?>
<?php require_once("../webassist/ckeditor/ckeditor.php"); ?>
<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userlogininsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["user_handle"])?$_POST["user_handle"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","0","user_handle","',none,''","".((isset($_POST["user_handle"]))?$_POST["user_handle"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateEM((isset($_POST["email"])?$_POST["email"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","0","email","',none,''","".((isset($_POST["email"]))?$_POST["email"]:"")  ."",true,4);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["password"])?$_POST["password"]:"") . "",true,5);
  $WAFV_Errors .= WAValidateLE((isset($_POST["password_Confirm"])?$_POST["password_Confirm"]:"") . "",(isset($_POST["password_Confirm"])?$_POST["password_Confirm"]:"") . "",true,6);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_main_phone"])?$_POST["user_main_phone"]:"") . "",false,true,false,7);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_mobile_phone"])?$_POST["user_mobile_phone"]:"") . "",false,true,false,8);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_work_phone"])?$_POST["user_work_phone"]:"") . "",false,true,false,9);
  $WAFV_Errors .= WAValidateZC((isset($_POST["user_zip"])?$_POST["user_zip"]:"") . "",true,false,false,false,false,10);
  $WAFV_Errors .= WAValidateDT((isset($_POST["user_Date_of_Birth"])?$_POST["user_Date_of_Birth"]:"") . "",true,"","","",false,"","","",false,11);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userlogininsert");
   }
 }
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../webassist/jq_validation/Bloom.css">
<link type="text/css" href="../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet"><script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script><script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script><script type="text/javascript">
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Insert_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Default" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Insert</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
    <div class="lineGroup"> <label for="user_handle" class="sublabel" > Handle/Nickname:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="user_handle" name="user_handle" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_handle"):"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_handle_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(1,2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="email" class="sublabel" > Email:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="email" name="email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","email"):"")); ?>" class="formTextfield_Medium" tabindex="2" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "3" . ",") !== false || "3" == "") || (strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="email_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(3,4:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="password" class="sublabel" > Password:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="password" name="password" type="password" value="" class="formPasswordfield_Medium" tabindex="3" title="Please enter a value." confirm="" required="true">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="password_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(5:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="password_Confirm" class="sublabel" > Confirm:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="password_Confirm" name="password_Confirm" type="password" value="" class="formPasswordfield_Medium" tabindex="4" title="Please enter a value." confirm="password" required="true">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="password_Confirm_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(6:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="firstName" class="sublabel" > First Name:</label>
  <input id="firstName" name="firstName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","firstName"):"")); ?>" class="formTextfield_Large" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="lastName" class="sublabel" > Last Name:</label>
  <input id="lastName" name="lastName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","lastName"):"")); ?>" class="formTextfield_Large" tabindex="6" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_main_phone" class="sublabel" > Main Phone:</label>
  <input id="user_main_phone" name="user_main_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_main_phone"):"")); ?>" class="formTextfield_Medium" tabindex="7" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').user_main_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').user_main_phone,0,true);">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_main_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(7:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_mobile_phone" class="sublabel" > Mobile Phone:</label>
  <input id="user_mobile_phone" name="user_mobile_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_mobile_phone"):"")); ?>" class="formTextfield_Medium" tabindex="8" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').user_mobile_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').user_mobile_phone,0,true);">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "8" . ",") !== false || "8" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_mobile_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(8:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_work_phone" class="sublabel" > Work Phone:</label>
  <input id="user_work_phone" name="user_work_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_work_phone"):"")); ?>" class="formTextfield_Medium" tabindex="9" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').user_work_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').user_work_phone,0,true);">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "9" . ",") !== false || "9" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_work_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(9:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_street_address" class="sublabel" > Street Address:</label>
  <input id="user_street_address" name="user_street_address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_street_address"):"")); ?>" class="formTextfield_Large" tabindex="10" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_apt_suite" class="sublabel" > Apt/Suite:</label>
  <input id="user_apt_suite" name="user_apt_suite" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_apt_suite"):"")); ?>" class="formTextfield_Small" tabindex="11" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_city" class="sublabel" > City:</label>
  <input id="user_city" name="user_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_city"):"")); ?>" class="formTextfield_Medium" tabindex="12" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_state" class="sublabel" > State:</label>
      <select class="formMenufield_Medium" name="user_state" id="user_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_state"):"")); ?>" tabindex="13" title="Please enter a value.">
<option value="">Choose State...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuuser_state['state_abbr']?>"<?php if (!(strcmp($row_WADAMenuuser_state['state_abbr'], (isset($_GET["invalid"])?ValidatedField("userlogininsert","user_state"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuuser_state['state_name']?></option>
        <?php
} while ($row_WADAMenuuser_state = mysql_fetch_assoc($WADAMenuuser_state));
  $rows = mysql_num_rows($WADAMenuuser_state);
  if($rows > 0) {
      mysql_data_seek($WADAMenuuser_state, 0);
	  $row_WADAMenuuser_state = mysql_fetch_assoc($WADAMenuuser_state);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="user_zip" class="sublabel" > Zip Code:</label>
  <input id="user_zip" name="user_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_zip"):"")); ?>" class="formTextfield_Medium" tabindex="14" pattern="(\d{5}([\-]\d{4})?)" title="Please enter a value.">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "10" . ",") !== false || "10" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_zip_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(10:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_Date_of_Birth" class="sublabel" > Birthday:</label>
  <input id="user_Date_of_Birth" name="user_Date_of_Birth" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_Date_of_Birth"):"")); ?>" class="formTextfield_Medium" tabindex="15" title="Please enter a value.">
	   <?php
if (ValidatedField('userlogininsert','userlogininsert'))  {
  if ((strpos((",".ValidatedField("userlogininsert","userlogininsert").","), "," . "11" . ",") !== false || "11" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_Date_of_Birth_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_login_insert.php userlogininsert(11:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="user_bio" class="sublabel" > user_bio:</label><div style="display:inline-block"><?php
// The initial value to be displayed in the editor.
$CKEditor_initialValue = "".((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_bio",false):""))  ."";
$CKEditor = new CKEditor();
$CKEditor->basePath = "../webassist/ckeditor/";
$CKEditor_config = array();
$CKEditor_config["wa_preset_name"] = "Normal";
$CKEditor_config["wa_preset_file"] = "Normal.xml";
$CKEditor_config["width"] = "382px";
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
    </div> 
    <div class="lineGroup"> <label for="user_facebook" class="sublabel" > Facebook:</label>
  <input id="user_facebook" name="user_facebook" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_facebook"):"")); ?>" class="formTextfield_Medium" tabindex="16" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_twitter" class="sublabel" > Twitter:</label>
  <input id="user_twitter" name="user_twitter" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_twitter"):"")); ?>" class="formTextfield_Medium" tabindex="17" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_instagram" class="sublabel" > Instagram:</label>
  <input id="user_instagram" name="user_instagram" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_instagram"):"")); ?>" class="formTextfield_Medium" tabindex="18" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_google_plus" class="sublabel" > Google +:</label>
  <input id="user_google_plus" name="user_google_plus" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_google_plus"):"")); ?>" class="formTextfield_Medium" tabindex="19" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_youtube" class="sublabel" > YouTube:</label>
  <input id="user_youtube" name="user_youtube" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_youtube"):"")); ?>" class="formTextfield_Medium" tabindex="20" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_twitch" class="sublabel" > Twitch:</label>
  <input id="user_twitch" name="user_twitch" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_twitch"):"")); ?>" class="formTextfield_Medium" tabindex="21" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_website" class="sublabel" > Personal Website:</label>
  <input id="user_website" name="user_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_website"):"")); ?>" class="formTextfield_Medium" tabindex="22" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="user_visibility__1" class="sublabel" > Visible to Other Players:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_visibility__1">
          yes&nbsp;<input type="radio" name="user_visibility" id="user_visibility__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_visibility"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="23" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_visibility__2">
          no&nbsp;<input type="radio" name="user_visibility" id="user_visibility__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_visibility"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="24"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_share_contact__1" class="sublabel" > Share Contact Information:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_share_contact__1">
          yes&nbsp;<input type="radio" name="user_share_contact" id="user_share_contact__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_share_contact"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="25" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_share_contact__2">
          no&nbsp;<input type="radio" name="user_share_contact" id="user_share_contact__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_share_contact"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="26"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_share_name__1" class="sublabel" > Share Name:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_share_name__1">
          yes&nbsp;<input type="radio" name="user_share_name" id="user_share_name__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_share_name"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="27" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_share_name__2">
          no&nbsp;<input type="radio" name="user_share_name" id="user_share_name__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_share_name"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="28"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_share_status__1" class="sublabel" > Share Current Status:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_share_status__1">
          yes&nbsp;<input type="radio" name="user_share_status" id="user_share_status__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_share_status"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="29" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_share_status__2">
          no&nbsp;<input type="radio" name="user_share_status" id="user_share_status__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_share_status"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="30"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_newsletter__1" class="sublabel" > Subscribed to Newsletter:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_newsletter__1">
          yes&nbsp;<input type="radio" name="user_newsletter" id="user_newsletter__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_newsletter"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="31" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_newsletter__2">
          no&nbsp;<input type="radio" name="user_newsletter" id="user_newsletter__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_newsletter"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="32"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_marketing__1" class="sublabel" > Allow Marketing Communications:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_marketing__1">
          yes&nbsp;<input type="radio" name="user_marketing" id="user_marketing__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_marketing"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="33" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_marketing__2">
          no&nbsp;<input type="radio" name="user_marketing" id="user_marketing__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_marketing"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="34"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_sms__1" class="sublabel" > Allow SMS:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_sms__1">
          yes&nbsp;<input type="radio" name="user_sms" id="user_sms__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_sms"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="35" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_sms__2">
          no&nbsp;<input type="radio" name="user_sms" id="user_sms__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_sms"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="36"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_allow_play__1" class="sublabel" > Allow Play Requests:</label>
<span class="radioFieldGroup_Narrow">
        <span class="radioGroup_Narrow">
        <label class="radioSublabel_Narrow" for="user_allow_play__1">
          yes&nbsp;<input type="radio" name="user_allow_play" id="user_allow_play__1" value="1" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_allow_play"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="37" title="Please enter a value."></label>
        <label class="radioSublabel_Narrow" for="user_allow_play__2">
          no&nbsp;<input type="radio" name="user_allow_play" id="user_allow_play__2" value="0" class="formRadioField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_allow_play"):""),"0"))) {echo "checked=\"checked\"";} ?> tabindex="38"></label>
		</span>
</span>
    </div> 
    <div class="lineGroup"> <label for="user_icon" class="sublabel" > user_icon:</label>
  <input name="user_icon" type="file" id="user_icon" size="30" tabindex="39" title="Please enter a value.">
    </div> 
        <span class="buttonFieldGroup" >
  <input id="user_points" name="user_points" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userlogininsert","user_points"):"")); ?>">
<input type="submit" value="Insert" class="formButton Modular" id="Insert" name="Insert" />
        </span>
        </fieldset>
</form></div><div id="Insert_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Default', 'Insert_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
<script src="../webassist/jq_validation/jquery.h5validate.js"></script>
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
<?php
mysql_free_result($WADAMenuuser_state);
?>
