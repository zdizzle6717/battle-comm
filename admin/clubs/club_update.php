<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "club";
  $WA_redirectURL = "club_detail.php?club_key=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAclub"])?"&pageNum_WADAclub=".intval($_GET["pageNum_WADAclub"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "club_key";
  $WA_fieldNamesStr = "club_name|clubDescription|FLGS_affiliation|club_street|club_city|club_state|club_zip|club_email|club_contact_name|club_admin_name|club_editor_name|club_moderator_name|club_Member_name|club_facebook|club_twitter|club_website|game_system|club_display_Members|club_logo|clubOwner";
  $WA_fieldValuesStr = "".((isset($_POST["club_name"]))?$_POST["club_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["clubDescription"]))?$_POST["clubDescription"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["FLGS_affiliation"]))?$_POST["FLGS_affiliation"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_street"]))?$_POST["club_street"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_city"]))?$_POST["club_city"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_state"]))?$_POST["club_state"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_zip"]))?$_POST["club_zip"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_email"]))?$_POST["club_email"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_contact_name"]))?$_POST["club_contact_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_admin_name"]))?$_POST["club_admin_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_editor_name"]))?$_POST["club_editor_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_moderator_name"]))?$_POST["club_moderator_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_Member_name"]))?$_POST["club_Member_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_facebook"]))?$_POST["club_facebook"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_twitter"]))?$_POST["club_twitter"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_website"]))?$_POST["club_website"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system"]))?$_POST["game_system"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["club_display_Members"]))?$_POST["club_display_Members"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["clubOwner"]))?$_POST["clubOwner"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = "=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=|=";
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
$Paramclub_key_WADAclub = "-1";
if (isset($_GET['club_key'])) {
  $Paramclub_key_WADAclub = $_GET['club_key'];
}
mysql_select_db($database_local, $local);
$query_WADAclub = sprintf("SELECT club_key, club_name, clubDescription, FLGS_affiliation, club_street, club_city, club_state, club_zip, club_email, club_contact_name, club_admin_name, club_editor_name, club_moderator_name, club_Member_name, club_facebook, club_twitter, club_website, game_system, club_display_Members, club_logo, clubOwner FROM club WHERE club_key = %s", GetSQLValueString($Paramclub_key_WADAclub, "int"));
$WADAclub = mysql_query($query_WADAclub, $local) or die(mysql_error());
$row_WADAclub = mysql_fetch_assoc($WADAclub);
$totalRows_WADAclub = mysql_num_rows($WADAclub);$Paramclub_key_WADAclub = "-1";
if (isset($_GET['club_key'])) {
  $Paramclub_key_WADAclub = $_GET['club_key'];
}
mysql_select_db($database_local, $local);
$query_WADAclub = sprintf("SELECT club_key, club_name, clubDescription, FLGS_affiliation, club_street, club_city, club_state, club_zip, club_email, club_contact_name, club_admin_name, club_editor_name, club_moderator_name, club_Member_name, club_facebook, club_twitter, club_website, game_system, club_display_Members, club_logo, clubOwner FROM club WHERE club_key = %s", GetSQLValueString($Paramclub_key_WADAclub, "int"));
$WADAclub = mysql_query($query_WADAclub, $local) or die(mysql_error());
$row_WADAclub = mysql_fetch_assoc($WADAclub);
$totalRows_WADAclub = mysql_num_rows($WADAclub);
?>
<?php require_once("../../webassist/file_manipulation/helperphp.php"); ?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../",
	'FileName' => "[FileName]",
	'DefaultFileName' => "".($row_WADAclub["club_logo"])  ."",
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
	WA_DFP_UploadFiles("WA_UploadResult1", "club_logo", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_clubupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["club_name"])?$_POST["club_name"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUnique(("local"),$local,$database_local,"club","club_key","none,none,NULL","".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"0")  ."","club_name","',none,''","".((isset($_POST["club_name"]))?$_POST["club_name"]:"")  ."",true,2);
  $WAFV_Errors .= WAValidateEM((isset($_POST["club_email"])?$_POST["club_email"]:"") . "",false,3);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"clubupdate");
   }
 }
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Untitled Document</title>
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../webassist/jq_validation/Bloom.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="file:///C|/xampp/htdocs/testBC/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Default_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Default" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
          <legend class="groupHeader">Update</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
    <div class="lineGroup"> <label for="club_name" class="sublabel" > Club Name:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="club_name" name="club_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_name"):"".$row_WADAclub["club_name"]."")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('clubupdate','clubupdate'))  {
  if ((strpos((",".ValidatedField("clubupdate","clubupdate").","), "," . "1" . ",") !== false || "1" == "") || (strpos((",".ValidatedField("clubupdate","clubupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="club_name_ServerError">Please enter a value.</span><?php //WAFV_Conditional club_update.php clubupdate(1,2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="clubDescription" class="sublabel" > Club Description:</label>
  <textarea name="clubDescription" id="clubDescription" class="formTextarea_Medium" rows="1" cols="1" tabindex="2" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","clubDescription"):"".$row_WADAclub["clubDescription"]."")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="FLGS_affiliation" class="sublabel" > FLGS Affiliation:</label>
      <select class="formMenufield_Medium" name="FLGS_affiliation" id="FLGS_affiliation" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","FLGS_affiliation"):"".$row_WADAclub["FLGS_affiliation"]."")); ?>" tabindex="3" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="club_street" class="sublabel" > Street Address:</label>
  <input id="club_street" name="club_street" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_street"):"".$row_WADAclub["club_street"]."")); ?>" class="formTextfield_Medium" tabindex="4" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_city" class="sublabel" > club_city:</label>
  <input id="club_city" name="club_city" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_city"):"".$row_WADAclub["club_city"]."")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_state" class="sublabel" > State:</label>
  <input id="club_state" name="club_state" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_state"):"".$row_WADAclub["club_state"]."")); ?>" class="formTextfield_Medium" tabindex="6" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_zip" class="sublabel" > Zip Code:</label>
  <input id="club_zip" name="club_zip" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_zip"):"".$row_WADAclub["club_zip"]."")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_email" class="sublabel" > Contact Email:</label>
  <input id="club_email" name="club_email" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_email"):"".$row_WADAclub["club_email"]."")); ?>" class="formTextfield_Medium" tabindex="8" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,6}" title="Please enter a value.">
	   <?php
if (ValidatedField('clubupdate','clubupdate'))  {
  if ((strpos((",".ValidatedField("clubupdate","clubupdate").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="club_email_ServerError">Please enter a value.</span><?php //WAFV_Conditional club_update.php clubupdate(3:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="club_contact_name" class="sublabel" > Contact Name:</label>
  <input id="club_contact_name" name="club_contact_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_contact_name"):"".$row_WADAclub["club_contact_name"]."")); ?>" class="formTextfield_Medium" tabindex="9" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_admin_name" class="sublabel" > Administrator Title:</label>
  <input id="club_admin_name" name="club_admin_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_admin_name"):"".$row_WADAclub["club_admin_name"]."")); ?>" class="formTextfield_Medium" tabindex="10" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_editor_name" class="sublabel" > Editor Title:</label>
  <input id="club_editor_name" name="club_editor_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_editor_name"):"".$row_WADAclub["club_editor_name"]."")); ?>" class="formTextfield_Medium" tabindex="11" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_moderator_name" class="sublabel" > Moderator Title:</label>
  <input id="club_moderator_name" name="club_moderator_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_moderator_name"):"".$row_WADAclub["club_moderator_name"]."")); ?>" class="formTextfield_Medium" tabindex="12" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_Member_name" class="sublabel" > Member Title:</label>
  <input id="club_Member_name" name="club_Member_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_Member_name"):"".$row_WADAclub["club_Member_name"]."")); ?>" class="formTextfield_Medium" tabindex="13" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_facebook" class="sublabel" > Facebook Page:</label>
  <input id="club_facebook" name="club_facebook" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_facebook"):"".$row_WADAclub["club_facebook"]."")); ?>" class="formTextfield_Medium" tabindex="14" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_twitter" class="sublabel" > Twitter Feed:</label>
  <input id="club_twitter" name="club_twitter" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_twitter"):"".$row_WADAclub["club_twitter"]."")); ?>" class="formTextfield_Medium" tabindex="15" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_website" class="sublabel" > Club Website:</label>
  <input id="club_website" name="club_website" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_website"):"".$row_WADAclub["club_website"]."")); ?>" class="formTextfield_Medium" tabindex="16" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system" class="sublabel" > Game System:</label>
      <select class="formMenufield_Medium" name="game_system" id="game_system" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","game_system"):"".$row_WADAclub["game_system"]."")); ?>" tabindex="17" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="club_display_Members" class="sublabel" > Public Display Members:</label>
  <input id="club_display_Members" name="club_display_Members" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","club_display_Members"):"".$row_WADAclub["club_display_Members"]."")); ?>" class="formTextfield_Medium" tabindex="18" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="club_logo" class="sublabel" > Club Logo:</label>
  <input name="club_logo" type="file" id="club_logo" size="30" tabindex="19" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="clubOwner" class="sublabel" > Club Owner/Manager:</label>
  <input id="clubOwner" name="clubOwner" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","clubOwner"):"".$row_WADAclub["clubOwner"]."")); ?>" class="formTextfield_Medium" tabindex="20" title="Please enter a value.">
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Update" class="formButton Modular" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("clubupdate","WADAUpdateRecordID"):$_GET["club_key"])); ?>" />
</form></div><div id="Update_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Default', 'Update_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Update_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
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
mysql_free_result($WADAclub);
?>
