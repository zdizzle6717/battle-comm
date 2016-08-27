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

$colname_tournament = "-1";
if (isset($_GET['tourney'])) {
  $colname_tournament = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_tournament = sprintf("SELECT * FROM tournament WHERE tournament_id = %s", GetSQLValueString($colname_tournament, "int"));
$tournament = mysql_query($query_tournament, $local_local) or die(mysql_error());
$row_tournament = mysql_fetch_assoc($tournament);
$totalRows_tournament = mysql_num_rows($tournament);

$colname_rounds = "-1";
if (isset($_GET['tourney'])) {
  $colname_rounds = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_rounds = sprintf("SELECT * FROM tournament_rounds WHERE tournament_id = %s", GetSQLValueString($colname_rounds, "int"));
$rounds = mysql_query($query_rounds, $local_local) or die(mysql_error());
$row_rounds = mysql_fetch_assoc($rounds);
$totalRows_rounds = mysql_num_rows($rounds);

mysql_select_db($database_local_local, $local_local);
$query_tiebreakers = "SELECT * FROM tournament_tiebreaker";
$tiebreakers = mysql_query($query_tiebreakers, $local_local) or die(mysql_error());
$row_tiebreakers = mysql_fetch_assoc($tiebreakers);
$totalRows_tiebreakers = mysql_num_rows($tiebreakers);

$colname_tournamentConfigured = "-1";
if (isset($_GET['tourney'])) {
  $colname_tournamentConfigured = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_tournamentConfigured = sprintf("SELECT * FROM tournament_tiebreaker, tournament_game_tiebreaker_lookup WHERE tournament_game_tiebreaker_lookup.tournament_id = %s AND tournament_game_tiebreaker_lookup.tournament_tiebreaker_id = tournament_tiebreaker.tourney_tiebreaker_id", GetSQLValueString($colname_tournamentConfigured, "int"));
$tournamentConfigured = mysql_query($query_tournamentConfigured, $local_local) or die(mysql_error());
$row_tournamentConfigured = mysql_fetch_assoc($tournamentConfigured);
$totalRows_tournamentConfigured = mysql_num_rows($tournamentConfigured);?>
<?php 
// WA DataAssist Insert
if (isset($_POST["Rounds_Submit"]) || isset($_POST["Rounds_Submit_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "tournament_game_tiebreaker_lookup";
  $WA_sessionName = "tiebreaker";
  $WA_redirectURL = "tiebreaker_setup.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "tournament_round_id|tournament_id|tournament_tiebreaker_id";
  $WA_fieldValuesStr = "".((isset($_POST["match_choice"]))?$_POST["match_choice"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tournamentID"]))?$_POST["tournamentID"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["tiebreaker"]))?$_POST["tiebreaker"]:"")  ."";
  $WA_columnTypesStr = "none,none,NULL|none,none,NULL|none,none,NULL";
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
<title>Setup Tiebreakers/Missions for <?php echo $row_tournament['tournament_name']; ?></title>
</head>

<body>
<h3>Tiebreaker Configuration for <?php echo $row_tournament['tournament_name']; ?></h3>
<p>Add Tiebreaker | View Tiebreakers Master List</p><form name="mission_rounds" method="post" action="">
<table width="600" border="1">
  <tr>
    <th scope="col">Round</th>
    <th scope="col">Name</th>
  </tr>
  <tr>
    <td><select name="match_choice" id="match_choice">
      <option value="">Choose Round...</option>
      <?php
do {  
?>
<option value="<?php echo $row_rounds['rounds_id']?>"><?php echo $row_rounds['Round_Title']?></option>
      <?php
} while ($row_rounds = mysql_fetch_assoc($rounds));
  $rows = mysql_num_rows($rounds);
  if($rows > 0) {
      mysql_data_seek($rounds, 0);
	  $row_rounds = mysql_fetch_assoc($rounds);
  }
?>
    </select> <input name="tournamentID" type="hidden" id="tournamentID" value="<?php echo $row_tournament['tournament_id']; ?>"></td>
    <td><select name="tiebreaker" id="tiebreaker">
      <option value="">Choose Mission...</option>
      <?php
do {  
?>
<option value="<?php echo $row_tiebreakers['tourney_tiebreaker_id']?>"><?php echo $row_tiebreakers['tiebreaker_name']?></option>
      <?php
} while ($row_tiebreakers = mysql_fetch_assoc($tiebreakers));
  $rows = mysql_num_rows($tiebreakers);
  if($rows > 0) {
      mysql_data_seek($tiebreakers, 0);
	  $row_tiebreakers = mysql_fetch_assoc($tiebreakers);
  }
?>
    </select></td>
  </tr>
  <tr>
    <td><input name="Rounds_Submit" type="submit" id="Rounds_Submit" formmethod="POST" value="Submit">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
<p>&nbsp; </p>
<p>Configured Tiebreakers</p>
<table width="600" border="1">
  <tr>
    <th scope="col">Round</th>
    <th scope="col">Game</th>
    <th scope="col">Mission</th>
    <th scope="col">Points</th>
  </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_tournamentConfigured){
?>
  <tr>
    <td><?php echo $row_tournamentConfigured['tournament_round_id']; ?></td>
    <td><?php echo $row_tournamentConfigured['game_system_id']; ?></td>
    <td><?php echo $row_tournamentConfigured['tiebreaker_name']; ?></td>
    <td><?php echo $row_tournamentConfigured['point_value']; ?></td>
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
			if(!$row_tournamentConfigured && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_tournamentConfigured = mysql_fetch_assoc($tournamentConfigured);
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
<p>&gt;&gt;&gt;<a href="playerAssignment_new.php?tourney=<?php echo $row_tournament['tournament_id']; ?>&rd=<?php echo $row_rounds['rounds_id']; ?>">Player Assignment</a>&gt;&gt;&gt;</p>
</body>
</html>
<?php
mysql_free_result($tournament);

mysql_free_result($rounds);

mysql_free_result($tiebreakers);

mysql_free_result($tournamentConfigured);
?>
