<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php
mysql_select_db($database_local_local, $local_local);
$query_WADAMenugame_system_id = "SELECT game_system_Title, game_system_id FROM game_system ORDER BY game_system_Title ASC";
$WADAMenugame_system_id = mysql_query($query_WADAMenugame_system_id, $local_local) or die(mysql_error());
$row_WADAMenugame_system_id = mysql_fetch_assoc($WADAMenugame_system_id);
$totalRows_WADAMenugame_system_id = mysql_num_rows($WADAMenugame_system_id);
?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "factions";
  $WA_sessionName = "WADA_Insert_factions";
  $WA_redirectURL = "factions_detail.php?faction_id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "faction_name|game_system_id";
  $WA_fieldValuesStr = "".((isset($_POST["faction_name"]))?$_POST["faction_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system_id"]))?$_POST["game_system_id"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''";
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
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
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
<link href="../../players/css/customPlayer.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="row" id="nav"><h2>BattleComm.com Tourney Tool</h2><br>
   <?php include("../nav.php"); ?>
</div>
<div id="Insert_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Insert</legend>
    <div class="lineGroup"> <label for="faction_name" class="sublabel" > Faction Name:</label>
  <input id="faction_name" name="faction_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("factionsinsert","faction_name"):"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system_id" class="sublabel" > Game Systsem:</label>
      <select class="formMenufield_Medium" name="game_system_id" id="game_system_id" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("factionsinsert","game_system_id"):"")); ?>" tabindex="2" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenugame_system_id['game_system_id']?>"<?php if (!(strcmp($row_WADAMenugame_system_id['game_system_id'], (isset($_GET["invalid"])?ValidatedField("factionsinsert","game_system_id"):"")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugame_system_id['game_system_Title']?></option>
        <?php
} while ($row_WADAMenugame_system_id = mysql_fetch_assoc($WADAMenugame_system_id));
  $rows = mysql_num_rows($WADAMenugame_system_id);
  if($rows > 0) {
      mysql_data_seek($WADAMenugame_system_id, 0);
	  $row_WADAMenugame_system_id = mysql_fetch_assoc($WADAMenugame_system_id);
  }
?>
</select>
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
<?php include("../../includes/lowernav.php"); ?>
</body>
</html>
<?php
mysql_free_result($WADAMenugame_system_id);
?>
