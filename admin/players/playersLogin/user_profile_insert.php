<?php
/*
mysql_select_db($database_local, $local);
$query_WADAMenuuser_state = "SELECT state_abbr, state_name FROM tbl_state ORDER BY state_name ASC";
$WADAMenuuser_state = mysql_query($query_WADAMenuuser_state, $local) or die(mysql_error());
$row_WADAMenuuser_state = mysql_fetch_assoc($WADAMenuuser_state);
$totalRows_WADAMenuuser_state = mysql_num_rows($WADAMenuuser_state);
*/
?>
<?php require_once("../../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "user_login";
  $WA_sessionName = "WADA_Insert_user_login";
  $WA_redirectURL = "user_login_detail.php?id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "email|user_handle|firstName|lastName|join_date|tourneyAdmin|EventAdmin|NewsContributor|venueAdmin|clubAdmin|siteAdmin|user_Date_of_Birth|user_main_phone|user_mobile_phone|user_work_phone|user_street_address|user_apt_suite|user_city|user_state|user_zip|user_bio|user_facebook|user_twitter|user_instagram|user_google_plus|user_youtube|user_twitch|user_website|user_share_contact|user_share_name|user_share_status|user_newsletter|user_marketing|user_visibility|user_sms|user_allow_play|user_icon|totalWins|totalLoss|totalDraw|totalPoints|accountActive";
  $WA_fieldValuesStr = "".((isset($_POST["email"]))?$_POST["email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_handle"]))?$_POST["user_handle"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["firstName"]))?$_POST["firstName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["lastName"]))?$_POST["lastName"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["join_date"]) && $_POST["join_date"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["join_date"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["tourneyAdmin"]))?$_POST["tourneyAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["EventAdmin"]))?$_POST["EventAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["NewsContributor"]))?$_POST["NewsContributor"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["venueAdmin"]))?$_POST["venueAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["clubAdmin"]))?$_POST["clubAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["siteAdmin"]))?$_POST["siteAdmin"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_Date_of_Birth"]) && $_POST["user_Date_of_Birth"]!="" )?date("Y-m-d H:i:s", strtotime($_POST["user_Date_of_Birth"])):"")  ."" . $WA_AB_Split . "".((isset($_POST["user_main_phone"]))?$_POST["user_main_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_mobile_phone"]))?$_POST["user_mobile_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_work_phone"]))?$_POST["user_work_phone"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_street_address"]))?$_POST["user_street_address"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_apt_suite"]))?$_POST["user_apt_suite"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_city"]))?$_POST["user_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_state"]))?$_POST["user_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_zip"]))?$_POST["user_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_bio"]))?$_POST["user_bio"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_facebook"]))?$_POST["user_facebook"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitter"]))?$_POST["user_twitter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_instagram"]))?$_POST["user_instagram"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_google_plus"]))?$_POST["user_google_plus"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_youtube"]))?$_POST["user_youtube"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_twitch"]))?$_POST["user_twitch"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_website"]))?$_POST["user_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_contact"]))?$_POST["user_share_contact"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_name"]))?$_POST["user_share_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_share_status"]))?$_POST["user_share_status"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_newsletter"]))?$_POST["user_newsletter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_marketing"]))?$_POST["user_marketing"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_visibility"]))?$_POST["user_visibility"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_sms"]))?$_POST["user_sms"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["user_allow_play"]))?$_POST["user_allow_play"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["totalWins"]))?$_POST["totalWins"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["totalLoss"]))?$_POST["totalLoss"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["totalDraw"]))?$_POST["totalDraw"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["totalPoints"]))?$_POST["totalPoints"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["accountActive"]))?$_POST["accountActive"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
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
<?php require_once("../../../webassist/file_manipulation/helperphp.php"); ?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../../uploads/player/".$_SESSION['WADA_Insert_user_login']  ."",
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
	WA_DFP_UploadFiles("WA_UploadResult1", "user_icon", "2", "[NewFileName]_[Increment]", "true", $WA_UploadResult1_Params);
}
?>
<?php require_once('../../../Connections/local.php'); ?>
<?php require_once("../../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_userprofileinsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateEM((isset($_POST["email"])?$_POST["email"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","0","email","',none,''","".((isset($_POST["email"]))?$_POST["email"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateRQ((isset($_POST["user_handle"])?$_POST["user_handle"]:"") . "",true,3);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"user_login","id","none,none,NULL","0","user_handle","',none,''","".((isset($_POST["user_handle"]))?$_POST["user_handle"]:"")  ."",true,4);
  $WAFV_Errors .= WAValidateDT((isset($_POST["user_Date_of_Birth"])?$_POST["user_Date_of_Birth"]:"") . "",true,"","","",false,"","","",false,5);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_main_phone"])?$_POST["user_main_phone"]:"") . "",false,true,false,6);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_mobile_phone"])?$_POST["user_mobile_phone"]:"") . "",false,true,false,7);
  $WAFV_Errors .= WAValidatePN((isset($_POST["user_work_phone"])?$_POST["user_work_phone"]:"") . "",false,true,false,8);
  $WAFV_Errors .= WAValidateZC((isset($_POST["user_zip"])?$_POST["user_zip"]:"") . "",true,false,false,false,false,9);
  $WAFV_Errors .= WAValidateUR((isset($_POST["user_facebook"])?$_POST["user_facebook"]:"") . "","http://",false,10);
  $WAFV_Errors .= WAValidateUR((isset($_POST["user_twitter"])?$_POST["user_twitter"]:"") . "","http://",false,11);
  $WAFV_Errors .= WAValidateUR((isset($_POST["user_instagram"])?$_POST["user_instagram"]:"") . "","http://",false,12);
  $WAFV_Errors .= WAValidateUR((isset($_POST["user_google_plus"])?$_POST["user_google_plus"]:"") . "","http://",false,13);
  $WAFV_Errors .= WAValidateUR((isset($_POST["user_youtube"])?$_POST["user_youtube"]:"") . "","http://",false,14);
  $WAFV_Errors .= WAValidateUR((isset($_POST["user_twitch"])?$_POST["user_twitch"]:"") . "","http://",false,15);
  $WAFV_Errors .= WAValidateUR((isset($_POST["user_website"])?$_POST["user_website"]:"") . "","http://",false,16);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"userprofileinsert");
   }
 }
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Battle-Comm: Insert Player</title>
    <link href="../../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../../webassist/jq_validation/Bloom.css">
    <link type="text/css" href="../../../webassist/forms/fd_basic_default/Datepicker/css/jquery-custom.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="../../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <link href="../../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../../../Scripts/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="../../../Scripts/mobile-toggle.js"></script>
    <script type="text/javascript" src="../../../Scripts/backtotop.js"></script>
    <script type="text/javascript" src="../../../ScriptLibrary/dmxDataBindings.js"></script>
	<script type="text/javascript" src="../../../ScriptLibrary/dmxDataSet.js"></script>
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
<?php include '../../../Templates/parts/header.php'; ?>
		<?php include '../../../Templates/parts/container-top.php'; ?>
        <div class="full_width">
