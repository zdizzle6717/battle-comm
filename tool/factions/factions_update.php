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
$Paramfaction_id_WADAfactions = "-1";
if (isset($_GET['faction_id'])) {
  $Paramfaction_id_WADAfactions = $_GET['faction_id'];
}
mysql_select_db($database_local_local, $local_local);
$query_WADAfactions = sprintf("SELECT faction_id, faction_name, game_system_id FROM factions WHERE faction_id = %s", GetSQLValueString($Paramfaction_id_WADAfactions, "int"));
$WADAfactions = mysql_query($query_WADAfactions, $local_local) or die(mysql_error());
$row_WADAfactions = mysql_fetch_assoc($WADAfactions);
$totalRows_WADAfactions = mysql_num_rows($WADAfactions);
?>
<?php
mysql_select_db($database_local_local, $local_local);
$query_WADAMenugame_system_id = "SELECT game_system_Title, game_system_id FROM game_system ORDER BY game_system_Title ASC";
$WADAMenugame_system_id = mysql_query($query_WADAMenugame_system_id, $local_local) or die(mysql_error());
$row_WADAMenugame_system_id = mysql_fetch_assoc($WADAMenugame_system_id);
$totalRows_WADAMenugame_system_id = mysql_num_rows($WADAMenugame_system_id);
?>
<?php 
// WA DataAssist Update
if (isset($_POST["Update"]) || isset($_POST["Update_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "factions";
  $WA_redirectURL = "factions_detail.php?faction_id=".((isset($_POST["WADAUpdateRecordID"]))?$_POST["WADAUpdateRecordID"]:"")  ."".(isset($_GET["pageNum_WADAfactions"])?"&pageNum_WADAfactions=".intval($_GET["pageNum_WADAfactions"]):"")  ."";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_indexField = "faction_id";
  $WA_fieldNamesStr = "faction_name|game_system_id";
  $WA_fieldValuesStr = "".((isset($_POST["faction_name"]))?$_POST["faction_name"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["game_system_id"]))?$_POST["game_system_id"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''";
  $WA_comparisonStr = " LIKE | LIKE ";
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
<title>Untitled Document</title>
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
          <legend class="groupHeader">Update</legend>
    <div class="lineGroup"> <label for="faction_name" class="sublabel" > Faction Name:</label>
  <input id="faction_name" name="faction_name" type="text" value="<?php echo((isset($_GET["invalid"])?ValidatedField("factionsupdate","faction_name"):"".$row_WADAfactions["faction_name"]."")); ?>" class="formTextfield_Medium" tabindex="1" title="Please enter a value.">
    </div> 
    <div class="lineGroup"> <label for="game_system_id" class="sublabel" > Game Systsem:</label>
      <select class="formMenufield_Medium" name="game_system_id" id="game_system_id" rel="<?php echo((isset($_GET["invalid"])?ValidatedField("factionsupdate","game_system_id"):"".$row_WADAfactions["game_system_id"]."")); ?>" tabindex="2" title="Please enter a value.">
<?php
do {  
?>
        <option value="<?php echo $row_WADAMenugame_system_id['game_system_id']?>"<?php if (!(strcmp($row_WADAMenugame_system_id['game_system_id'], (isset($_GET["invalid"])?ValidatedField("factionsupdate","game_system_id"):"".$row_WADAfactions["game_system_id"]."")))) {echo "selected=\"selected\"";} ?>><?php echo $row_WADAMenugame_system_id['game_system_Title']?></option>
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
          <input type="submit" value="Update" class="" id="Update" name="Update" />
        </span>
        </fieldset>
<input type="hidden" name="WADAUpdateRecordID" id="WADAUpdateRecordID" value="<?php echo((isset($_GET["invalid"])?ValidatedField("factionsupdate","WADAUpdateRecordID"):$_GET["faction_id"])); ?>" />
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
mysql_free_result($WADAfactions);
?>
<?php
mysql_free_result($WADAMenugame_system_id);
?>
