<?php require_once('Connections/local_local.php'); ?>
<?php require_once("webassist/database_management/wa_appbuilder_php.php"); ?>
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
$query_players = "SELECT * FROM players ORDER BY RAND()";
$players = mysql_query($query_players, $local_local) or die(mysql_error());
$row_players = mysql_fetch_assoc($players);
$totalRows_players = mysql_num_rows($players);

mysql_select_db($database_local_local, $local_local);
$query_Tournament = "SELECT tournament_id, tournament_name FROM tournament";
$Tournament = mysql_query($query_Tournament, $local_local) or die(mysql_error());
$row_Tournament = mysql_fetch_assoc($Tournament);
$totalRows_Tournament = mysql_num_rows($Tournament);?>
<?php
// WA DataAssist Multiple Inserts
if ($_SERVER["REQUEST_METHOD"] == "POST") // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("playerID", "userHandle");
  $WA_connection = $local_local;
  $WA_table = "tournament_players";
  $WA_redirectURL = "";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "tournament_id|user_login_id|userHandle";
  $WA_columnTypesStr = "none,none,NULL|',none,''|',none,''";
  $WA_insertIfNotBlank = "insertRecord";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".((isset($_POST["tournamentID"]))?$_POST["tournamentID"]:"")  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("playerID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("userHandle", $WA_multipleInsertCounter)  ."";
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
}?>
<?php
// WA DataAssist Multiple Inserts
if ($_SERVER["REQUEST_METHOD"] == "POST") // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("playerID", "userHandle");
  $WA_connection = $local_local;
  $WA_table = "tournament_players2";
  $WA_redirectURL = "";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = false;
  $WA_fieldNamesStr = "tournament_id|user_login_id|userHandle";
  $WA_columnTypesStr = "none,none,NULL|',none,''|',none,''";
  $WA_insertIfNotBlank = "insertRecord";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".((isset($_POST["tournamentID"]))?$_POST["tournamentID"]:"")  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("playerID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("userHandle", $WA_multipleInsertCounter)  ."";
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
	$RepeatSelectionCounter_1_Iterations = "25";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<p>&nbsp;</p>
<form action="" method="post" name="insertPlayers" id="insertPlayers">
<p>1. Choose Tournament: <select name="tournamentID" id="tournamentID">
  <option value=""></option>
  <?php
do {  
?>
  <option value="<?php echo $row_Tournament['tournament_id']?>"><?php echo $row_Tournament['tournament_id']?></option>
  <?php
} while ($row_Tournament = mysql_fetch_assoc($Tournament));
  $rows = mysql_num_rows($Tournament);
  if($rows > 0) {
      mysql_data_seek($Tournament, 0);
	  $row_Tournament = mysql_fetch_assoc($Tournament);
  }
?>
</select> 
</p>
<table width="700" border="1">
  <tr>
    <th scope="col">Handle</th>
    <th scope="col">Last Name, first Name</th>
    <th scope="col">Email</th>
    <th scope="col">&nbsp;</th>
    </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_players){
?>
<tr>
  <td align="center"><input type="hidden" name="playerID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="playerID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
    <input name="playerID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="playerID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_players['playerId']; ?>"><input name="userHandle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="userHandle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_players['playerHandle']; ?>"></td>
  <td><?php echo $row_players['playerLastName']; ?>, <?php echo $row_players['playerFirstName']; ?></td>
  <td><?php echo $row_players['playerEmail']; ?></td>
  <td><input name="insertRecord_<?php echo $RepeatSelectionCounter_1; ?>" type="checkbox" id="insertRecord_<?php echo $RepeatSelectionCounter_1; ?>" form="insertPlayers" title="insertRecord" value="Yes">&nbsp;</td>
</tr>
<?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_players && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_players = mysql_fetch_assoc($players);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;<input name="Insert_Players" type="submit" id="Insert_Players" formmethod="POST" value="Add Players"></p>

</form>
</body>
</html>
<?php
mysql_free_result($players);

mysql_free_result($Tournament);
?>
