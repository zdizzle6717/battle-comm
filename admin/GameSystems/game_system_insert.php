<?php require_once('../../Connections/local.php'); ?>
<?php require_once("../../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local;
  $WA_table = "game_system";
  $WA_sessionName = "WADA_Insert_game_system";
  $WA_redirectURL = "game_system_detail.php?game_system_id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "game_system_Title|game_system_Title_version|game_system_publisher|game_system_official_url|game_logo|games_category|games_time|noOfPlayers";
  $WA_fieldValuesStr = "".((isset($_POST["game_system_Title"]))?$_POST["game_system_Title"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system_Title_version"]))?$_POST["game_system_Title_version"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system_publisher"]))?$_POST["game_system_publisher"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system_official_url"]))?$_POST["game_system_official_url"]:"")  ."" . $WA_AB_Split . "".($WA_DFP_UploadStatus["WA_UploadResult1"]["serverFileName"])  ."" . $WA_AB_Split . "".((isset($_POST["games_category"]))?$_POST["games_category"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["games_time"]))?$_POST["games_time"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["noOfPlayers"]))?$_POST["noOfPlayers"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''|',none,''";
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
	'UploadFolder' => "../../images/games",
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
	WA_DFP_UploadFiles("WA_UploadResult1", "game_logo", "0", "", "false", $WA_UploadResult1_Params);
}
?>
<?php require_once("../../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once("../../webassist/form_validations/wavt_validatedform_php.php"); ?>
<?php 
 if ((isset($_POST["Insert"]) || isset($_POST["Insert_x"])))  {
   $WAFV_Redirect = "".(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES))  ."?invalid=true";
   $_SESSION['WAVT_gamesysteminsert_Errors'] = "";
   if ($WAFV_Redirect == "")  {
     $WAFV_Redirect = $_SERVER["PHP_SELF"];
   }
   $WAFV_Errors = "";
   $WAFV_Errors .= WAValidateRQ((isset($_POST["game_system_Title"])?$_POST["game_system_Title"]:"") . "",true,1);
  $WAFV_Errors .= WAValidateUR((isset($_POST["game_system_official_url"])?$_POST["game_system_official_url"]:"") . "","http://",false,2);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"gamesysteminsert");
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
<title>Battle-Comm: Insert Game System</title>
    <link href="../../webassist/forms/fd_basic_defaultmod.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="../../webassist/jq_validation/Inspiration.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/magnificent-popup/magnificent-popup.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/form_clean.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="../../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
<link href="../../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<?php include '../../Templates/parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
<div id="Insert_Basic_Defaultmod_ProgressWrapper">
<form enctype="multipart/form-data"  class="clean" id="Insert_Basic_Defaultmod" name="Insert_Basic_Defaultmod" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Defaultmod" id="Insert">
          <legend class="groupHeader">Insert</legend>
 <span class="fieldsetDescription">
 Required *
 </span>
     <ol>
  	<li> <label for="game_system_Title" class="sublabel" > Title:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="game_system_Title" name="game_system_Title" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","game_system_Title"):"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value." required="true">
	   <?php
if (ValidatedField('gamesysteminsert','gamesysteminsert'))  {
  if ((strpos((",".ValidatedField("gamesysteminsert","gamesysteminsert").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="game_system_Title_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_system_insert.php gamesysteminsert(1:)
    }
  }
}?>
    </li> 
    <li> <label for="game_system_Title_version" class="sublabel" > Version:</label>
  <input id="game_system_Title_version" name="game_system_Title_version" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","game_system_Title_version"):"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </li> 
    <li> <label for="game_system_publisher" class="sublabel" > Publisher:</label>
  <input id="game_system_publisher" name="game_system_publisher" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","game_system_publisher"):"")); ?>" class="formTextfield_Large" tabindex="3" title="Please enter a value.">
    </li> 
    <li> <label for="game_system_official_url" class="sublabel" > Game System URL:</label>
  <input id="game_system_official_url" name="game_system_official_url" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","game_system_official_url"):"")); ?>" class="formTextfield_Large" tabindex="4" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('gamesysteminsert','gamesysteminsert'))  {
  if ((strpos((",".ValidatedField("gamesysteminsert","gamesysteminsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="game_system_official_url_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_system_insert.php gamesysteminsert(2:)
    }
  }
}?>
    </li> 
    <li> <label for="game_logo" class="sublabel" > Upload Logo:</label>
  <input name="game_logo" type="file" id="game_logo" size="30" tabindex="5" title="Please enter a value.">
    </li> 
    <li> <label for="games_category" class="sublabel" > Category:</label>
      <select class="formMenufield_Medium" name="games_category" id="games_category" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","games_category"):"")); ?>" tabindex="6" title="Please enter a value.">
      </select>
    </li> 
    <li> <label for="games_time" class="sublabel" > Play Time:</label>
  <input id="games_time" name="games_time" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","games_time"):"")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
    </li> 
    <li> <label for="noOfPlayers" class="sublabel" > noOfPlayers:</label>
  <input id="noOfPlayers" name="noOfPlayers" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","noOfPlayers"):"")); ?>" class="formTextfield_Medium" tabindex="8" title="Please enter a value.">
    </li> 
 </ol>
	<div class="full_width" >
		<div class="center">
        <span class="buttonFieldGroup" >
          <input type="submit" value="Insert" class="formButton Spacious" id="Insert" name="Insert" />
        </span>
    	</div>
    </div>
        </fieldset>
</form></div><div id="Insert_Basic_Defaultmod_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Insert_Basic_Defaultmod', 'Insert_Basic_Defaultmod_ProgressMessageWrapper', WADFP_Theme_Options['Bar:Nautica']);
</script>
<div id="Insert_Basic_Defaultmod_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../../webassist/progress_bar/images/nautica-bar.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>

  		<?php include '../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../Templates/parts/footer.php'; ?>

<script src="../../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Insert_Basic_Defaultmod_Opts = {
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
function Insert_Basic_Defaultmod_Validate() {
    $("#Insert_Basic_Defaultmod").h5Validate(Insert_Basic_Defaultmod_Opts);
  }
$(document).ready(function () {
  Insert_Basic_Defaultmod_Validate()
  ConvertServerErrors(Insert_Basic_Defaultmod_Opts);
});
</script>