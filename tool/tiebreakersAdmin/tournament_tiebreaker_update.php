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
?>
<?php
$Paramtourney_tiebreaker_id_WADAtournament_tiebreaker = "-1";
if (isset($_GET['tourney_tiebreaker_id'])) {
  $Paramtourney_tiebreaker_id_WADAtournament_tiebreaker = $_GET['tourney_tiebreaker_id'];
}
mysql_select_db($database_local_local, $local_local);
$query_WADAtournament_tiebreaker = sprintf("SELECT tourney_tiebreaker_id, tiebreaker_name, match_id, `Game Title`, tiebreaker_conditions, point_value FROM tournament_tiebreaker WHERE tourney_tiebreaker_id = %s", GetSQLValueString($Paramtourney_tiebreaker_id_WADAtournament_tiebreaker, "-1"));
$WADAtournament_tiebreaker = mysql_query($query_WADAtournament_tiebreaker, $local_local) or die(mysql_error());
$row_WADAtournament_tiebreaker = mysql_fetch_assoc($WADAtournament_tiebreaker);
$totalRows_WADAtournament_tiebreaker = mysql_num_rows($WADAtournament_tiebreaker);

mysql_select_db($database_local_local, $local_local);
$query_GameSystem = "SELECT game_system_id, game_system_Title FROM game_system ORDER BY game_system_Title ASC";
$GameSystem = mysql_query($query_GameSystem, $local_local) or die(mysql_error());
$row_GameSystem = mysql_fetch_assoc($GameSystem);
$totalRows_GameSystem = mysql_num_rows($GameSystem);
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "tournament_tiebreaker";
  $WA_redirectURL = "tournament_tiebreaker_detail.php?tourney_tiebreaker_id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAtournament_tiebreaker"])?"&pageNum_WADAtournament_tiebreaker=".intval($_GET["pageNum_WADAtournament_tiebreaker"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "tourney_tiebreaker_id";
  $WA_fieldNamesStr = "tiebreaker_name|match_id|Game Title|tiebreaker_conditions|point_value";
  $WA_fieldValuesStr = "".((isset($_POST["tiebreaker_name"]))?$_POST["tiebreaker_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["match_id"]))?$_POST["match_id"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Game Title"]))?$_POST["Game Title"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tiebreaker_conditions"]))?$_POST["tiebreaker_conditions"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["point_value"]))?$_POST["point_value"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE | LIKE | LIKE | LIKE ";
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
  
  $WA_connectionDB = $database_local_local;
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
<title>Update</title>
<script src="../webassist/progress_bar/jquery-blockui-formprocessing.js" type="text/javascript"></script>

<link href="../webassist/forms/fd_basic_default.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../webassist/jq_validation/Modular.css">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<link href="file:///C|/xampp/htdocs/tourneyTool/webassist/forms/dataassist_button.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="Update_Basic_Default_ProgressWrapper">
<form class="Basic_Default" id="Update_Basic_Default" name="Update_Basic_Default" method="post" action="<?php echo(htmlentities($_SERVER["PHP_SELF"], ENT_QUOTES)."?".$_SERVER["QUERY_STRING"]); ?>">
        <fieldset class="Basic_Default" id="Update">
          <legend class="groupHeader">Update <?php echo $row_WADAtournament_tiebreaker['tiebreaker_name']; ?></legend>
    <div class="lineGroup"> <label for="tiebreaker_name" class="sublabel" > Tiebreaker/Mission Name:</label>
  <input id="tiebreaker_name" name="tiebreaker_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerupdate","tiebreaker_name"):"".$row_WADAtournament_tiebreaker["tiebreaker_name"]."")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="match_id" class="sublabel" > Round ID:</label>
  <input id="match_id" name="match_id" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerupdate","match_id"):"".$row_WADAtournament_tiebreaker["match_id"]."")); ?>" class="formTextfield_Medium" tabindex="2" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="Game Title" class="sublabel" > Game Title:</label>
      <select class="formMenufield_Medium" name="Game Title" id="Game Title" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerupdate","Game Title"):"".$row_WADAtournament_tiebreaker["Game Title"]."")); ?>" tabindex="3" title="Please enter a value.">
        <option value="">Choose Game...</option>
        <?php
do {  
?>
        <option value="<?php echo $row_GameSystem['game_system_Title']?>"<?php if (!(strcmp($row_GameSystem['game_system_Title'], $row_WADAtournament_tiebreaker['Game Title']))) {echo "selected=\"selected\"";} ?>><?php echo $row_GameSystem['game_system_Title']?></option>
        <?php
} while ($row_GameSystem = mysql_fetch_assoc($GameSystem));
  $rows = mysql_num_rows($GameSystem);
  if($rows > 0) {
      mysql_data_seek($GameSystem, 0);
	  $row_GameSystem = mysql_fetch_assoc($GameSystem);
  }
?>
      </select>
    </div> 
    <div class="lineGroup"> <label for="tiebreaker_conditions" class="sublabel" > Tiebreaker/Mission Conditions:</label>
  <textarea name="tiebreaker_conditions" id="tiebreaker_conditions" class="formTextarea_Medium" rows="1" cols="1" tabindex="4" title="Please enter a value."><?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerupdate","tiebreaker_conditions"):"".$row_WADAtournament_tiebreaker["tiebreaker_conditions"]."")); ?></textarea>
    </div> 
    <div class="lineGroup"> <label for="point_value" class="sublabel" > Point Value:</label>
  <input id="point_value" name="point_value" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerupdate","point_value"):"".$row_WADAtournament_tiebreaker["point_value"]."")); ?>" class="formTextfield_Medium" tabindex="5" title="Please enter a value.">
    </div> 
        <span class="buttonFieldGroup" >
          <input type="submit" value="Update" class="" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("tournamenttiebreakerupdate","WADAUpdateRecordID"):$_GET["tourney_tiebreaker_id"])); ?>" />
</form></div><div id="Update_Basic_Default_ProgressMessageWrapper" class="blockUIOverlay" style="display:none;">
<script type="text/javascript">
WADFP_SetProgressToForm('Update_Basic_Default', 'Update_Basic_Default_ProgressMessageWrapper', WADFP_Theme_Options['BigSpin:Slate']);
</script>
<div id="Update_Basic_Default_ProgressMessage" >
	<p style="margin:10px; padding:5px;" ><img src="../webassist/progress_bar/images/slate-largespin.gif" alt="" title="" style="vertical-align:middle;" />&nbsp;&nbsp;Please wait</p>
</div>
</div>


<script src="../webassist/forms/wa_servervalidation.js" type="text/javascript"></script>
<script src="../webassist/jq_validation/jquery.h5validate.js"></script>
<script>
var Update_Basic_Default_Opts = {
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
mysql_free_result($WADAtournament_tiebreaker);

mysql_free_result($GameSystem);
?>
