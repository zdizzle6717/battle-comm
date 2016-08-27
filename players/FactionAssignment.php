<?php require_once('../Connections/local.php'); ?>
<?php require_once('../Connections/local.php'); ?>
<?php require_once('../Connections/local.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once("../webassist/database_management/wa_appbuilder_php.php"); ?>
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

$colname_Factions = "-1";
if (isset($_GET['gsi'])) {
  $colname_Factions = $_GET['gsi'];
}
mysql_select_db($database_local, $local);
$query_Factions = sprintf("SELECT * FROM factions WHERE game_system_id = %s ORDER BY faction_name ASC", GetSQLValueString($colname_Factions, "int"));
$Factions = mysql_query($query_Factions, $local) or die(mysql_error());
$row_Factions = mysql_fetch_assoc($Factions);
$totalRows_Factions = mysql_num_rows($Factions);

$colname_tournaments = "-1";
if (isset($_GET['td'])) {
  $colname_tournaments = $_GET['td'];
}
mysql_select_db($database_local, $local);
$query_tournaments = sprintf("SELECT * FROM tournament WHERE tournament_id = %s", GetSQLValueString($colname_tournaments, "int"));
$tournaments = mysql_query($query_tournaments, $local) or die(mysql_error());
$row_tournaments = mysql_fetch_assoc($tournaments);
$totalRows_tournaments = mysql_num_rows($tournaments);

$colname_round = "-1";
if (isset($_GET['rd'])) {
  $colname_round = $_GET['rd'];
}
mysql_select_db($database_local, $local);
$query_round = sprintf("SELECT * FROM tournament_rounds WHERE rounds_id = %s", GetSQLValueString($colname_round, "int"));
$round = mysql_query($query_round, $local) or die(mysql_error());
$row_round = mysql_fetch_assoc($round);
$totalRows_round = mysql_num_rows($round);

$colname_GameSystem = "-1";
if (isset($_GET['gsi'])) {
  $colname_GameSystem = $_GET['gsi'];
}
mysql_select_db($database_local, $local);
$query_GameSystem = sprintf("SELECT game_system_Title FROM game_system WHERE game_system_id = %s", GetSQLValueString($colname_GameSystem, "int"));
$GameSystem = mysql_query($query_GameSystem, $local) or die(mysql_error());
$row_GameSystem = mysql_fetch_assoc($GameSystem);
$totalRows_GameSystem = mysql_num_rows($GameSystem);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["submit"]) || isset($_POST["submit_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("FactionName", "FactionsID", "tournamentID", "RoundID");
  $WA_connection = $local;
  $WA_table = "AssignedFactions";
  $WA_redirectURL = "FactionAssignment.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "factions_Name|factions_id|player_id|tournament_id|round_id";
  $WA_columnTypesStr = "',none,''|none,none,NULL|none,none,NULL|none,none,NULL|none,none,NULL";
  $WA_insertIfNotBlank = "join";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("FactionName", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("FactionsID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".$_SESSION['SecurityAssist_id']  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("tournamentID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("RoundID", $WA_multipleInsertCounter)  ."";
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
	$RepeatSelectionCounter_1_Iterations = "-1";
?>
<?php
 require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>BattleComm: Faction Assignment</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "loggedInPlayer" */
       jQuery.dmxDataSet(
         {"id": "loggedInPlayer", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "loggedInPlayer" */
  </script>
<script type="text/javascript">
/* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */

  /* dmxDataSet name "tournament_forFactions" */
       jQuery.dmxDataSet(
         {"id": "tournament_forFactions", "url": "../dmxDatabaseSources/tournament_factions.php", "data": {"td": "{{$URL.td}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament_forFactions" */

  /* dmxDataSet name "GameSystem_info" */
       jQuery.dmxDataSet(
         {"id": "GameSystem_info", "url": "../dmxDatabaseSources/gamesList.php", "data": {"gsi": "{{$URL.gsi}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "GameSystem_info" */
  /* dmxDataSet name "FactionsbyGame" */
       jQuery.dmxDataSet(
         {"id": "FactionsbyGame", "url": "../dmxDatabaseSources/factions.php", "data": {"gsi": "{{$URL.gsi}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "FactionsbyGame" */

  /* dmxDataSet name "Rounds" */
       jQuery.dmxDataSet(
         {"id": "Rounds", "url": "../dmxDatabaseSources/rounds_forFactions.php", "data": {"rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds" */
  /* dmxDataSet name "AssignedFactions" */
       jQuery.dmxDataSet(
         {"id": "AssignedFactions", "url": "../dmxDatabaseSources/AssignedFactions.php", "data": {"td": "{{$URL.td}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "AssignedFactions" */
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
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
        	<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>Assign/Choose Factions for - {{Rounds.data[0].Round_Title}}{{tournament_forFactions.data[0].tournament_name}}</h2>
			<p>Game System: <?php echo $row_GameSystem['game_system_Title']; ?></p>
			<form method="post" id="factionINsert">
<table width="650" border="1">
			  <tbody>
			    <tr>
			      <th scope="col">Faction Name</th>
			      <th scope="col">Join</th>
		        </tr><?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_Factions){
?>
			    <tr>
			      <td><?php echo $row_Factions['faction_name']; ?> <input type="hidden" name="FactionName_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="FactionName_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
			        <input name="FactionName_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="FactionName_<?php echo $RepeatSelectionCounter_1; ?>" form="factionINsert" value="<?php echo $row_Factions['faction_name']; ?>">
<input name="playerID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="playerID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $_SESSION['SecurityAssist_id']; ?>"> <input name="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournaments['tournament_id']; ?>">
		          <input name="RoundID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="RoundID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_round['rounds_id']; ?>">
		          <input name="FactionsID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="FactionsID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_Factions['faction_id']; ?>"></td>
			      <td><input type="checkbox" name="join_<?php echo $RepeatSelectionCounter_1; ?>" id="join_<?php echo $RepeatSelectionCounter_1; ?>"></td>
		        </tr><?php
	} // RepeatSelectionCounter_1 Begin Alternate Content
	else{
?>

<?php } // RepeatSelectionCounter_1 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_1 && $RepeatSelectionCounter_1_IterationsRemaining != 0){
			if(!$row_Factions && $RepeatSelectionCounter_1_Iterations == -1){$RepeatSelectionCounter_1_IterationsRemaining = 0;}
			$row_Factions = mysql_fetch_assoc($Factions);
		}
		$RepeatSelectionCounter_1++;
	} // RepeatSelectionCounter_1 End Loop
?>
			    <tr>
			      <td>&nbsp;</td>
			      <td><input type="submit" name="submit" id="submit" value="Submit"></td>
		        </tr>
	        </tbody>
		    </table>
</form>
			<p><h3>Joined Factions</h3></p>
            <div data-binding-id="repeat1" data-binding-repeat="{{AssignedFactions.data}}">{{factions_Name}}</div>
            <p> </p>
                      </div>
                </div>
                <div class="frame_b row">
                    <div class="frame_b_bar_full col"></div>
                    <div class="frame_bl_corner col"></div>
                    <div class="frame_br_corner col"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FOOTER -->
        <div class="footer">
            <div class="sub-footer center" id="contact">
                <div class="three_column_1 subfooter_filler">
                </div>
                <div class="three_column_1 subfooter no_margin">
                    <img src="/images/Titles/Contact_Us.png" alt=""/>
    <h4 class="left">By Phone: (909) 343-5454</h4>
                    <h4 class="left">By E-mail: Contact@Battle-Comm.com</h4>
                    <h4 class="left">Address: 555 Boutel Dr.</h4>
                    <h4 class="indent left">Someplace, CA</h4>
                </div>
                <div class="three_column_1 subfooter">
                    <img src="/images/Titles/Follow_Us.png" alt=""/>
                   <div class="sociallinks">
<a href="https://www.facebook.com/battlecomm"><span class="symbol face" style="font-size: 38px;">&#xe427;</span></a><a href="https://twitter.com/Battle_Comm"><span class="symbol twit" style="font-size: 38px;">&#xe286;</span></a><a href="https://instagram.com/Battle_Comm"><span class="symbol twit" style="font-size: 38px;">&#xe500;</span></a>
</div>
                </div>
            </div>
            <div class="site-footer center">
<div class="copyright">© 2015 Battle-Comm.com. All Rights Reserved.
        <!--<a class="privacy_policy">Privacy Policy.</a>-->
        <br/>
        <div class="privacy-policy" ><a href="#">Privacy Policy</a> ~ </div> 
        <div class="copyright-statement" ><a href="#copyright-statement" class="open-popup-link" >Copyright Statement</a></div>
        <div id="copyright-statement" class="copyright-statement-popup mfp-hide">
			<div class="col-lg-6">
  <h2>Battle-Comm Official Copyright Statement</h2>
  <h4>All copyrights belong to their respective owners. Images and text owned by other copyright holders are used here under the guidelines of the Fair Use provisions of United States Copyright Law.</h4>
</div>
        </div>
        <script>
			$('.open-popup-link').magnificPopup({
			  type:'inline',
			  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
			});
		</script>
</div>
</div>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
    <script type="text/javascript">
  /* dmxDatabaseAction name "AssignTheFactions" */
       jQuery.dmxDatabaseAction(
         {"id": "AssignTheFactions", "url": "../dmxDatabaseActions/AssignFaction.php", "data": {"factions_Name": "{{$FORM.factions_Moniker}}", "factions_id": "{{$FORM.faction_identifier}}", "players_id": "{{$FORM.playersId}}", "tournaments_id": "{{$FORM.touramentsID}}", "rounds_id": "{{$FORM.roundsID}}"}, "success": "dmxDataBindingsAction('refresh','AssignedFactions',{});"}
       );
  /* END dmxDatabaseAction name "AssignTheFactions" */
        </script>
    </body>
</html>
<?php
mysql_free_result($Factions);

mysql_free_result($tournaments);

mysql_free_result($round);

mysql_free_result($GameSystem);
?>