<div id="Insert_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data" class="clean" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
 <span class="fieldsetDescription">Required = *</span>
<div class="full_width">
<fieldset>
	<legend>Player Info</legend>
<ol>
    <li> <label for="email" class="sublabel" > Email:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="email" name="email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","email"):"")); ?>" class="formTextfield_Medium" tabindex="1" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="email_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(1,2:)
    }
  }
}?>
    </li> 
    <li> <label for="user_handle" class="sublabel" > Handle:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="user_handle" name="user_handle" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_handle"):"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "3" . ",") !== false || "3" == "") || (strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "4" . ",") !== false || "4" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_handle_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(3,4:)
    }
  }
}?>
    </li> 
    <li> <label for="firstName" class="sublabel" > First Name:</label>
  <input id="firstName" name="firstName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","firstName"):"")); ?>" class="formTextfield_Medium" tabindex="3" title="Please enter a value.">
    </li> 
    <li> <label for="lastName" class="sublabel" > Last Name:</label>
  <input id="lastName" name="lastName" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","lastName"):"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </li> 
    <li> <label for="join_date" class="sublabel" > Date Joined:</label>
  <input id="join_date" name="join_date" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","join_date"):"")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </li> 
    <li> <label for="tourneyAdmin" class="sublabel" > Tournament Admin:</label>
      <select class="formMenufield_Small" name="tourneyAdmin" id="tourneyAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","tourneyAdmin"):"")); ?>" tabindex="6" title="Please enter a value.">
        <option value="yes">Yes</option>
        <option value="no" selected="selected">No</option>
      </select>
    </li> 
    <li> <label for="EventAdmin" class="sublabel" > EventAdmin:</label>
      <select class="formMenufield_Small" name="EventAdmin" id="EventAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","EventAdmin"):"")); ?>" tabindex="7" title="Please enter a value.">
      <option value="yes">Yes</option>
        <option value="no" selected="selected">No</option>

      </select>
    </li> 
    <li> <label for="NewsContributor" class="sublabel" > NewsContributor:</label>
      <select class="formMenufield_Small" name="NewsContributor" id="NewsContributor" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","NewsContributor"):"")); ?>" tabindex="8" title="Please enter a value."><option value="yes">Yes</option>
        <option value="no" selected="selected">No</option>

      </select>
    </li> 
    <li> <label for="venueAdmin" class="sublabel" > venueAdmin:</label>
      <select class="formMenufield_Small" name="venueAdmin" id="venueAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","venueAdmin"):"")); ?>" tabindex="9" title="Please enter a value.">
      <option value="yes">Yes</option>
        <option value="no" selected="selected">No</option>

      </select>
    </li> 
    <li> <label for="clubAdmin" class="sublabel" > clubAdmin:</label>
      <select class="formMenufield_Small" name="clubAdmin" id="clubAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","clubAdmin"):"")); ?>" tabindex="10" title="Please enter a value.">
      <option value="yes">Yes</option>
        <option value="no" selected="selected">No</option>

      </select>
    </li> 
    <li> <label for="siteAdmin" class="sublabel" > siteAdmin:</label>
      <select class="formMenufield_Small" name="siteAdmin" id="siteAdmin" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","siteAdmin"):"")); ?>" tabindex="11" title="Please enter a value.">
      <option value="yes">Yes</option>
        <option value="no" selected="selected">No</option>

      </select>
    </li> 
    <li> <label for="user_Date_of_Birth" class="sublabel" > Date Of Birth:</label>
  <input id="user_Date_of_Birth" name="user_Date_of_Birth" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_Date_of_Birth"):"")); ?>" class="formTextfield_Medium" tabindex="12" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "5" . ",") !== false || "5" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_Date_of_Birth_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(5:)
    }
  }
}?>
    </li> 
    <li> <label for="user_main_phone" class="sublabel" > Main Phone:</label>
  <input id="user_main_phone" name="user_main_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_main_phone"):"")); ?>" class="formTextfield_Medium" tabindex="13" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').user_main_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').user_main_phone,0,true);">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "6" . ",") !== false || "6" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_main_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(6:)
    }
  }
}?>
    </li> 
    <li> <label for="user_mobile_phone" class="sublabel" > Mobile Phone:</label>
  <input id="user_mobile_phone" name="user_mobile_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_mobile_phone"):"")); ?>" class="formTextfield_Medium" tabindex="14" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').user_mobile_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').user_mobile_phone,0,true);">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "7" . ",") !== false || "7" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_mobile_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(7:)
    }
  }
}?>
    </li> 
    <li> <label for="user_work_phone" class="sublabel" > Work Phone:</label>
  <input id="user_work_phone" name="user_work_phone" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_work_phone"):"")); ?>" class="formTextfield_Medium" tabindex="15" pattern="\(\d{3}\) \d{3}[\-]\d{4}" title="Please enter a value." onBlur="WAValidatePN(document.getElementById('Insert_Basic_Default').user_work_phone,'',false,true,'x (xxx) xxx-xxxx',document.getElementById('Insert_Basic_Default').user_work_phone,0,true);">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "8" . ",") !== false || "8" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_work_phone_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(8:)
    }
  }
}?>
    </li> 
    <li> <label for="user_street_address" class="sublabel" > Street Address:</label>
  <input id="user_street_address" name="user_street_address" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_street_address"):"")); ?>" class="formTextfield_Medium" tabindex="16" title="Please enter a value.">
    </li> 
    <li> <label for="user_apt_suite" class="sublabel" > Apt/Suite:</label>
  <input id="user_apt_suite" name="user_apt_suite" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_apt_suite"):"")); ?>" class="formTextfield_Medium" tabindex="17" title="Please enter a value.">
    </li> 
    <li> <label for="user_city" class="sublabel" > City:</label>
  <input id="user_city" name="user_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_city"):"")); ?>" class="formTextfield_Medium" tabindex="18" title="Please enter a value.">
    </li> 
    <li> <label for="user_state" class="sublabel" > State:</label>
      <select class="formMenufield_XSmall" name="user_state" id="user_state" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_state"):"")); ?>" tabindex="19" title="Please enter a value.">
