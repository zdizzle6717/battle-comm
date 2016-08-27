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

$tourney_PendingPlayerRegistrations = "-1";
if (isset($_GET['tourney'])) {
  $tourney_PendingPlayerRegistrations = $_GET['tourney'];
}
$approved_PendingPlayerRegistrations = "no";
if (isset(no)) {
  $approved_PendingPlayerRegistrations = no;
}
mysql_select_db($database_local_local, $local_local);
$query_PendingPlayerRegistrations = sprintf("SELECT * FROM tournament_players WHERE tournament_players.tournament_id = %s AND tournament_players.user_confirmed = %s", GetSQLValueString($tourney_PendingPlayerRegistrations, "int"),GetSQLValueString($approved_PendingPlayerRegistrations, "text"));
$PendingPlayerRegistrations = mysql_query($query_PendingPlayerRegistrations, $local_local) or die(mysql_error());
$row_PendingPlayerRegistrations = mysql_fetch_assoc($PendingPlayerRegistrations);
$totalRows_PendingPlayerRegistrations = mysql_num_rows($PendingPlayerRegistrations);?>
<?php require_once("webassist/email/mail_php.php"); ?>
<?php require_once("webassist/email/mailformatting_php.php"); ?>
<?php
// WA DataAssist Multiple Updates
if (isset($_POST["submit"]) || isset($_POST["submit_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedIDField = array("WADA_RepeatID_tournament_players_id");
  $WA_connection = $local_local;
  $WA_table = "tournament_players";
  $WA_redirectURL = "updateRegistrations.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_indexField = "tournament_players_id";
  $WA_fieldNamesStr = "tournament_id|user_login_id|firstName|lastName|email_Address|user_confirmed";
  $WA_columnTypesStr = "none,none,NULL|',none,''|',none,''|',none,''|',none,''|',none,''";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local_local;
  $WA_multipleUpdateCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkLoopedFieldsNotBlank($WA_loopedIDField, $WA_multipleUpdateCounter)) {
    $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("playerTourneyID", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("playerID", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("firstName", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("lastName", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("emailAddress", $WA_multipleUpdateCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("Approve", $WA_multipleUpdateCounter)  ."";
    $WA_fieldValues = explode($WA_AB_Split, $WA_fieldValuesStr);
    $WA_where_fieldValuesStr = WA_AB_getLoopedFieldValue($WA_loopedIDField[0], $WA_multipleUpdateCounter);
    $WA_where_columnTypesStr = "none,none,NULL";
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
} ?>
<?php
if ((isset($_POST[\"submit_".$RepeatSelectionCounter_1  ."\"]) || isset($_POST[\"submit_".$RepeatSelectionCounter_1  ."_x\"])))     {
  //WA Universal Email object="mail"
  @session_write_close();
  @set_time_limit(0);
  $EmailRef = "waue_updateRegistrations_1";
  $BurstSize = 200;
  $BurstTime = 1;
  $WaitTime = 1;
  $GoToPage = "";
  $RecipArray = array();
  $StartBurst = time();
  $LoopCount = 0;
  $TotalEmails = 0;
  $RecipIndex = 0;
  // build up recipients array
  $CurIndex = sizeof($RecipArray);
  $RecipArray[$CurIndex] = array();
  $RecipArray[$CurIndex ][] = "".$row_PendingPlayerRegistrations['email_Address']  ."";
  $TotalEmails += sizeof($RecipArray[$CurIndex]);
  $RealWait = ($WaitTime<0.25)?0.25:($WaitTime+0.1);
  $TimeTracker = Array();
  $TotalBursts = floor($TotalEmails/$BurstSize);
  $AfterBursts = $TotalEmails % $BurstSize;
  $TimeRemaining = ($TotalBursts * $BurstTime) + ($AfterBursts*$RealWait);
  if ($TimeRemaining < ($TotalEmails*$RealWait) )  {
    $TimeRemaining = $TotalEmails*$RealWait;
  }
  writeUEProgress($EmailRef,0,$TotalEmails,$TimeRemaining);
  while ($RecipIndex < sizeof($RecipArray))  {
    $EnteredValue = is_string($RecipArray[$RecipIndex][0]);
    $CurIndex = 0;
    while (($EnteredValue && $CurIndex < sizeof($RecipArray[$RecipIndex])) || (!$EnteredValue && $RecipArray[$RecipIndex][0])) {
      $starttime = microtime_float();
      if ($EnteredValue)  {
        $RecipientEmail = $RecipArray[$RecipIndex][$CurIndex];
      }  else  {
        $RecipientEmail = $RecipArray[$RecipIndex][0][$RecipArray[$RecipIndex][2]];
      }
      $EmailsRemaining = ($TotalEmails- $LoopCount);
      $BurstsRemaining = ceil(($EmailsRemaining-$AfterBursts)/$BurstSize);
      $IntoBurst = ($EmailsRemaining-$AfterBursts) % $BurstSize;
      if ($AfterBursts<$EmailsRemaining) $IntoBurst = 0;
      $TimeRemaining = ($BurstsRemaining * $BurstTime * 60) + ((($AfterBursts<$EmailsRemaining)?$AfterBursts:$EmailsRemaining)*$RealWait) - (($AfterBursts>$EmailsRemaining)?0:($IntoBurst*$RealWait));
      if ($TimeRemaining < ($EmailsRemaining*$RealWait) )  {
        $TimeRemaining = $EmailsRemaining*$RealWait;
      }
      $CurIndex ++;
      $LoopCount ++;
      writeUEProgress($EmailRef,$LoopCount,$TotalEmails,round($TimeRemaining));
      wa_sleep($WaitTime);
      include("webassist/email/waue_updateRegistrations_1.php");
      $endtime = microtime_float();
      $TimeTracker[] =$endtime - $starttime;
      $RealWait = array_sum($TimeTracker)/sizeof($TimeTracker);
      if ($LoopCount % $BurstSize == 0 && $CurIndex < sizeof($RecipArray[$RecipIndex]))  {
        $TimePassed = (time() - $StartBurst);
        if ($TimePassed < ($BurstTime*60))  {
          $WaitBurst = ($BurstTime*60) -$TimePassed;
          wa_sleep($WaitBurst);
        }
        else  {
          $TimeRemaining = ($TotalEmails- $LoopCount)*$RealWait;
        }
        $StartBurst = time();
      }
      if (!$EnteredValue)  {
        $RecipArray[$RecipIndex][0] =  mysql_fetch_assoc($RecipArray[$RecipIndex][1]);
      }
    }
    $RecipIndex ++;
  }
  @session_start();
  $_SESSION[$EmailRef."_Status"] = $GLOBALS[$EmailRef."_Status"];
  $_SESSION[$EmailRef."_Index"] = $GLOBALS[$EmailRef."_Index"];
  $_SESSION[$EmailRef."_From"] = $GLOBALS[$EmailRef."_From"];
  $_SESSION[$EmailRef."_To"] = $GLOBALS[$EmailRef."_To"];
  $_SESSION[$EmailRef."_Subject"] = $GLOBALS[$EmailRef."_Subject"];
  $_SESSION[$EmailRef."_Body"] = $GLOBALS[$EmailRef."_Body"];
  $_SESSION[$EmailRef."_Header"] = $GLOBALS[$EmailRef."_Header"];
  $_SESSION[$EmailRef."_Log"] = $GLOBALS[$EmailRef."_Log"];
  if (function_exists("rel2abs")) $GoToPage = $GoToPage?rel2abs($GoToPage,dirname(__FILE__)):"";
  if ($GoToPage!="")     {
    header("Location: ".$GoToPage);
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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Assign Rounds</title>
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
function dmxDataBindingsAction(action, target) { // v1.72
 var inst, evt = jQuery.event.fix(window.event || arguments.callee.caller.arguments[0]),
  args = Array.prototype.slice.call(arguments, 2);

 switch (action) {
  case 'refresh': inst = 'ds'; action = 'load'; break;
  case 'setPage': inst = 'ds'; break;
  case 'selectCurrent': inst = 'rp'; action = 'select'; break;
 }

 inst = (inst == 'ds')
  ? jQuery.dmxDataSet.dataSets[target]
  : jQuery(evt.target).closest('[data-binding-id="' + target + '"]').data('repeater')
  || jQuery.dmxDataBindings.regions[target];

 if (inst) inst[action].apply(inst, args);

 evt.preventDefault();
}
</script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> 
  	  <?php include("nav.php"); ?>
  	</div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Pending Player Registrations</h2>
     <form name="form1" method="post" action="">
<table width="95%" border="1">
        <tbody>
          <tr>
            <th scope="col">Username/Handle</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email</th>
            <th scope="col">Approved</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
          </tr> <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_PendingPlayerRegistrations){
?>
          <tr>
            <td><?php echo $row_PendingPlayerRegistrations['userHandle']; ?>
      <input type="hidden" name="WADA_RepeatID_tournament_players_id_<?php echo $RepeatSelectionCounter_1; ?>" id="WADA_RepeatID_tournament_players_id_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_PendingPlayerRegistrations["tournament_players_id"]; ?>" />
      <input name="playerTourneyID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="playerTourneyID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_PendingPlayerRegistrations['tournament_players_id']; ?>">
<input name="playerID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="playerID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_PendingPlayerRegistrations['user_login_id']; ?>"> <input name="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_PendingPlayerRegistrations['tournament_id']; ?>"> <input name="firstName_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="firstName_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_PendingPlayerRegistrations['firstName']; ?>"> <input name="lastName_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="lastName_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_PendingPlayerRegistrations['lastName']; ?>">
            <input name="emailAddress_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="emailAddress_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_PendingPlayerRegistrations['email_Address']; ?>"></td>
            <td><?php echo $row_PendingPlayerRegistrations['firstName']; ?> <?php echo $row_PendingPlayerRegistrations['lastName']; ?></td>
            <td><?php echo $row_PendingPlayerRegistrations['email_Address']; ?></td>
            <td><?php echo $row_PendingPlayerRegistrations['user_confirmed']; ?></td>
            <td><input name="Approve_<?php echo $RepeatSelectionCounter_1; ?>" type="checkbox" id="Approve_<?php echo $RepeatSelectionCounter_1; ?>" value="yes"></td>
            <td>&nbsp;</td>
          </tr><?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>
<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_PendingPlayerRegistrations && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_PendingPlayerRegistrations = mysql_fetch_assoc($PendingPlayerRegistrations);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
          <tr>
            <td><input type="submit" name="submit_<?php echo $RepeatSelectionCounter_1; ?>" id="submit_<?php echo $RepeatSelectionCounter_1; ?>" value="Submit"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>

</form>

      <p>&nbsp;</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Heading</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      <p>
      </p>
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
mysql_free_result($PendingPlayerRegistrations);
?>
