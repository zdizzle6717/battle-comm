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

$colname_Tournament = "-1";
if (isset($_GET['tourney'])) {
  $colname_Tournament = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Tournament = sprintf("SELECT tournament_id, tournament_name FROM tournament WHERE tournament_id = %s", GetSQLValueString($colname_Tournament, "int"));
$Tournament = mysql_query($query_Tournament, $local_local) or die(mysql_error());
$row_Tournament = mysql_fetch_assoc($Tournament);
$totalRows_Tournament = mysql_num_rows($Tournament);

$colname_Rounds = "-1";
if (isset($_GET['tourney'])) {
  $colname_Rounds = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Rounds = sprintf("SELECT * FROM tournament_rounds WHERE tournament_id = %s", GetSQLValueString($colname_Rounds, "int"));
$Rounds = mysql_query($query_Rounds, $local_local) or die(mysql_error());
$row_Rounds = mysql_fetch_assoc($Rounds);
$totalRows_Rounds = mysql_num_rows($Rounds);

mysql_select_db($database_local_local, $local_local);
$query_GameSystems = "SELECT game_system_id, game_system_Title FROM game_system";
$GameSystems = mysql_query($query_GameSystems, $local_local) or die(mysql_error());
$row_GameSystems = mysql_fetch_assoc($GameSystems);
$totalRows_GameSystems = mysql_num_rows($GameSystems);

$colname_Match = "-1";
if (isset($_GET['tourney'])) {
  $colname_Match = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Match = sprintf("SELECT * FROM tournament_match WHERE tournament_id = %s ORDER BY tournament_round_id ASC", GetSQLValueString($colname_Match, "text"));
$Match = mysql_query($query_Match, $local_local) or die(mysql_error());
$row_Match = mysql_fetch_assoc($Match);
$totalRows_Match = mysql_num_rows($Match);?>
<?php 
// WA DataAssist Insert
if (isset($_POST["matchSubmit"]) || isset($_POST["matchSubmit_x"])) // Trigger
{
  $WA_connection = $local_local;
  $WA_table = "tournament_match";
  $WA_sessionName = "match_ID";
  $WA_redirectURL = "match_setup.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "tournament_round_id|tournament_id|game_system_id|noOfGames";
  $WA_fieldValuesStr = "".((isset($_POST["rounds"]))?$_POST["rounds"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["hiddenField"]))?$_POST["hiddenField"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["Game"]))?$_POST["Game"]:"")  ."" . $WA_AB_Split . "".((isset($_POST["NoOfGames"]))?$_POST["NoOfGames"]:"")  ."";
  $WA_columnTypesStr = "',none,''|',none,''|',none,''|none,none,NULL";
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
<title>Configure Matches for <?php echo $row_Tournament['tournament_name']; ?> </title>
</head>

<body>
<p>&nbsp;</p>
<h3>Match Setups for <?php echo $row_Tournament['tournament_name']; ?></h3>
<form name="setMatch" method="post" action="" ><table width="600" border="1">
  <tr>
    <th width="314" scope="col">Round</th>
    <th width="270" scope="col">Game</th>
    <th width="270" scope="col">Number of Games</th>
    </tr>
  <tr>
    <td><select name="rounds" id="rounds">
      <option value="">Choose Round..</option>
      <?php
do {  
?>
      <option value="<?php echo $row_Rounds['Round_Title']?>"><?php echo $row_Rounds['Round_Title']?></option>
      <?php
} while ($row_Rounds = mysql_fetch_assoc($Rounds));
  $rows = mysql_num_rows($Rounds);
  if($rows > 0) {
      mysql_data_seek($Rounds, 0);
	  $row_Rounds = mysql_fetch_assoc($Rounds);
  }
?>
    </select>
    </td>
    <td><select name="Game" id="Game">
    <option value="">Choose Game..</option>
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
    </select> <input name="hiddenField" type="hidden" id="hiddenField" value="<?php echo $row_Tournament['tournament_id']; ?>"></td>
    <td><input name="NoOfGames" type="text" id="NoOfGames"></td>
    </tr>
  <tr>
    <td><input name="matchSubmit" type="submit" id="matchSubmit"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table></form>
<p>&nbsp;</p>
<p>Configured Matches for <?php echo $row_Tournament['tournament_name']; ?></p>
<table width="600" border="1">
  <tr>
    <th scope="col">Round</th>
    <th scope="col">Game</th>
    <th scope="col">Number of Games</th>
    <th scope="col">Tools</th>
  </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_Match){
?>
  <tr>
    <td><?php echo $row_Match['tournament_round_id']; ?></td>
    <td><?php echo $row_Match['game_system_id']; ?></td>
    <td><?php echo $row_Match['noOfGames']; ?></td>
    <td><a href="playerAssignment.php?tourney=<?php echo $row_Tournament['tournament_id']; ?>&g=<?php echo $row_Match['game_system_id']; ?>&m=<?php echo $row_Match['tournament_match_id']; ?>">Assign Players</a></td>
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
			if(!$row_Match && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_Match = mysql_fetch_assoc($Match);
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
<p><a href="tiebreaker_setup.php?tourney=<?php echo $row_Tournament['tournament_id']; ?>">&gt;&gt;Configure Tiebreakers&gt;&gt;</a></p>
</body>
</html>
<?php
mysql_free_result($Tournament);

mysql_free_result($Rounds);

mysql_free_result($GameSystems);

mysql_free_result($Match);
?>
