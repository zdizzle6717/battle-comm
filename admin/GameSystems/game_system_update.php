<?php require_once("../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Update"]) || isset($_POST["Update_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_gamesystemupdate_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["game_system_Title"])?$_POST["game_system_Title"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUR((isset($_POST["game_system_official_url"])?$_POST["game_system_official_url"]:"") . "","http://",false,2);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"gamesystemupdate");
   }
 }
 ?>
<?php require_once("../../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
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
$Paramgame_system_id_WADAgame_system = "-1";
if (isset($_GET['game_system_id'])) {
  $Paramgame_system_id_WADAgame_system = $_GET['game_system_id'];
}
mysql_select_db($database_local, $local);
$query_WADAgame_system = sprintf("SELECT game_system_id, game_system_Title, game_system_Title_version, game_system_publisher, game_system_official_url, game_logo, games_category, games_time, noOfPlayers FROM game_system WHERE game_system_id = %s", GetSQLValueString($Paramgame_system_id_WADAgame_system, "int"));
$WADAgame_system = mysql_query($query_WADAgame_system, $local) or die(mysql_error());
$row_WADAgame_system = mysql_fetch_assoc($WADAgame_system);
$totalRows_WADAgame_system = mysql_num_rows($WADAgame_system);
?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../../images/games",
	'FileName' => "[FileName]",
	'DefaultFileName' => "".($row_WADAgame_system["game_logo"])  ."",
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
	WA_DFP_UploadFiles("WA_UploadResult1", "game_logo", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "game_system";
  $WA_redirectURL = "game_system_detail.php?game_system_id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAgame_system"])?"&pageNum_WADAgame_system=".intval($_GET["pageNum_WADAgame_system"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "game_system_id";
  $WA_fieldNamesStr = "game_system_Title|game_system_Title_version|game_system_publisher|game_system_official_url|game_logo|games_category|games_time|noOfPlayers";
  $WA_fieldValuesStr = "".((isset($_POST["game_system_Title"]))?$_POST["game_system_Title"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system_Title_version"]))?$_POST["game_system_Title_version"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system_publisher"]))?$_POST["game_system_publisher"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system_official_url"]))?$_POST["game_system_official_url"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["games_category"]))?$_POST["games_category"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["games_time"]))?$_POST["games_time"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["noOfPlayers"]))?$_POST["noOfPlayers"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE | LIKE ";
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
<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../../webassist/jq_validation/Inspiration.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="file:///C|/xampp/htdocs/testBC/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Defaultmod_ProgressWrapper">
<form enctype="multipart/form-data"  class="Basic_Defaultmod" id="Update_Basic_Defaultmod" name="Update_Basic_Defaultmod" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Defaultmod" id="Update">
          <legend class="groupHeader">Update</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
    <div class="lineGroup"> <label for="game_system_Title" class="sublabel" > Title:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="game_system_Title" name="game_system_Title" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesystemupdate","game_system_Title"):"".$row_WADAgame_system["game_system_Title"]."")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamesystemupdate','gamesystemupdate'))  {
  if ((strpos((",".ValidatedField("gamesystemupdate","gamesystemupdate").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="game_system_Title_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_system_update.php gamesystemupdate(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="game_system_Title_version" class="sublabel" > Version:</label>
  <input id="game_system_Title_version" name="game_system_Title_version" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesystemupdate","game_system_Title_version"):"".$row_WADAgame_system["game_system_Title_version"]."")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system_publisher" class="sublabel" > Publisher:</label>
  <input id="game_system_publisher" name="game_system_publisher" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesystemupdate","game_system_publisher"):"".$row_WADAgame_system["game_system_publisher"]."")); ?>" class="formTextfield_Large" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system_official_url" class="sublabel" > Game System URL:</label>
  <input id="game_system_official_url" name="game_system_official_url" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesystemupdate","game_system_official_url"):"".$row_WADAgame_system["game_system_official_url"]."")); ?>" class="formTextfield_Large" tabindex="4" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('gamesystemupdate','gamesystemupdate'))  {
  if ((strpos((",".ValidatedField("gamesystemupdate","gamesystemupdate").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="game_system_official_url_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_system_update.php gamesystemupdate(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="game_logo" class="sublabel" > Upload Logo:</label>
  <input name="game_logo" type="file" id="game_logo" size="30" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="games_category" class="sublabel" > Category:</label>
      <select class="formMenufield_Medium" name="games_category" id="games_category" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesystemupdate","games_category"):"".$row_WADAgame_system["games_category"]."")); ?>" tabindex="6" title="Please enter a value.">
      </select>
    </div> 
    <div class="lineGroup"> <label for="games_time" class="sublabel" > Play Time:</label>
  <input id="games_time" name="games_time" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesystemupdate","games_time"):"".$row_WADAgame_system["games_time"]."")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="noOfPlayers" class="sublabel" > noOfPlayers:</label>
  <input id="noOfPlayers" name="noOfPlayers" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesystemupdate","noOfPlayers"):"".$row_WADAgame_system["noOfPlayers"]."")); ?>" class="formTextfield_Medium" tabindex="8" title="Please enter a value.">
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Update" class="formButton Spacious" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesystemupdate","WADAUpdateRecordID"):$_GET["game_system_id"])); ?>" />
</form></div><div id="Update_Basic_Defaultmod_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Defaultmod', 'Update_Basic_Defaultmod_ProgressMessageWrapper', WADFP_Theme_Options['Bar:Nautica']);
</script>
<div id="Update_Basic_Defaultmod_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/nautica-bar.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Update_Basic_Defaultmod_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Inspiration",
    pointedAt: "right",
    fieldOffset: -2,
    fieldMargin: 0,
    position: "left",
    direction: "center",
    border: 1,
    offset: 5,
    closeText: "✖",
    percentWidth: 100,
    orientation: "bottom"
  };
function Update_Basic_Defaultmod_Validate() {
    $("#Update_Basic_Defaultmod").h5Validate(Update_Basic_Defaultmod_Opts);
  }
$(document).ready(function () {
  Update_Basic_Defaultmod_Validate()
  ConvertServerErrors(Update_Basic_Defaultmod_Opts);
});
</script>

</body>
</html>
<?php
mysql_free_result($WADAgame_system);
?>
