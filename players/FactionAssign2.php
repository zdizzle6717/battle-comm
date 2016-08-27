<?php require_once('../Connections/local.php'); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}

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

$colname_Factions = "-1";
if (isset($_GET['gsi'])) {
  $colname_Factions = $_GET['gsi'];
}
mysql_select_db($database_local, $local);
$query_Factions = sprintf("SELECT * FROM factions WHERE game_system_id = %s", GetSQLValueString($colname_Factions, "int"));
$Factions = mysql_query($query_Factions, $local) or die(mysql_error());
$row_Factions = mysql_fetch_assoc($Factions);
$totalRows_Factions = mysql_num_rows($Factions);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["FactionJoin"]) || isset($_POST["FactionJoin_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("Name", "id");
  $WA_connection = $local;
  $WA_table = "AssignedFactions";
  $WA_redirectURL = "FactionAssign2.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "factions_Name|factions_id|player_id";
  $WA_columnTypesStr = "',none,''|none,none,NULL|none,none,NULL";
  $WA_insertIfNotBlank = "join";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("Name", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("id", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".$_SESSION['SecurityAssist_id']  ."";
      $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
      $insertParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
      $WA_Sql = "INSERT INTO `" . $WA_table . "` (" . $insertParamsObj->WA_tableValues . ") VALUES (" . $insertParamsObj->WA_dbValues . ")";
      $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
    }
    $WA_multipleInsertCounter++;
  }
  if ($WA_redirectURL != "")  {
    if ($WA_keepQueryString && $WA_redirectURL != "" && isset($_SERVER["QUERY_STRING"]) && $_SERVER["QUERY_STRING"] !== "" && sizeof($_POST) > 0) {
      $WA_redirectURL .= ((strpos($WA_redirectURL, '?') === false)?"?":"&").$_SERVER["QUERY_STRING"];
    }
    header("Location: ".$WA_redirectURL);
  }
}
?>
<?php
	// RepeatSelectionCounter_1 Initialization
	$RepeatSelectionCounter_1 = 0;
	$RepeatSelectionCounterBasedLooping_1 = false;
	$RepeatSelectionCounter_1_Iterations = "-1";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Assign Factions</title>
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="row" id="nav"><h2>BattleComm.com Tourney Tool</h2><br>
   
</div>
<form method="post" id="factionINsert">
<table width="600" border="1">
  <tbody>
    <tr>
      <th scope="col">Faction</th>
      <th scope="col">Join</th>
    </tr>
    <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_Factions){
?>
    <tr>
      <td><?php echo $row_Factions['faction_name']; ?> <input type="hidden" name="Name_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="Name_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
        <input name="Name_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="Name_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_Factions['faction_name']; ?>"><input name="id_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="id_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_Factions['faction_id']; ?>"></td>
      <td><input type="checkbox" name="join_<?php echo $RepeatSelectionCounter_1; ?>" id="join_<?php echo $RepeatSelectionCounter_1; ?>"></td>
    </tr>
    <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_Factions && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_Factions = mysql_fetch_assoc($Factions);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
    <tr>
      <td><input name="FactionJoin" type="submit" id="submit" formmethod="POST" value="Join Factions"></td>
      <td>&nbsp;</td>
  </tr>
  </tbody>
</table>

</form>
<?php include("../includes/lowernav.php"); ?>
</body>
</html>
<?php
mysql_free_result($Factions);
?>
