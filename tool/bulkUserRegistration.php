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
$query_tournaments = "SELECT tournament_id, tournament_name FROM tournament ORDER BY tournament_name ASC";
$tournaments = mysql_query($query_tournaments, $local_local) or die(mysql_error());
$row_tournaments = mysql_fetch_assoc($tournaments);
$totalRows_tournaments = mysql_num_rows($tournaments);

mysql_select_db($database_local_local, $local_local);
$query_playersRandom = "SELECT * FROM players ORDER BY RAND () LIMIT 30";
$playersRandom = mysql_query($query_playersRandom, $local_local) or die(mysql_error());
$row_playersRandom = mysql_fetch_assoc($playersRandom);
$totalRows_playersRandom = mysql_num_rows($playersRandom);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["UserAdd"]) || isset($_POST["UserAdd_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("userID", "player");
  $WA_connection = $local_local;
  $WA_table = "tournament_players";
  $WA_redirectURL = "playerassignment4.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "tournament_id|user_login_id|userHandle|dateRegistered";
  $WA_columnTypesStr = "none,none,NULL|',none,''|',none,''|',none,NULL";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".((isset($_POST["tournamentID"]))?$_POST["tournamentID"]:"")  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("userID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("player", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".((isset($_POST["dateAdded"]))?$_POST["dateAdded"]:"")  ."";
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
	$RepeatSelectionCounter_1_Iterations = "1";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Bulk User Tournament Registration</title>
</head>

<body>
<h3>Add Multiple Players<br>
  *note-&gt;  This is a testing scenario, in &quot;real world&quot; situations, you would have specific users registered to the event- but in order to be more expedient, we are using a generic populated list.)
</h3>

<form name="bulkAdd" method="post" action="">
<p>1. Choose Tournament: <select name="tournamentID" id="tournamentID">
  <?php
do {  
?>
  <option value="<?php echo $row_tournaments['tournament_id']?>"><?php echo $row_tournaments['tournament_name']?></option>
  <?php
} while ($row_tournaments = mysql_fetch_assoc($tournaments));
  $rows = mysql_num_rows($tournaments);
  if($rows > 0) {
      mysql_data_seek($tournaments, 0);
	  $row_tournaments = mysql_fetch_assoc($tournaments);
  }
?>
</select></p>
<p>2. Add players</p>
<table width="700" border="1">
  <tr>
    <th width="193" scope="col">Handle</th>
    <th width="491" scope="col">LastName, First Name</th>
    <th width="491" scope="col">Email</th>
  </tr>
  <?php do { ?>
    <tr>
      <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_playersRandom){
?>
        <td align="center"><input type="hidden" name="userID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="userID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
          <input name="player_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="player_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_playersRandom['playerHandle']; ?>">
          &nbsp;
        <input name="userID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="userID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_playersRandom['playerId']; ?>"></td>
        <td><?php echo $row_playersRandom['playerLastName']; ?>, <?php echo $row_playersRandom['playerFirstName']; ?></td>
        <td><?php echo $row_playersRandom['playerEmail']; ?></td>
        <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
          <td>No records match your request.</td>
          <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_playersRandom && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_playersRandom = mysql_fetch_assoc($playersRandom);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
    </tr>
    <?php } while ($row_playersRandom = mysql_fetch_assoc($playersRandom)); ?>
</table>
<input name="dateAdded" type="hidden" id="dateAdded" value="<?php echo (date('Y-m-d')); ?>">
<p>
  <input name="UserAdd" type="submit" id="UserAdd" formmethod="POST" value="Add Players">
</p>
</form>
</body>
</html>
<?php
mysql_free_result($tournaments);

mysql_free_result($playersRandom);
?>
