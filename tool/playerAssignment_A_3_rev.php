<?php require_once('../Connections/local.php'); ?>
<?php require_once('../Connections/local.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
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

$colname_tournamentGameJoin = "-1";
if (isset($_GET['tourney'])) {
  $colname_tournamentGameJoin = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_tournamentGameJoin = sprintf("SELECT * FROM tournament, game_system WHERE tournament.game_id =game_system.game_system_id  AND tournament.tournament_id = %s", GetSQLValueString($colname_tournamentGameJoin, "int"));
$tournamentGameJoin = mysql_query($query_tournamentGameJoin, $local) or die(mysql_error());
$row_tournamentGameJoin = mysql_fetch_assoc($tournamentGameJoin);
$totalRows_tournamentGameJoin = mysql_num_rows($tournamentGameJoin);

$colname_rounds = "-1";
if (isset($_GET['tourney'])) {
  $colname_rounds = $_GET['tourney'];
}
$rd_rounds = "-1";
if (isset($_GET['rd'])) {
  $rd_rounds = $_GET['rd'];
}
mysql_select_db($database_local, $local);
$query_rounds = sprintf("SELECT * FROM tournament_rounds WHERE tournament_id = %s AND tournament_rounds.rounds_id = %s", GetSQLValueString($colname_rounds, "int"),GetSQLValueString($rd_rounds, "int"));
$rounds = mysql_query($query_rounds, $local) or die(mysql_error());
$row_rounds = mysql_fetch_assoc($rounds);
$totalRows_rounds = mysql_num_rows($rounds);

$colname_tournamentPlayers = "34";
if (isset($_GET['tourney'])) {
  $colname_tournamentPlayers = $_GET['tourney'];
}
mysql_select_db($database_local, $local);
$query_tournamentPlayers = sprintf("SELECT * FROM tournament_players INNER JOIN club ON tournament_players.clubID=club.club_key WHERE tournament_id = %s ORDER BY totalScore DESC", GetSQLValueString($colname_tournamentPlayers, "int"));
$tournamentPlayers = mysql_query($query_tournamentPlayers, $local) or die(mysql_error());
$row_tournamentPlayers = mysql_fetch_assoc($tournamentPlayers);
$totalRows_tournamentPlayers = mysql_num_rows($tournamentPlayers);

$colname_RoundAssignedPlayers = "-1";
if (isset($_GET['rd'])) {
  $colname_RoundAssignedPlayers = $_GET['rd'];
}
mysql_select_db($database_local, $local);
$query_RoundAssignedPlayers = sprintf("SELECT * FROM tournament_game_player WHERE tourney_round_id = %s ORDER BY total_points DESC", GetSQLValueString($colname_RoundAssignedPlayers, "int"));
$RoundAssignedPlayers = mysql_query($query_RoundAssignedPlayers, $local) or die(mysql_error());
$row_RoundAssignedPlayers = mysql_fetch_assoc($RoundAssignedPlayers);
$totalRows_RoundAssignedPlayers = mysql_num_rows($RoundAssignedPlayers);?>
<?php
// WA DataAssist Multiple Inserts
if (isset($_POST["submit"]) || isset($_POST["submit_x"])) // Trigger
{
  if (!session_id()) session_start();
  $WA_loopedFields = array("tourney_PlayerID", "playerID", "playerHandle", "roundID", "roundTitle", "tournamentID", "gameID", "gameTitle", "matchID", "tableID");
  $WA_connection = $local;
  $WA_table = "tournament_game_player";
  $WA_redirectURL = "playerAssignment_A_3_rev.php";
  if (function_exists("rel2abs")) $WA_redirectURL = $WA_redirectURL?rel2abs($WA_redirectURL,dirname(__FILE__)):"";
  $WA_keepQueryString = true;
  $WA_fieldNamesStr = "tourney_players_id|player_id|player_handle|tourney_round_id|tourney_round_title|tournament_id|game_id|game_title|Game_session|table_id|game_points|mission_points|total_points";
  $WA_columnTypesStr = "none,none,NULL|none,none,NULL|',none,''|none,none,NULL|',none,''|none,none,NULL|none,none,NULL|',none,''|',none,''|',none,''|none,none,NULL|none,none,NULL|none,none,NULL";
  $WA_insertIfNotBlank = "";
  $WA_fieldNames = explode("|", $WA_fieldNamesStr);
  $WA_columns = explode("|", $WA_columnTypesStr);
  $WA_connectionDB = $database_local;
  $WA_multipleInsertCounter = 0;
  mysql_select_db($WA_connectionDB, $WA_connection);
  while (WA_AB_checkMultiInsertLoopedFieldsExist($WA_loopedFields, $WA_multipleInsertCounter)) {
    if ($WA_insertIfNotBlank == "" || WA_AB_checkLoopedFieldsNotBlank(array($WA_insertIfNotBlank), $WA_multipleInsertCounter)) {
      $WA_fieldValuesStr = "".WA_AB_getLoopedFieldValue("tourney_PlayerID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("playerID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("playerHandle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("roundID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("roundTitle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("tournamentID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("gameID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("gameTitle", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("matchID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "".WA_AB_getLoopedFieldValue("tableID", $WA_multipleInsertCounter)  ."" . $WA_AB_Split . "0" . $WA_AB_Split . "0" . $WA_AB_Split . "0";
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
	// RepeatSelectionCounter_2 Initialization
	$RepeatSelectionCounter_2 = 0;
	$RepeatSelectionCounterBasedLooping_2 = false;
	$RepeatSelectionCounter_2_Iterations = "-1";
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../players/ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
</script>
<?php
		  $tabCounter = 2;
		  $tabIncrement= 1;
		  $tabTable= 1;
		  $tabMatch= 1;
	?>
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
        	<?php include '../Templates/includes/user-navigation.php'; ?>
			<h1 class="center">Battle-Comm.com Tourney Tool</h1>
            <h2>Player Assignment      
            </h2>
            <p>Assign Players to Tournament &quot;<?php echo $row_tournamentGameJoin['tournament_name']; ?> (ID=<?php echo $row_tournamentGameJoin['tournament_id']; ?>&quot; - Round &quot;<?php echo $row_rounds['Round_Title']; ?>&quot; </p>
<p># of Players Per Session (Game): <?php echo $row_tournamentGameJoin['noOfPlayers']; ?></p>
<p>Total # of Registered Players: <?php echo $totalRows_tournamentPlayers ?> | <a href=""playerAssignment_A_3_random.php?tourney={{GameTourneyJoin.data[0].tournament_id}}&rd={{rounds_id}}""">Random Sort Players</a></p>
         
           <form action="" method="post" name="RoundRegistration" id="RoundRegistration">    
<table width="95%" border="1">
        <tbody>
         <tr>
    <th scope="col">Handle</th>
    <th scope="col">Round</th>
    <th scope="col">Game System</th>
    <th scope="col">Match</th>
    <th scope="col">Table</th>
    <th scope="col">Current Tournament Score</th>
    </tr> 
    
         <?php
	// RepeatSelectionCounter_1 Begin Loop
	$RepeatSelectionCounter_1_IterationsRemaining = $RepeatSelectionCounter_1_Iterations;
	while($RepeatSelectionCounter_1_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_1 || $row_tournamentPlayers){
?>
          <tr>
            <td><?php echo $row_tournamentPlayers['firstName']; ?> <?php echo $row_tournamentPlayers['lastName']; ?>(<?php echo $row_tournamentPlayers['userHandle']; ?>)
              <input type="hidden" name="playerID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" id="playerID_mihidden_<?php echo $RepeatSelectionCounter_1; ?>" value="1" />
              <input name="playerHandle_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="playerHandle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentPlayers['userHandle']; ?>">
              <input name="playerID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="playerID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentPlayers['user_login_id']; ?>">
              <input name="tourney_PlayerID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="tourney_PlayerID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentPlayers['tournament_players_id']; ?>"><span style="font-size:smaller;"><?php echo $row_tournamentPlayers['tournament_players_id']; ?></span>
              <br>
              <span>
              <?php
  if ("".$row_tournamentPlayers['clubID']  ."" != "9") {  // WebAssist Show If
?> 
              Club: <?php echo $row_tournamentPlayers['club_name']; ?>
              <?php
  } // ("".$row_tournamentPlayers['clubID']  ."" != "9")
?>
              </span></td>
            <td><?php echo $row_rounds['Round_Title']; ?>
              <input name="roundID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="roundID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rounds['rounds_id']; ?>">
              <input name="roundTitle_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="roundTitle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_rounds['Round_Title']; ?>">
              <input name="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="tournamentID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentGameJoin['tournament_id']; ?>"></td>
            <td><?php echo $row_tournamentGameJoin['game_system_Title']; ?>
              <input name="gameID_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="gameID_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentGameJoin['game_system_id']; ?>">
              <input name="gameTitle_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="gameTitle_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentGameJoin['game_system_Title']; ?>"></td>
            <td>Match 
              <input name="matchID_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="matchID_<?php echo $RepeatSelectionCounter_1; ?>" size="4" value="<?php echo $tabMatch; ?>">
               
              </td>
            <td>Table 
              <input name="tableID_<?php echo $RepeatSelectionCounter_1; ?>" type="text" id="tableID_<?php echo $RepeatSelectionCounter_1; ?>" size="4" value="<? echo $tabTable; ?>"></td>
            <td><?php echo $row_tournamentPlayers['totalScore']; ?>              <input name="totalScore_<?php echo $RepeatSelectionCounter_1; ?>" type="hidden" id="totalScore_<?php echo $RepeatSelectionCounter_1; ?>" value="<?php echo $row_tournamentPlayers['totalScore']; ?>"></td>
          </tr>
          <?php
		  	if ($tabIncrement < $tabCounter) {
				$tabIncrement ++;} else {
					$tabIncrement = 1;
					$tabMatch ++;
					$tabTable ++;
				}
				?>
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
            <td><input type="submit" name="submit" id="submit" value="Submit"></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>

</form></p>
            <p>
            <table width="95%" border="1">
        <tbody>
          <tr>
            <th scope="col">Handle</th>
            <th scope="col">Round</th>
            <th scope="col">Game</th>
            <th scope="col">Match</th>
            <th scope="col">Table</th>
            <th scope="col">Current Score</th>
            <th scope="col">&nbsp;</th>
          </tr> 
          <?php
	// RepeatSelectionCounter_2 Begin Loop
	$RepeatSelectionCounter_2_IterationsRemaining = $RepeatSelectionCounter_2_Iterations;
	while($RepeatSelectionCounter_2_IterationsRemaining--){
		if($RepeatSelectionCounterBasedLooping_2 || $row_RoundAssignedPlayers){
?>
          <tr>
            <td><?php echo $row_RoundAssignedPlayers['player_handle']; ?></td>
            <td><?php echo $row_RoundAssignedPlayers['tourney_round_title']; ?></td>
            <td><?php echo $row_RoundAssignedPlayers['game_title']; ?></td>
            <td><?php echo $row_RoundAssignedPlayers['Game_session']; ?></td>
            <td><?php echo $row_RoundAssignedPlayers['table_id']; ?></td>
            <td><?php echo $row_RoundAssignedPlayers['total_points']; ?></td>
            <td><a href="../players/overviewRevA.php?tourney=<?php echo $row_tournamentGameJoin['tournament_id']; ?>&rd=<?php echo $row_rounds['rounds_id']; ?>&gs=<?php echo $row_RoundAssignedPlayers['Game_session']; ?>&tbl=<?php echo $row_RoundAssignedPlayers['table_id']; ?>" target="_blank">Overview</a></td>
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
  <td>&nbsp;</td>
</tr>
<?php } // RepeatSelectionCounter_2 End Alternate Content
		if(!$RepeatSelectionCounterBasedLooping_2 && $RepeatSelectionCounter_2_IterationsRemaining != 0){
			if(!$row_RoundAssignedPlayers && $RepeatSelectionCounter_2_Iterations == -1){$RepeatSelectionCounter_2_IterationsRemaining = 0;}
			$row_RoundAssignedPlayers = mysql_fetch_assoc($RoundAssignedPlayers);
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
          </tr>
        </tbody>
      </table></p>
            
           <p> <p><a href="to_manualScore_rev.php?=<?php echo $row_tournamentGameJoin['tournament_id']; ?>&rd=<?php echo $row_rounds['rounds_id']; ?>">Tournament Organizer Manual Scoring</a>
	   | <a href="tourney_SetupRevA.php?tourney=<?php echo $row_tournamentGameJoin['tournament_id']; ?>&gs=<?php echo $row_tournamentGameJoin['game_system_id']; ?>">Back to Round Configuration </a></p>
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
    </body>
</html>
<?php
mysql_free_result($tournamentGameJoin);

mysql_free_result($rounds);

mysql_free_result($tournamentPlayers);

mysql_free_result($RoundAssignedPlayers);
?>