<option value="">Choose State: </option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenuuser_state['state_name']?>"<?php if (!(strcmp($row_WADAMenuuser_state['state_name'], (isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_state"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenuuser_state['state_abbr']?></option>
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
    <li> <label for="user_zip" class="sublabel" > Zip Code: :</label>
  <input id="user_zip" name="user_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_zip"):"")); ?>" class="formTextfield_Medium" tabindex="20" pattern="(\d{5}([\-]\d{4})?)" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "9" . ",") !== false || "9" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_zip_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(9:)
    }
  }
}?>
    </li> 
    <li> <label for="user_bio" class="sublabel" > About/Bio:</label>
  <textarea name="user_bio" id="user_bio" class="formTextarea_Large" rows="1" cols="1" tabindex="21" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_bio"):"")); ?></textarea>
    </li> 
</ol> 
</fieldset>
</div>    
    
<div class="two_column_1" style="margin-right:1%">
<fieldset>
	<legend>Social Links</legend>
<ol>  
    <li> <label for="user_facebook" class="sublabel" > Facebook:</label>
  <input id="user_facebook" name="user_facebook" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_facebook"):"")); ?>" class="formTextfield_Medium" tabindex="22" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "10" . ",") !== false || "10" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_facebook_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(10:)
    }
  }
}?>
    </li> 
    <li> <label for="user_twitter" class="sublabel" > Twitter:</label>
  <input id="user_twitter" name="user_twitter" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_twitter"):"")); ?>" class="formTextfield_Medium" tabindex="23" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "11" . ",") !== false || "11" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_twitter_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(11:)
    }
  }
}?>
    </li> 
    <li> <label for="user_instagram" class="sublabel" > Instagram:</label>
  <input id="user_instagram" name="user_instagram" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_instagram"):"")); ?>" class="formTextfield_Medium" tabindex="24" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "12" . ",") !== false || "12" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_instagram_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(12:)
    }
  }
}?>
    </li> 
    <li> <label for="user_google_plus" class="sublabel" > Google+:</label>
  <input id="user_google_plus" name="user_google_plus" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_google_plus"):"")); ?>" class="formTextfield_Medium" tabindex="25" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "13" . ",") !== false || "13" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_google_plus_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(13:)
    }
  }
}?>
    </li> 
    <li> <label for="user_youtube" class="sublabel" > YouTube:</label>
  <input id="user_youtube" name="user_youtube" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_youtube"):"")); ?>" class="formTextfield_Medium" tabindex="26" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "14" . ",") !== false || "14" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_youtube_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(14:)
    }
  }
}?>
    </li> 
    <li> <label for="user_twitch" class="sublabel" > Twitch:</label>
  <input id="user_twitch" name="user_twitch" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_twitch"):"")); ?>" class="formTextfield_Medium" tabindex="27" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "15" . ",") !== false || "15" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_twitch_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(15:)
    }
  }
}?>
    </li> 
    <li> <label for="user_website" class="sublabel" > Personal Website:</label>
  <input id="user_website" name="user_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_website"):"")); ?>" class="formTextfield_Medium" tabindex="28" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('userprofileinsert','userprofileinsert'))  {
  if ((strpos((",".ValidatedField("userprofileinsert","userprofileinsert").","), "," . "16" . ",") !== false || "16" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="user_website_ServerError">Please enter a value.</span><?php //WAFV_Conditional user_profile_insert.php userprofileinsert(16:)
    }
  }
}?>
    </li> 
    <li> <label for="totalWins" class="sublabel" > Total Wins:</label>
  <input id="totalWins" name="totalWins" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","totalWins"):"")); ?>" class="formTextfield_Medium" tabindex="38" title="Please enter a value.">
    </li> 
    <li> <label for="totalLoss" class="sublabel" > Total Losses: :</label>
  <input id="totalLoss" name="totalLoss" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","totalLoss"):"")); ?>" class="formTextfield_Medium" tabindex="39" title="Please enter a value.">
    </li> 
    <li> <label for="totalDraw" class="sublabel" > Total Draw:</label>
  <input id="totalDraw" name="totalDraw" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","totalDraw"):"")); ?>" class="formTextfield_Medium" tabindex="40" title="Please enter a value.">
    </li>
