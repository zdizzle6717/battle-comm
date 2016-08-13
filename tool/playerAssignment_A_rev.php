<?php require_once('Connections/local_local.php'); ?>
<?php require_once('../Connections/local.php'); ?>
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
}if (!function_exists("GetSQLValueString")) {
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

$tourney_ActivePlayer = "-1";
if (isset($_GET['tourney'])) {
  $tourney_ActivePlayer = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_ActivePlayer = sprintf("SELECT * FROM tournament_players WHERE tournament_players.user_confirmed = 'yes' AND tournament_players.tournament_id = %s", GetSQLValueString($tourney_ActivePlayer, "int"));
$ActivePlayer = mysql_query($query_ActivePlayer, $local) or die(mysql_error());
$row_ActivePlayer = mysql_fetch_assoc($ActivePlayer);
$totalRows_ActivePlayer = mysql_num_rows($ActivePlayer);$tourney_ActivePlayer = "-1";
if (isset($_GET['tourney'])) {
  $tourney_ActivePlayer = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_ActivePlayer = sprintf("SELECT * FROM tournament_players WHERE tournament_players.user_confirmed = 'yes' AND tournament_players.tournament_id = %s", GetSQLValueString($tourney_ActivePlayer, "int"));
$ActivePlayer = mysql_query($query_ActivePlayer, $local) or die(mysql_error());
$row_ActivePlayer = mysql_fetch_assoc($ActivePlayer);
$totalRows_ActivePlayer = mysql_num_rows($ActivePlayer);
$query_ActivePlayer = "SELECT * FROM players WHERE active = 'yes'";
$ActivePlayer = mysql_query($query_ActivePlayer, $local_local) or die(mysql_error());
$row_ActivePlayer = mysql_fetch_assoc($ActivePlayer);
$totalRows_ActivePlayer = mysql_num_rows($ActivePlayer);

$colname_tournamentGameJoin = "-1";
if (isset($_GET['tourney'])) {
  $colname_tournamentGameJoin = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_tournamentGameJoin = sprintf("SELECT * FROM tournament, game_system WHERE tournament.game_id =game_system.game_system_id  AND tournament.tournament_id = %s", GetSQLValueString($colname_tournamentGameJoin, "int"));
$tournamentGameJoin = mysql_query($query_tournamentGameJoin, $local) or die(mysql_error());
$row_tournamentGameJoin = mysql_fetch_assoc($tournamentGameJoin);
$totalRows_tournamentGameJoin = mysql_num_rows($tournamentGameJoin);

$colname_Rounds = "5";
if (isset($_GET['tourney'])) {
  $colname_Rounds = $_GET['tourney'];
}
$rd_Rounds = "35";
if (isset($_GET['rd'])) {
  $rd_Rounds = $_GET['rd'];
}
mysql_select_db($database_local, $local);
$query_Rounds = sprintf("SELECT * FROM tournament_rounds WHERE tournament_id = %s AND tournament_rounds.rounds_id = %s", GetSQLValueString($colname_Rounds, "int"),GetSQLValueString($rd_Rounds, "int"));
$Rounds = mysql_query($query_Rounds, $local) or die(mysql_error());
$row_Rounds = mysql_fetch_assoc($Rounds);
$totalRows_Rounds = mysql_num_rows($Rounds);

$colname_tourneyPlayers = "-1";
if (isset($_GET['tourney'])) {
  $colname_tourneyPlayers = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_tourneyPlayers = sprintf("SELECT * FROM tournament_game_player WHERE tournament_id = %s", GetSQLValueString($colname_tourneyPlayers, "int"));
$tourneyPlayers = mysql_query($query_tourneyPlayers, $local) or die(mysql_error());
$row_tourneyPlayers = mysql_fetch_assoc($tourneyPlayers);
$totalRows_tourneyPlayers = mysql_num_rows($tourneyPlayers);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["PlayerAssign"]) || isset($_POST["PlayerAssign_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("playerID", "playerHandle", "roundsID", "Round", "tournamentID", "GameID", "GameTitle", "Session", "Table");
  $WA_connection = $local_local;
  $WA_table = "tournament_game_player";
  $WA_redirectURL = "playerAssignment_A_rev.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "player_id|player_handle|tourney_round_id|tourney_round_title|tournament_id|game_id|game_title|Game_session|table_id";
  $WA_columnTypesStr = "none,none,NULL|',none,''|none,none,NULL|',none,''|none,none,NULL|none,none,NULL|',none,''|',none,''|',none,''";
  $WA_insertIfNotBlank = "playerHandle";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("playerID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("playerHandle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("roundsID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("Round", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("tournamentID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("GameID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("GameTitle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("Session", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("Table", $WA_multipleInsertCounter)  ."";
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
	$RepeatSelectionCounter_1_Iterations = "".$row_tournamentGameJoin['No_of_Games']  ."";
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Assign Players to Tournament</title>
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
  		 <div class="col-lg-12"><?php include("nav.php"); ?></div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Player Assignment</h2>
      <p>Assign Players to Tournament &quot;<?php echo $row_tournamentGameJoin['tournament_name']; ?> (ID=<?php echo $row_tournamentGameJoin['tournament_id']; ?>&quot; - Round &quot;<?php echo $row_Rounds['Round_Title']; ?>&quot;</p>
<p># of Players Per Session (Game): <?php echo $row_tournamentGameJoin['noOfPlayers']; ?> # of Games: <?php echo $row_tournamentGameJoin['No_of_Games']; ?> </p>
<p>&nbsp;</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
     <form>
      


<table width="800" border="1">
  <tr>
    <th scope="col">Handle</th>
    <th scope="col">Round</th>
    <th scope="col">Game System</th>
    <th scope="col">Game</th>
    <th scope="col">Table</th>
    </tr><?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_ActivePlayer){
?>
  <tr>
    <td><input type="hidden" name="playerID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="playerID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
      <input name="playerHandle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="playerHandle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_ActivePlayer['playerHandle']; ?>">
      <input name="playerID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="playerID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_ActivePlayer['playerId']; ?>"></td>
    <td><input name="Round_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="Round_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_Rounds['Round_Title']; ?>">
      <input name="roundsID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="roundsID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_Rounds['rounds_id']; ?>"></td>
    <td><input name="GameTitle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="GameTitle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentGameJoin['game_system_Title']; ?>">
      <input name="GameID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="GameID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentGameJoin['game_system_id']; ?>"></td>
    <td><input name="Session_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="Game_<?php echo $RepeatSelectionCounter_1; ?>" value="Game  ">
      <input name="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentGameJoin['tournament_id']; ?>"></td>
    <td><input name="Table_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="Table_<?php echo $RepeatSelectionCounter_1; ?>" value="Table "></td>
  </tr><?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_ActivePlayer && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_ActivePlayer = mysql_fetch_assoc($ActivePlayer);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
<tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td><input name="noOfGames" type="hidden" id="noOfGames" value="<?php echo $row_tournamentGameJoin['No_of_Games']; ?>">      <input name="PlayerAssign" type="submit" id="PlayerAssign" formmethod="POST" value="Submit"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
</table>




     </form>

<p><h2>Assigned Players</h2></p>
<table width="800" border="1">
  <tr>
    <th scope="col">Handle</th>
    <th scope="col">Round</th>
    <th scope="col">Game System</th>
    <th scope="col">Game</th>
    <th scope="col">Table</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <?php
	// RepeatSelectionCounter_2 Begin Loop
	$RepeatSelectionCounter_2_IterationsRemaining = $RepeatSelectionCounter_2_Iterations;
	while($RepeatSelectionCounter_2_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_2 || $row_tourneyPlayers){
?>
  <tr>
    <td><?php echo $row_tourneyPlayers['player_handle']; ?></td>
    <td><?php echo $row_tourneyPlayers['tourney_round_title']; ?></td>
    <td><?php echo $row_tourneyPlayers['game_title']; ?></td>
    <td><?php echo $row_tourneyPlayers['Game_session']; ?></td>
    <td><?php echo $row_tourneyPlayers['table_id']; ?></td>
    <td><a href="GameplayOverview_PlayerB.php?tourney=<?php echo $row_tournamentGameJoin['tournament_id']; ?>&rd=<?php echo $row_Rounds['rounds_id']; ?>&pl=<?php echo $_SESSION['SecurityAssist_id']; ?>&gs=<?php echo $row_tourneyPlayers['Game_session']; ?>">Game Overview/Outcome</a></td>
  </tr>
  <?php
	} // RepeatSelectionCounter_2 Begin Alternate Content
	else{
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php } // RepeatSelectionCounter_2 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_2 && $RepeatSelectionCounter_2_IterationsRemaining != 0){
			if(!$row_tourneyPlayers && $RepeatSelectionCounter_2_Iterations == -1){$RepeatSelectionCounter_2_IterationsRemaining = 0;}
			$row_tourneyPlayers = mysql_fetch_assoc($tourneyPlayers);
		}
		$RepeatSelectionCounter_2++;
	} // RepeatSelectionCounter_2 End Loop
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>Footer Left</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
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
mysql_free_result($ActivePlayer);

mysql_free_result($tournamentGameJoin);

mysql_free_result($Rounds);

mysql_free_result($tourneyPlayers);
?>