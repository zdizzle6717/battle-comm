<?php require_once('../Connections/local.php'); ?>
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

$colname_rsTournament = "-1";
if (isset($_GET['tourney'])) {
  $colname_rsTournament = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_rsTournament = sprintf("SELECT * FROM tournament, game_system WHERE tournament_id = %s AND tournament.game_id", GetSQLValueString($colname_rsTournament, "int"));
$rsTournament = mysql_query($query_rsTournament, $local) or die(mysql_error());
$row_rsTournament = mysql_fetch_assoc($rsTournament);
$totalRows_rsTournament = mysql_num_rows($rsTournament);

$colname_rsRound = "-1";
if (isset($_GET['rd'])) {
  $colname_rsRound = $_GET['rd'];
}
mysql_select_db($database_local, $local);
$query_rsRound = sprintf("SELECT * FROM tournament_rounds WHERE rounds_id = %s", GetSQLValueString($colname_rsRound, "int"));
$rsRound = mysql_query($query_rsRound, $local) or die(mysql_error());
$row_rsRound = mysql_fetch_assoc($rsRound);
$totalRows_rsRound = mysql_num_rows($rsRound);

$colname_rsActivePlayers = "-1";
if (isset($_GET['tourney'])) {
  $colname_rsActivePlayers = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_rsActivePlayers = sprintf("SELECT * FROM tournament_players WHERE tournament_id = %s", GetSQLValueString($colname_rsActivePlayers, "int"));
$rsActivePlayers = mysql_query($query_rsActivePlayers, $local) or die(mysql_error());
$row_rsActivePlayers = mysql_fetch_assoc($rsActivePlayers);
$totalRows_rsActivePlayers = mysql_num_rows($rsActivePlayers);

$colname_rsTournamentPlayers = "-1";
if (isset($_GET['tourney'])) {
  $colname_rsTournamentPlayers = $_GET['tourney'];
}
$round_rsTournamentPlayers = "-1";
if (isset($_GET['rd'])) {
  $round_rsTournamentPlayers = $_GET['rd'];
}
mysql_select_db($database_local, $local);
$query_rsTournamentPlayers = sprintf("SELECT * FROM tournament_game_player WHERE tournament_id = %s AND tournament_game_player.tourney_round_id = %s", GetSQLValueString($colname_rsTournamentPlayers, "int"),GetSQLValueString($round_rsTournamentPlayers, "int"));
$rsTournamentPlayers = mysql_query($query_rsTournamentPlayers, $local) or die(mysql_error());
$row_rsTournamentPlayers = mysql_fetch_assoc($rsTournamentPlayers);
$totalRows_rsTournamentPlayers = mysql_num_rows($rsTournamentPlayers);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["submit"]) || isset($_POST["submit_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("playerID", "playerHandle", "roundID", "roundTitle", "tournamentID", "gameID", "GameTitle", "Table");
  $WA_connection = $local;
  $WA_table = "tournament_game_player";
  $WA_redirectURL = "AssignPlayers_Beta.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "player_id|player_handle|tourney_round_id|tourney_round_title|tournament_id|game_id|game_title|table_id";
  $WA_columnTypesStr = "none,none,NULL|',none,''|none,none,NULL|',none,''|none,none,NULL|none,none,NULL|',none,''|',none,''";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("playerID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("playerHandle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("roundID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("roundTitle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("tournamentID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("gameID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("GameTitle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("Table", $WA_multipleInsertCounter)  ."";
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
	// RepeatSelectionCounter_2 Initialization
	$RepeatSelectionCounter_2 = 0;
	$RepeatSelectionCounterBasedLooping_2 = false;
	$RepeatSelectionCounter_2_Iterations = "-1";
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Assign Rounds</title>

<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap-theme.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
<link href="admin_temp.css" rel="stylesheet" type="text/css"></head>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> <?php include("nav.php"); ?></div>
  </div>
  
  <div class="row">
    <div class="col-lg-12">
<p>Tournament: <?php echo $row_rsTournament['tournament_name']; ?></p>
<p>Round: <?php echo $row_rsRound['Round_Title']; ?></p>
<p>&nbsp;</p><form name="form1" method="post" action="">
  <table width="875" border="1">
    <tbody>
    <tr>
      <th scope="col">Player</th>
      <th scope="col">Round</th>
      <th scope="col">Table</th>
      </tr>
    <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_rsActivePlayers){
?>
    <tr style="text-align: center">
      <td><input type="hidden" name="playerID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="playerID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
        <input name="playerID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="playerID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rsActivePlayers['user_login_id']; ?>">
        <input name="playerHandle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="playerHandle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rsActivePlayers['userHandle']; ?>"></td>
      <td><input name="roundTitle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="roundTitle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rsRound['Round_Title']; ?>">
        <input name="roundID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="roundID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rsRound['rounds_id']; ?>">
        <input name="gameID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="gameID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rsTournament['game_system_id']; ?>">
        <input name="GameTitle_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="GameTitle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rsTournament['game_system_Title']; ?>"></td>
      <td><input name="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rsTournament['tournament_id']; ?>">
        <input name="Table_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="Table_<?php echo $RepeatSelectionCounter_1; ?>" value="Table"></td>
      </tr>
    <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_rsActivePlayers && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_rsActivePlayers = mysql_fetch_assoc($rsActivePlayers);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
<tr>
      <td><input name="submit" type="submit" id="submit" formmethod="POST" value="Add Players"></td>
      <td>&nbsp;</td>
      <td>Total Players: <?php echo $totalRows_rsActivePlayers ?></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
  </tbody>
</table>

</form>
 </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
<p>
<table width="875" border="1">
  <tbody>
    <tr>
      <th scope="col"><?php echo $row_rsTournament['tournament_name']; ?></th>
      <th scope="col">Round: <?php echo $row_rsRound['Round_Title']; ?></th>
      <th scope="col"><?php echo $row_rsRound['startTime']; ?>- <?php echo $row_rsRound['endTime']; ?></th>
      </tr>
    <tr>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      </tr>
    <tr>
      <th scope="col">Handle</th>
      <th scope="col">Round</th>
      <th scope="col">Table</th>
      </tr>
    <?php
	// RepeatSelectionCounter_2 Begin Loop
	$RepeatSelectionCounter_2_IterationsRemaining = $RepeatSelectionCounter_2_Iterations;
	while($RepeatSelectionCounter_2_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_2 || $row_rsTournamentPlayers){
?>
    <tr style="text-align: center">
      <td><?php echo $row_rsTournamentPlayers['player_handle']; ?></td>
      <td><?php echo $row_rsTournamentPlayers['tourney_round_title']; ?></td>
      <td><?php echo $row_rsTournamentPlayers['table_id']; ?></td>
      </tr>
    <?php
	} // RepeatSelectionCounter_2 Begin Alternate Content
	else{
?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <?php } // RepeatSelectionCounter_2 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_2 && $RepeatSelectionCounter_2_IterationsRemaining != 0){
			if(!$row_rsTournamentPlayers && $RepeatSelectionCounter_2_Iterations == -1){$RepeatSelectionCounter_2_IterationsRemaining = 0;}
			$row_rsTournamentPlayers = mysql_fetch_assoc($rsTournamentPlayers);
		}
		$RepeatSelectionCounter_2++;
	} // RepeatSelectionCounter_2 End Loop
?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      </tr>
  </tbody>
</table>
</p>
 </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
     <h2>Footer Left</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
<p>&nbsp;</p>
 </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
</body>
</html>
<?php
mysql_free_result($rsTournament);

mysql_free_result($rsRound);

mysql_free_result($rsActivePlayers);

mysql_free_result($rsTournamentPlayers);
?>