</ol>
</fieldset>
</div> 
    
<div class="two_column_1" style="margin-left:1%;" >
<fieldset>
	<legend>Notification Settings</legend>
<ol>    
    <li>
<label class="checklabel" for="user_share_contact"><input type="checkbox" name="user_share_contact" id="user_share_contact" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_share_contact"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="29" title="Please enter a value.">&nbsp;Share Contact Information</label>
    </li> 
    <li> 
<label class="checklabel" for="user_share_name"><input type="checkbox" name="user_share_name" id="user_share_name" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_share_name"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="30" title="Please enter a value.">&nbsp;Share Real Name</label>
    </li> 
    <li> 
<label class="checklabel" for="user_share_status"><input type="checkbox" name="user_share_status" id="user_share_status" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_share_status"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="31" title="Please enter a value.">&nbsp;Share Status</label>
    </li> 
    <li> 
<label class="checklabel" for="user_newsletter"><input type="checkbox" name="user_newsletter" id="user_newsletter" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_newsletter"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="32" title="Please enter a value.">&nbsp;Subscribe to Newsletter</label>
    </li> 
    <li> 
<label class="checklabel" for="user_marketing"><input type="checkbox" name="user_marketing" id="user_marketing" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_marketing"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="33" title="Please enter a value.">&nbsp;Subscribe to Marketing Messages</label>
    </li> 
    <li> 
