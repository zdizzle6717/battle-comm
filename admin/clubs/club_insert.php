<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "club";
  $WA_sessionName = "WADA_Insert_club";
  $WA_redirectURL = "club_detail.php?club_key=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "club_name|clubDescription|FLGS_affiliation|club_street|club_city|club_state|club_zip|club_email|club_contact_name|club_admin_name|club_editor_name|club_moderator_name|club_Member_name|club_facebook|club_twitter|club_website|game_system|club_display_Members|club_logo|clubOwner";
  $WA_fieldValuesStr = "".((isset($_POST["club_name"]))?$_POST["club_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["clubDescription"]))?$_POST["clubDescription"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["FLGS_affiliation"]))?$_POST["FLGS_affiliation"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_street"]))?$_POST["club_street"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_city"]))?$_POST["club_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_state"]))?$_POST["club_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_zip"]))?$_POST["club_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_email"]))?$_POST["club_email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_contact_name"]))?$_POST["club_contact_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_admin_name"]))?$_POST["club_admin_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_editor_name"]))?$_POST["club_editor_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_moderator_name"]))?$_POST["club_moderator_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_Member_name"]))?$_POST["club_Member_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_facebook"]))?$_POST["club_facebook"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_twitter"]))?$_POST["club_twitter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_website"]))?$_POST["club_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system"]))?$_POST["game_system"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_display_Members"]))?$_POST["club_display_Members"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["clubOwner"]))?$_POST["clubOwner"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
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
<?php require_once("../../webassist/file_manipulation/helperphp.php"); ?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../uploads/venue/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1_2 Start
$WA_UploadResult1_Params["WA_UploadResult1_2"] = array(
	'UploadFolder' => "../../uploads/venue/thumbs/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "2",
	'ResizeWidth' => "100",
	'ResizeHeight' => "120",
	'ResizeFillColor' => "#FFFFFF" );
// WA_UploadResult1_2 End
// WA_UploadResult1 Params End
?>
<?php
WA_DFP_SetupUploadStatusStruct("WA_UploadResult1");
if(isset($_POST["Insert"]) || isset($_POST["Insert_x"])){
	WA_DFP_UploadFiles("WA_UploadResult1", "club_logo", "2", "[NewFileName]_[Increment]", "true", $WA_UploadResult1_Params);
}
?>
<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_clubinsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["club_name"])?$_POST["club_name"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"club","club_key","none,none,NULL","0","club_name","',none,''","".((isset($_POST["club_name"]))?$_POST["club_name"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateEM((isset($_POST["club_email"])?$_POST["club_email"]:"") . "",false,3);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"clubinsert");
   }
 }
 ?>
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
mysql_select_db($database_local, $local);
$query_FLGS = "SELECT venue_id, venue_Name FROM venue ORDER BY venue_Name ASC";
$FLGS = mysql_query($query_FLGS, $local) or die(mysql_error());
$row_FLGS = mysql_fetch_assoc($FLGS);
$totalRows_FLGS = mysql_num_rows($FLGS);

