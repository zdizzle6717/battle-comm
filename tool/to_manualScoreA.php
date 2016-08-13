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

$tourney_tourneyGame = "-1";
if (isset($_GET['tourney'])) {
  $tourney_tourneyGame = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_tourneyGame = sprintf("SELECT tournament.*, game_system.* FROM tournament INNER JOIN game_system ON tournament.game_id = game_system.game_system_id WHERE tournament.tournament_id = %s LIMIT 1", GetSQLValueString($tourney_tourneyGame, "int"));
$tourneyGame = mysql_query($query_tourneyGame, $local) or die(mysql_error());
$row_tourneyGame = mysql_fetch_assoc($tourneyGame);
$totalRows_tourneyGame = mysql_num_rows($tourneyGame);

$tourney_Rounds = "-1";
if (isset($_GET['tourney'])) {
  $tourney_Rounds = $_GET['tourney'];
}
$rd_Rounds = "-1";
if (isset($_GET['rd'])) {
  $rd_Rounds = $_GET['rd'];
}
mysql_select_db($database_local, $local);
$query_Rounds = sprintf("SELECT tournament_rounds.* FROM tournament_rounds WHERE tournament_rounds.tournament_id = %s AND tournament_rounds.rounds_id = %s LIMIT 1", GetSQLValueString($tourney_Rounds, "int"),GetSQLValueString($rd_Rounds, "int"));
$Rounds = mysql_query($query_Rounds, $local) or die(mysql_error());
$row_Rounds = mysql_fetch_assoc($Rounds);
$totalRows_Rounds = mysql_num_rows($Rounds);

$tourney_tournamentPlayers = "-1";
if (isset($_GET['tourney'])) {
  $tourney_tournamentPlayers = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_tournamentPlayers = sprintf("SELECT tournament_game_player.* FROM tournament_game_player HAVING tournament_game_player.tournament_id =%s", GetSQLValueString($tourney_tournamentPlayers, "int"));
$tournamentPlayers = mysql_query($query_tournamentPlayers, $local) or die(mysql_error());
$row_tournamentPlayers = mysql_fetch_assoc($tournamentPlayers);
$totalRows_tournamentPlayers = mysql_num_rows($tournamentPlayers);?>
<?php
// WA DataAssist Multiple Updates
if (isset($_POST["Submit Scores"]) || isset($_POST["Submit Scores_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_tourney_game_player_id");
  $WA_connection = $local;
  $WA_table = "tournament_game_player";
  $WA_redirectURL = "to_manualScoreA.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_indexField = "tourney_game_player_id";
  $WA_fieldNamesStr = "game_result|game_points|mission_points|total_points|Notes_comments";
  $WA_columnTypesStr = "',none,''|none,none,NULL|none,none,NULL|none,none,NULL|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  $WA_multipleUpdateCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleUpdateCounter)) {
    $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("outcomes", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("GamePoints", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("MissionPoints", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("TotalPoints", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("textarea", $WA_multipleUpdateCounter)  ."";
    $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
    $WA_where_fieldValuesStr = WA_AB_getLoopedFieldValue($WA_loopedIDField[0], $WA_multipleUpdateCounter);
    $WA_where_columnTypesStr = "',none,''";
    $WA_where_comparisonStr = "=";
    $WA_where_fieldNames = explode("|", $WA_indexField);
    $WA_where_fieldValues = explode($WA_AB_Split, $WA_where_fieldValuesStr);
    $WA_where_columns = explode("|", $WA_where_columnTypesStr);
    $WA_where_comparisons = explode("|", $WA_where_comparisonStr);
    $updateParamsObj = WA_AB_generateInsertParams($WA_fieldNames, $WA_columns, $WA_fieldValues, -1);
    $WhereObj = WA_AB_generateWhereClause($WA_where_fieldNames, $WA_where_columns, $WA_where_fieldValues,  $WA_where_comparisons );
    $WA_Sql = "UPDATE `" . $WA_table . "` SET " . $updateParamsObj->WA_setValues . " WHERE " . $WhereObj->sqlWhereClause . "";
    $MM_editCmd = mysql_query($WA_Sql, $WA_connection) or die(mysql_error());
    $WA_multipleUpdateCounter++;
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
<title>TO Manual Round Scoring</title>
<link href="../players/css/customPlayer.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="row" id="nav"><h2>BattleComm.com Tourney Tool</h2><br>

<?php include("nav.php"); ?></div>
<h3><strong>Manual Tournament Organizer Scoring</strong></h3>
<p>This is to allow a Tournament Organizer to manually score any/all of the Matches per round.<br>
</p>
<p>&nbsp;</p>
<form method="post" id="ManualScoring" title="ManualScore"><table width="95%" border="1">
       <tbody>
         <tr>
           <th scope="col">Handle</th>
           <th scope="col">Round</th>
           <th scope="col">Match</th>
           <th scope="col">Table </th>
           <th scope="col">Outcome</th>
           <th scope="col">Game Points</th>
           <th scope="col">Mission Points</th>
           <th scope="col">Notes</th>
           <th scope="col">Total Score</th>
           <th scope="col">Modify</th>
           </tr>
         <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_tournamentPlayers){
?>
         <tr>
           <td><?php echo $row_tournamentPlayers['player_handle']; ?></td>
           <td><?php echo $row_tournamentPlayers['tourney_round_id']; ?></td>
           <td><?php echo $row_tournamentPlayers['Game_session']; ?></td>
           <td><?php echo $row_tournamentPlayers['table_id']; ?></td>
           <td><?php echo $row_tournamentPlayers['game_result']; ?>
             <select name="outcomes_<?php echo $RepeatSelectionCounter_1; ?>" id="outcomes_<?php echo $RepeatSelectionCounter_1; ?>">
               <option value="win" <?php if (!(strcmp("win", $row_tournamentPlayers['game_result']))) {echo "selected=\"selected\"";} ?>>Win</option>
               <option value="draw" <?php if (!(strcmp("draw", $row_tournamentPlayers['game_result']))) {echo "selected=\"selected\"";} ?>>Draw</option>
               <option value="loss" <?php if (!(strcmp("loss", $row_tournamentPlayers['game_result']))) {echo "selected=\"selected\"";} ?>>Loss</option>
               <option selected="selected" value="" <?php if (!(strcmp("", $row_tournamentPlayers['game_result']))) {echo "selected=\"selected\"";} ?>>Set Outcome...</option>
             </select></td>
           <td><input type="hidden" name="WADA_RepeatID_tourney_game_player_id_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_tourney_game_player_id_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentPlayers["tourney_game_player_id"]; ?>" />
             <input name="GamePoints_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="GamePoints_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentPlayers['game_points']; ?>" size="4" maxlength="8"></td>
           <td><input name="MissionPoints_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="MissionPoints_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentPlayers['mission_points']; ?>" size="4" maxlength="8"></td>
           <td><textarea name="textarea_<?php echo $RepeatSelectionCounter_1; ?>" rows="4" id="textarea_<?php echo $RepeatSelectionCounter_1; ?>"></textarea></td>
           <td><input name="TotalPoints_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="TotalPoints_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentPlayers['total_points']; ?>" size="4" maxlength="8"></td>
           <td><input type="checkbox" name="modify_<?php echo $RepeatSelectionCounter_1; ?>" id="modify_<?php echo $RepeatSelectionCounter_1; ?>"></td>
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
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_tournamentPlayers && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_tournamentPlayers = mysql_fetch_assoc($tournamentPlayers);
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
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input name="Submit Scores" type="submit" id="Submit Scores" form="ManualScoring" formaction="#" formenctype="text/plain" formmethod="POST" value="Submit Scores"></td>
    <td>&nbsp;</td>
    </tr>
         </tbody>
     </table></form>
<?php include("../includes/lowernav.php"); ?>
</body>
</html>
<?php
mysql_free_result($tourneyGame);

mysql_free_result($Rounds);

mysql_free_result($tournamentPlayers);
?>
