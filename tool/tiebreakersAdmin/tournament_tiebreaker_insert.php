<?php require_once('../Connections/local_local.php'); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
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

mysql_select_db($database_local_local, $local_local);
$query_GameSystems = "SELECT game_system_id, game_system_Title FROM game_system ORDER BY game_system_Title ASC";
$GameSystems = mysql_query($query_GameSystems, $local_local) or die(mysql_error());
$row_GameSystems = mysql_fetch_assoc($GameSystems);
$totalRows_GameSystems = mysql_num_rows($GameSystems);
 
// WA DataAssist Insert
if (isset($_POST["Insert"]) || isset($_POST["Insert_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "tournament_tiebreaker";
  $WA_sessionName = "WADA_Insert_tournament_tiebreaker";
  $WA_redirectURL = "tournament_tiebreaker_detail.php?tourney_tiebreaker_id=[Insert_ID]";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "tiebreaker_name|match_id|Game Title|tiebreaker_conditions|point_value";
  $WA_fieldValuesStr = "".((isset($_POST["tiebreaker_name"]))?$_POST["tiebreaker_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["match_id"]))?$_POST["match_id"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Game Title"]))?$_POST["Game Title"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tiebreaker_conditions"]))?$_POST["tiebreaker_conditions"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["point_value"]))?$_POST["point_value"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''";
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
<title>Insert new Tiebreaker/Mission</title>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../webassist/jq_validation/Modular.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="../webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include("../nav.php"); ?>
<div id="Insert_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Insert_Basic_Default" name="Insert_Basic_Default" method="post" action="<?php echo (htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)); ?>">
        <fieldset class="Basic_Default" id="Insert">
          <legend class="groupHeader">Insert New Tiebreaker/Mission</legend>
    <div class="lineGroup"> <label for="tiebreaker_name" class="sublabel" > Tiebreaker/Mission Name:</label>
  <input id="tiebreaker_name" name="tiebreaker_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerinsert","tiebreaker_name"):"")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="match_id" class="sublabel" > Round ID:</label>
  <input id="match_id" name="match_id" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerinsert","match_id"):"")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="Game Title" class="sublabel" > Game Title:</label>
      <select class="formMenufield_Medium" name="Game Title" id="Game Title" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerinsert","Game Title"):"")); ?>" tabindex="3" title="Please enter a value.">
        <option value="">Choose Game...</option>
        <?php
do {  
?>
        <option value="<?php echo $row_GameSystems['game_system_Title']?>"><?php echo $row_GameSystems['game_system_Title']?></option>
        <?php
} while ($row_GameSystems = mysql_fetch_assoc($GameSystems));
  $rows = mysql_num_rows($GameSystems);
  if($rows > 0) {
      mysql_data_seek($GameSystems, 0);
	  $row_GameSystems = mysql_fetch_assoc($GameSystems);
  }
?>
      </select>
    </div> 
    <div class="lineGroup"> <label for="tiebreaker_conditions" class="sublabel" > Tiebreaker/Mission Conditions:</label>
  <textarea name="tiebreaker_conditions" id="tiebreaker_conditions" class="formTextarea_Medium" rows="1" cols="1" tabindex="4" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerinsert","tiebreaker_conditions"):"")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="point_value" class="sublabel" > Point Value:</label>
  <input id="point_value" name="point_value" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerinsert","point_value"):"")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
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
mysql_free_result($GameSystems);
?>
