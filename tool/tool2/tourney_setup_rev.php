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
$totalRows_rounds = mysql_num_rows($rounds);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["submit"]) || isset($_POST["submit_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("TournamentID", "RoundTitle", "StartTime", "EndTime", "NoParticipants");
  $WA_connection = $local_local;
  $WA_table = "tournament_rounds";
  $WA_redirectURL = "tourney_setup_rev.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "tournament_id|Round_Title|startTime|endTime|num_participants";
  $WA_columnTypesStr = "none,none,NULL|',none,''|',none,''|none,none,NULL|none,none,NULL";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("TournamentID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("RoundTitle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("StartTime", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("EndTime", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("NoParticipants", $WA_multipleInsertCounter)  ."";
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
	$RepeatSelectionCounter_1_Iterations = "".$row_tournament['tournament_rounds']  ."";
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
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../Styles/dmxTimepicker.css" />
<link rel="stylesheet" type="text/css" href="../Styles/jqueryui/black-tie/black-tie.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.ui.slider.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxTimepicker.js"></script>
</head>

<body>
<h3>Setup and Configuration for for <?php echo $row_tournament['tournament_name']; ?></h3>
<p>&nbsp;</p>
<p>Number of Rounds: <?php echo $row_tournament['tournament_rounds']; ?></p>
<p>&nbsp;</p>
<p><strong>Configure Rounds</strong></p><form action="" method="post" name="SubmitRounds" id="SubmitRounds">
<table width="700" border="1">
  <tr>
    <th scope="col">Round Title/Name</th>
    <th scope="col"># of Participants</th>
    <th scope="col">Start Time</th>
    <th scope="col">EndTime</th>
  </tr>
  <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_None){
?>
  <tr>
    <td><input type="hidden" name="TournamentID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="TournamentID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
      <input name="RoundTitle_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="RoundTitle_<?php echo $RepeatSelectionCounter_1; ?>">
      <input name="TournamentID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="TournamentID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournament['tournament_id']; ?>"></td>
    <td><input name="NoParticipants_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="NoParticipants_<?php echo $RepeatSelectionCounter_1; ?>"></td>
    <td><input class="dmxTimepicker" name="dmxTimepicker1" id="dmxTimepicker1" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxTimepicker1").dmxTimepicker(
         {"ampm": true, "timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "showTime": false}
       );
     }
 );
  // ]]>
</script></td>
    <td><input class="dmxTimepicker" name="dmxTimepicker2" id="dmxTimepicker2" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxTimepicker2").dmxTimepicker(
         {"ampm": true, "timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "showTime": false}
       );
     }
 );
  // ]]>
</script></td>
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
    <td><input type="submit" name="submit" id="submit" value="Submit"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
<p>Currently Configured Rounds</p>
<table width="700" border="1">
  <tr>
    <th scope="col">Round Title/Name</th>
    <th scope="col"># of Participants</th>
    <th scope="col">Start Time</th>
    <th scope="col">End Time</th>
  </tr>
  <?php
	// RepeatSelectionCounter_2 Begin Loop
	$RepeatSelectionCounter_2_IterationsRemaining = $RepeatSelectionCounter_2_Iterations;
	while($RepeatSelectionCounter_2_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_2 || $row_rounds){
?>
  <tr>
    <td><?php echo $row_rounds['Round_Title']; ?></td>
    <td><?php echo $row_rounds['num_participants']; ?></td>
    <td><?php echo $row_rounds['startTime']; ?></td>
    <td><?php echo $row_rounds['endTime']; ?></td>
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
  </tr>
  <?php } // RepeatSelectionCounter_2 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_2 && $RepeatSelectionCounter_2_IterationsRemaining != 0){
			if(!$row_rounds && $RepeatSelectionCounter_2_Iterations == -1){$RepeatSelectionCounter_2_IterationsRemaining = 0;}
			$row_rounds = mysql_fetch_assoc($rounds);
		}
		$RepeatSelectionCounter_2++;
	} // RepeatSelectionCounter_2 End Loop
?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&gt;&gt;Add/Configure Tiebreakers/Missions&gt;&gt;</p>
</body>
</html>
<?php
mysql_free_result($tournament);

mysql_free_result($rounds);
?>
