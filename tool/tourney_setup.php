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

$colname_tournamentSetup = "-1";
if (isset($_GET['tourney'])) {
  $colname_tournamentSetup = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_tournamentSetup = sprintf("SELECT * FROM tournament WHERE tournament_id = %s", GetSQLValueString($colname_tournamentSetup, "int"));
$tournamentSetup = mysql_query($query_tournamentSetup, $local_local) or die(mysql_error());
$row_tournamentSetup = mysql_fetch_assoc($tournamentSetup);
$totalRows_tournamentSetup = mysql_num_rows($tournamentSetup);

$colname_Rounds = "4";
if (isset($_GET['tourney'])) {
  $colname_Rounds = $_GET['tourney'];
}
mysql_select_db($database_local_local, $local_local);
$query_Rounds = sprintf("SELECT * FROM tournament_rounds WHERE tournament_id = %s ORDER BY startTime ASC", GetSQLValueString($colname_Rounds, "int"));
$Rounds = mysql_query($query_Rounds, $local_local) or die(mysql_error());
$row_Rounds = mysql_fetch_assoc($Rounds);
$totalRows_Rounds = mysql_num_rows($Rounds);

mysql_select_db($database_local_local, $local_local);
$query_Games = "SELECT game_system.game_system_id, game_system.game_system_Title FROM game_system";
$Games = mysql_query($query_Games, $local_local) or die(mysql_error());
$row_Games = mysql_fetch_assoc($Games);
$totalRows_Games = mysql_num_rows($Games);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["RoundsSubmit"]) || isset($_POST["RoundsSubmit_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("RoundTitle", "dmxTimepicker1", "dmxTimepicker2", "Participants", "Game", "Game");
  $WA_connection = $local_local;
  $WA_table = "tournament_rounds";
  $WA_redirectURL = "tourney_setup.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "tournament_id|Round_Title|startTime|endTime|num_participants|games_id|games_title|notes_rules_changes";
  $WA_columnTypesStr = "none,none,NULL|',none,''|',none,''|none,none,NULL|none,none,NULL|none,none,NULL|',none,''|',none,''";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".$row_Rounds['tournament_id']  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("RoundTitle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("dmxTimepicker1", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("dmxTimepicker2", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("Participants", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("Game", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("Game", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".$row_Rounds['notes_rules_changes']  ."";
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
	$RepeatSelectionCounterBasedLooping_1 = true;
	$RepeatSelectionCounter_1_Iterations = "".$row_tournamentSetup['tournament_rounds']  ."";
?>
<?php
	// RepeatSelectionCounter_2 Initialization
	$RepeatSelectionCounter_2 = 0;
	$RepeatSelectionCounterBasedLooping_2 = false;
	$RepeatSelectionCounter_2_Iterations = "-1";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tournament Setup for<?php echo $row_tournamentSetup['tournament_name']; ?></title>
<link rel="stylesheet" type="text/css" href="Styles/dmxTimepicker.css" />
<link rel="stylesheet" type="text/css" href="Styles/jqueryui/black-tie/black-tie.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/jquery.ui.slider.js"></script>
<script type="text/javascript" src="ScriptLibrary/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxTimepicker.js"></script>
</head>

<body>
<h3>Setup and Configuration for <?php echo $row_tournamentSetup['tournament_name']; ?></h3>
<p>&nbsp;</p>
<p><a href="tournamentAdmin/tournament_update.php?tournament_id=<?php echo $row_tournamentSetup['tournament_id']; ?>" target="new">Edit Tournament Information</a></p>
<p>&nbsp;</p>
<p># of Rounds: <?php echo $row_tournamentSetup['tournament_rounds']; ?></p>
<p>Configure Rounds</p>
<form action="" method="post" name="SubmitRounds" id="SubmitRounds">
<table width="600" border="1">
  <tr>
    <th scope="col">Round Title</th>
    <th scope="col"># Tables</th>
    <th scope="col">Start Time</th>
    <th scope="col">End Time</th>
    <th scope="col">Game</th>
    <th scope="col">Notes/Rules/Info</th>
  </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_None){
?>
  <tr>
    <td><input type="hidden" name="hiddenField_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="hiddenField_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
      <input name="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentSetup['tournament_id']; ?>">
      <input name="RoundTitle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="RoundTitle_<?php echo $RepeatSelectionCounter_1; ?>"></td>
    <td><input name="Participants_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="Participants_<?php echo $RepeatSelectionCounter_1; ?>"></td>
    <td><input class="dmxTimepicker" name="dmxTimepicker1_<?php echo $RepeatSelectionCounter_1; ?>" id="dmxTimepicker1" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxTimepicker1").dmxTimepicker(
         {"ampm": true, "timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}}
       );
     }
 );
  // ]]>
</script></td>
    <td><input class="dmxTimepicker" name="dmxTimepicker2_<?php echo $RepeatSelectionCounter_1; ?>" id="dmxTimepicker2" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxTimepicker2").dmxTimepicker(
         {"ampm": true, "timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}}
       );
     }
 );
  // ]]>
</script></td>
    <td><select name="Game_<?php echo $RepeatSelectionCounter_1; ?>" id="Game_<?php echo $RepeatSelectionCounter_1; ?>">
      <option value="">Choose Game...</option>
      <?php
do {  
?>
      <option value="<?php echo $row_Games['game_system_id']?>"><?php echo $row_Games['game_system_Title']?></option>
      <?php
} while ($row_Games = mysql_fetch_assoc($Games));
  $rows = mysql_num_rows($Games);
  if($rows > 0) {
      mysql_data_seek($Games, 0);
	  $row_Games = mysql_fetch_assoc($Games);
  }
?>
    </select></td>
    <td><textarea name="round_notes_<?php echo $RepeatSelectionCounter_1; ?>" id="round_notes_<?php echo $RepeatSelectionCounter_1; ?>"></textarea></td>
  </tr>
  <?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
  <?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_None && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_None = mysql_fetch_assoc($None);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
<tr>
    <td><input name="RoundsSubmit" type="submit" id="RoundsSubmit" value="Add Rounds"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
</tr>
</table></form>
<p>Current Rounds</p>
<table width="600" border="1">
  <tr>
    <th scope="col">Round Title</th>
    <th scope="col"># Participants</th>
    <th scope="col">Start Time</th>
    <th scope="col">End Time</th>
    <th scope="col">Game</th>
    <th scope="col">Notes/Rules</th>
  </tr>
  <?php
	// RepeatSelectionCounter_2 Begin Loop
	$RepeatSelectionCounter_2_IterationsRemaining = $RepeatSelectionCounter_2_Iterations;
	while($RepeatSelectionCounter_2_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_2 || $row_Rounds){
?>
  <tr>
    <td><?php echo $row_Rounds['Round_Title']; ?></td>
    <td><?php echo $row_Rounds['num_participants']; ?></td>
    <td><?php echo $row_Rounds['startTime']; ?></td>
    <td><?php echo $row_Rounds['endTime']; ?></td>
    <td><?php echo $row_Rounds['games_title']; ?></td>
    <td>&nbsp; </td>
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
			if(!$row_Rounds && $RepeatSelectionCounter_2_Iterations == -1){$RepeatSelectionCounter_2_IterationsRemaining = 0;}
			$row_Rounds = mysql_fetch_assoc($Rounds);
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
</table>
<p><a href="playerassignment4.php?tourney=<?php echo $row_tournamentSetup['tournament_id']; ?>">&gt;&gt;Assign Tiebreakers&gt;&gt;</a></p>
</body>
</html>
<?php
mysql_free_result($tournamentSetup);

mysql_free_result($Rounds);

mysql_free_result($Games);
?>