mysql_select_db($database_local, $local);
$query_GameSystem = "SELECT game_system_id, game_system_Title FROM game_system ORDER BY game_system_Title ASC";
$GameSystem = mysql_query($query_GameSystem, $local) or die(mysql_error());
$row_GameSystem = mysql_fetch_assoc($GameSystem);
$totalRows_GameSystem = mysql_num_rows($GameSystem);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Battle-Comm: Club Insert</title>
<link href="../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../webassist/jq_validation/Bloom.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/magnificent-popup/magnificent-popup.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../../Styles/form_clean.css">
<link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
	<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
	/* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  	</script>
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
</head>

<?php include '../../Templates/parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
<div id="Insert_Basic_Defaultmod_ProgressWrapper">
<form enctype="multipart/form-data"  class="clean" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Insert</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
  <ol>
  	<li> <label for="club_name" class="sublabel" > Club Name:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="club_name" name="club_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_name"):"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('clubinsert','clubinsert'))  {
  if ((strpos((",".ValidatedField("clubinsert","clubinsert").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("clubinsert","clubinsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="club_name_ServerError">Please enter a value.</span><?php //WAFV_Conditional club_insert.php clubinsert(1,2:)
    }
  }
}?>
	</li> 
    <li> <label for="clubDescription" class="sublabel" > Club Description:</label>
  <textarea name="clubDescription" id="clubDescription" class="formTextarea_Medium" rows="1" cols="1" tabindex="2" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","clubDescription"):"")); ?></textarea>
    </li> 
    <li> <label for="FLGS_affiliation" class="sublabel" > FLGS Affiliation:</label>
      <select class="formMenufield_Medium" name="FLGS_affiliation" id="FLGS_affiliation" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","FLGS_affiliation"):"")); ?>" tabindex="3" title="Please enter a value.">
        <option value="">Choose Game Store..</option>
        <option value="0000">N/A</option>
        <?php
do {  
?>
        <option value="<?php echo $row_FLGS['venue_id']?>"><?php echo $row_FLGS['venue_Name']?></option>
        <?php
} while ($row_FLGS = mysql_fetch_assoc($FLGS));
  $rows = mysql_num_rows($FLGS);
  if($rows > 0) {
      mysql_data_seek($FLGS, 0);
	  $row_FLGS = mysql_fetch_assoc($FLGS);
  }
?>
      </select>
    </li> 
    <li> <label for="club_street" class="sublabel" > Street Address:</label>
  <input id="club_street" name="club_street" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_street"):"")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </li> 
    <li> <label for="club_city" class="sublabel" > club_city:</label>
  <input id="club_city" name="club_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_city"):"")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </li> 
    <li> <label for="club_state" class="sublabel" > State:</label>
  <input id="club_state" name="club_state" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_state"):"")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
    </li> 
    <li> <label for="club_zip" class="sublabel" > Zip Code:</label>
  <input id="club_zip" name="club_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_zip"):"")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
    </li> 
    <li> <label for="club_email" class="sublabel" > Contact Email:</label>
  <input id="club_email" name="club_email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_email"):"")); ?>" class="formTextfield_Medium" tabindex="8" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value.">
	   <?php
if (ValidatedField('clubinsert','clubinsert'))  {
  if ((strpos((",".ValidatedField("clubinsert","clubinsert").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="club_email_ServerError">Please enter a value.</span><?php //WAFV_Conditional club_insert.php clubinsert(3:)
    }
  }
}?>
    </li> 
    <li> <label for="club_contact_name" class="sublabel" > Contact Name:</label>
  <input id="club_contact_name" name="club_contact_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_contact_name"):"")); ?>" class="formTextfield_Medium" tabindex="9" title="Please enter a value.">
    </li> 
    <li> <label for="club_admin_name" class="sublabel" > Administrator Title:</label>
  <input id="club_admin_name" name="club_admin_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_admin_name"):"")); ?>" class="formTextfield_Medium" tabindex="10" title="Please enter a value.">
    </li> 
    <li> <label for="club_editor_name" class="sublabel" > Editor Title:</label>
  <input id="club_editor_name" name="club_editor_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_editor_name"):"")); ?>" class="formTextfield_Medium" tabindex="11" title="Please enter a value.">
    </li> 
    <li> <label for="club_moderator_name" class="sublabel" > Moderator Title:</label>
  <input id="club_moderator_name" name="club_moderator_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_moderator_name"):"")); ?>" class="formTextfield_Medium" tabindex="12" title="Please enter a value.">
    </li> 
    <li> <label for="club_Member_name" class="sublabel" > Member Title:</label>
  <input id="club_Member_name" name="club_Member_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_Member_name"):"")); ?>" class="formTextfield_Medium" tabindex="13" title="Please enter a value.">
    </li> 
    <li> <label for="club_facebook" class="sublabel" > Facebook Page:</label>
  <input id="club_facebook" name="club_facebook" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_facebook"):"")); ?>" class="formTextfield_Medium" tabindex="14" title="Please enter a value.">
    </li> 
    <li> <label for="club_twitter" class="sublabel" > Twitter Feed:</label>
  <input id="club_twitter" name="club_twitter" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_twitter"):"")); ?>" class="formTextfield_Medium" tabindex="15" title="Please enter a value.">
    </li> 
    <li> <label for="club_website" class="sublabel" > Club Website:</label>
  <input id="club_website" name="club_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_website"):"")); ?>" class="formTextfield_Medium" tabindex="16" title="Please enter a value.">
    </li> 
    <li> <label for="game_system" class="sublabel" > Game System:</label>
      <select class="formMenufield_Medium" name="game_system" id="game_system" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","game_system"):"")); ?>" tabindex="17" title="Please enter a value.">
        <option value="">Choose Game System...</option>
        <option value="0000">N/A</option>
        <?php
do {  
?>
        <option value="<?php echo $row_GameSystem['game_system_id']?>"><?php echo $row_GameSystem['game_system_Title']?></option>
        <?php
} while ($row_GameSystem = mysql_fetch_assoc($GameSystem));
  $rows = mysql_num_rows($GameSystem);
  if($rows > 0) {
      mysql_data_seek($GameSystem, 0);
	  $row_GameSystem = mysql_fetch_assoc($GameSystem);
  }
?>
      </select>
    </li> 
    <li> <label for="club_display_Members" class="sublabel" > Public Display Members:</label>
  <input id="club_display_Members" name="club_display_Members" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","club_display_Members"):"")); ?>" class="formTextfield_Medium" tabindex="18" title="Please enter a value.">
    </li> 
    <li> <label for="club_logo" class="sublabel" > Club Logo:</label>
  <input name="club_logo" type="file" id="club_logo" size="30" tabindex="19" title="Please enter a value.">
    </li> 
    <li> <label for="clubOwner" class="sublabel" > Club Owner/Manager:</label>
  <input id="clubOwner" name="clubOwner" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubinsert","clubOwner"):"")); ?>" class="formTextfield_Medium" tabindex="20" title="Please enter a value.">
    </li> 
</ol>
	<div class="full_width" >
		<div class="center">
        <span class="buttonFieldGroup" >
          <input type="submit" value="Insert" class="formButton Modular" id="Insert" name="Insert" />
        </span>
    	</div>
    </div>
        </fieldset>
</form></div><div id="Insert_Basic_Defaultmod_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Defaultmod', 'Insert_Basic_Defaultmod_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Insert_Basic_Defaultmod_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>

  		<?php include '../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../Templates/parts/footer.php'; ?>
<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
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
mysql_free_result($FLGS);

mysql_free_result($GameSystem);
?>