<label class="checklabel" for="user_visibility"><input type="checkbox" name="user_visibility" id="user_visibility" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_visibility"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="34" title="Please enter a value.">&nbsp;Show as Visible</label>
    </li> 
    <li> 
<label class="checklabel" for="user_sms"><input type="checkbox" name="user_sms" id="user_sms" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_sms"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="35" title="Please enter a value.">&nbsp;Allow SMS</label>
    </li> 
    <li> 
<label class="checklabel" for="user_allow_play"><input type="checkbox" name="user_allow_play" id="user_allow_play" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","user_allow_play"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="36" title="Please enter a value.">&nbsp;Allow Play Requests</label>
    </li> 
    <li> <label for="user_icon" class="sublabel" > Icon:</label>
  <input name="user_icon" type="file" id="user_icon" size="30" tabindex="37" title="Please enter a value.">
    </li> 
    <li> 
<label class="checklabel" for="accountActive"><input type="checkbox" name="accountActive" id="accountActive" value="1" class="formCheckboxField_Standard" <?php if (!(strcmp((isset($_GET["invalid"])?ValidatedField("userprofileinsert","accountActive"):""),"1"))) {echo "checked=\"checked\"";} ?> tabindex="41" title="Please enter a value.">&nbsp;Account is Active</label>
    </li> 
</ol>
</fieldset>
</div>   
    
	<div class="full_width" >
		<div class="center">
        <span class="buttonFieldGroup" >
  <input id="totalPoints" name="totalPoints" type="hidden" value="<?php echo((isset($_GET["invalid"])?ValidatedField("userprofileinsert","totalPoints"):"")); ?>">
<input type="submit" value="Insert" class="formButton Modular" id="Insert" name="Insert" />
        </span>
        </div>
    </div>
        </fieldset>
</form></div><div id="Insert_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Default', 'Insert_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>
</div>


  		<?php include '../../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../../Templates/parts/footer.php'; ?>
 
<script src="../../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../../webassist/forms/wa_clientvalidation.js" type="text/javascript"></script>
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

<?php
mysql_free_result($WADAMenuuser_state);
?>