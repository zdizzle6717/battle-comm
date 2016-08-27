<?php require_once("../webassist/form_validations/wavt_scripts_php.php"); ?>
<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/form_validations/wavt_validatedform_php.php"); ?>
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
  $WAFV_Errors .= WAValidateNM((isset($_POST["noOfPlayers"])?$_POST["noOfPlayers"]:"") . "","","",0,",.",true,3);

   if ($WAFV_Errors != "")  {
     PostResult($WAFV_Redirect,$WAFV_Errors,"gamesysteminsert");
   }
 }
 ?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
mysql_select_db($database_local_local, $local_local);
$query_WADAMenugames_category = "SELECT game_category FROM game_categories ORDER BY game_category ASC";
$WADAMenugames_category = mysql_query($query_WADAMenugames_category, $local_local) or die(mysql_error());
$row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category);
$totalRows_WADAMenugames_category = mysql_num_rows($WADAMenugames_category);
?>
<?php
// WA_UploadResult1 Params Start
$WA_UploadResult1_Params = array();
// WA_UploadResult1_1 Start
$WA_UploadResult1_Params["WA_UploadResult1_1"] = array(
	'UploadFolder' => "../uploads/gameSystems/",
	'FileName' => "[FileName]",
	'DefaultFileName' => "",
	'ResizeType' => "0",
	'ResizeWidth' => "0",
	'ResizeHeight' => "0",
	'ResizeFillColor' => "" );
// WA_UploadResult1_1 End
// WA_UploadResult1_2 Start
$WA_UploadResult1_Params["WA_UploadResult1_2"] = array(
	'UploadFolder' => "../uploads/gameSystems/thumbnails/",
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
	WA_DFP_UploadFiles("WA_UploadResult1", "game_logo", "2", "[ExistingFileName]_[Increment]", "true", $WA_UploadResult1_Params);
}
?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local_local;
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
  $WA_connectionDB = $database_local_local;
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
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../webassist/jq_validation/Modular.css">

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
    <div class="lineGroup"> <label for="game_system_Title" class="sublabel" > Title:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="game_system_Title" name="game_system_Title" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","game_system_Title"):"")); ?>" class="formTextfield_Large" tabindex="1" title="Please enter a value." required>
	   <?php
if (ValidatedField('gamesysteminsert','gamesysteminsert'))  {
  if ((strpos((",".ValidatedField("gamesysteminsert","gamesysteminsert").","), "," . "1" . ",") !== false || "1" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="game_system_Title_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_system_insert.php gamesysteminsert(1:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="game_system_Title_version" class="sublabel" > Version:</label>
  <input id="game_system_Title_version" name="game_system_Title_version" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","game_system_Title_version"):"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system_publisher" class="sublabel" > Publisher:</label>
  <input id="game_system_publisher" name="game_system_publisher" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","game_system_publisher"):"")); ?>" class="formTextfield_Large" tabindex="3" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system_official_url" class="sublabel" > Game System URL:</label>
  <input id="game_system_official_url" name="game_system_official_url" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","game_system_official_url"):"")); ?>" class="formTextfield_Large" tabindex="4" pattern="(?:https?|ftp)\:\/\/(?:(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=:]|%[0-9a-f]{2,2})*\@)?(?:((?:(?:[a-z0-9][a-z0-9\-]*[a-z0-9]|[a-z0-9])\.)*(?:[a-z][a-z0-9\-]*[a-z0-9]|[a-z])|(?:\[[^\]]*\]))(?:\:[0-9]*)?)(?:\/(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@]|%[0-9a-f]{2,2})*)*(?:\?(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?(?:\#(?:[a-z0-9\-\._~\!\$\&\'\(\)\*\+\,\;\=\:\@\/\?]|%[0-9a-f]{2,2})*)?" title="Please enter a value.">
	   <?php
if (ValidatedField('gamesysteminsert','gamesysteminsert'))  {
  if ((strpos((",".ValidatedField("gamesysteminsert","gamesysteminsert").","), "," . "2" . ",") !== false || "2" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="game_system_official_url_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_system_insert.php gamesysteminsert(2:)
    }
  }
}?>
    </div> 
    <div class="lineGroup"> <label for="game_logo" class="sublabel" > Logo:</label>
  <input name="game_logo" type="file" id="game_logo" size="30" tabindex="5" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="games_category" class="sublabel" > Category:</label>
      <select class="formMenufield_Medium" name="games_category" id="games_category" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","games_category"):"")); ?>" tabindex="6" title="Please enter a value.">
<option value="">Choose Category...</option>
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenugames_category['game_category']?>"<?php if (!(strcmp($row_WADAMenugames_category['game_category'], (isset($_GET["invalid"])?ValidatedField("gamesysteminsert","games_category"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugames_category['game_category']?></option>
        <?php
} while ($row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category));
  $rows = mysql_num_rows($WADAMenugames_category);
  if($rows > 0) {
      mysql_data_seek($WADAMenugames_category, 0);
	  $row_WADAMenugames_category = mysql_fetch_assoc($WADAMenugames_category);
  }
?>
</select>
    </div> 
    <div class="lineGroup"> <label for="games_time" class="sublabel" > Length of Play:</label>
  <input id="games_time" name="games_time" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","games_time"):"")); ?>" class="formTextfield_Medium" tabindex="7" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="noOfPlayers" class="sublabel" > Number of Players:<span class="requiredIndicator">&nbsp;*</span></label>
  <input id="noOfPlayers" name="noOfPlayers" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("gamesysteminsert","noOfPlayers"):"")); ?>" class="formTextfield_Small" tabindex="8" title="Please enter a value." required>
	   <?php
if (ValidatedField('gamesysteminsert','gamesysteminsert'))  {
  if ((strpos((",".ValidatedField("gamesysteminsert","gamesysteminsert").","), "," . "3" . ",") !== false || "3" == ""))  {
    if (!(false))  {
?><span class="serverInvalidState" id="noOfPlayers_ServerError">Please enter a value.</span><?php //WAFV_Conditional game_system_insert.php gamesysteminsert(3:)
    }
  }
}?>
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Insert" class="" id="Insert" name="Insert" />
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
<script src="../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Insert_Basic_Default_Opts = {
    focusout: true,
    focusin: false,
    change: false,
    keyup: false,
    popupClass: "Modular",
    pointedAt: "right",
    fieldOffset: 0,
    fieldMargin: 0,
    position: "left",
    direction: "right",
    border: 1,
    offset: 20,
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
mysql_free_result($WADAMenugames_category);
?>
