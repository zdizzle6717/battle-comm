<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}

$Recordset1 = new WA_MySQLi_RS("Recordset1",$battlecomm_sqli,1);
$Recordset1->setQuery("SELECT tournament.*, game_system.* FROM tournament INNER JOIN game_system ON tournament.game_id = game_system.game_system_id WHERE tournament.tournament_id = ?");
$Recordset1->bindParam("i", "".$_GET['tourney']  ."", "-1"); //WAQB_Param1
$Recordset1->execute();?>
<?php
$rounds = new WA_MySQLi_RS("rounds",$battlecomm_sqli,1);
$rounds->setQuery("SELECT tournament_rounds.* FROM tournament_rounds WHERE tournament_rounds.rounds_id = ? AND tournament_rounds.tournament_id = ?");
$rounds->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param1
$rounds->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param2
$rounds->execute();?>
<?php
$MatchedTiebreakers = new WA_MySQLi_RS("MatchedTiebreakers",$battlecomm_sqli,0);
$MatchedTiebreakers->setQuery("SELECT matched_tiebreakers.* FROM matched_tiebreakers WHERE matched_tiebreakers.tournament_ID = ? AND matched_tiebreakers.match_id = ?");
$MatchedTiebreakers->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$MatchedTiebreakers->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$MatchedTiebreakers->execute();
?>
<?php
$GamePlayers = new WA_MySQLi_RS("GamePlayers",$battlecomm_sqli,0);
$GamePlayers->setQuery("SELECT tournament_game_player.* FROM tournament_game_player WHERE tournament_game_player.tournament_id = ? AND tournament_game_player.tourney_round_id = ? AND tournament_game_player.player_id = ?");
$GamePlayers->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$GamePlayers->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$GamePlayers->bindParam("i", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param3
$GamePlayers->execute();
?>
<?php
$loggedinUser = new WA_MySQLi_RS("loggedinUser",$battlecomm_sqli,1);
$loggedinUser->setQuery("SELECT id, firstName, lastName, user_handle, totalWins, totalLoss, totalDraw, totalPoints FROM user_login WHERE id = ?");
$loggedinUser->bindParam("i", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //colname
$loggedinUser->execute();
?>
<?php
$opposingPlayer = new WA_MySQLi_RS("opposingPlayer",$battlecomm_sqli,1);
$opposingPlayer->setQuery("SELECT tournament_game_player.tourney_game_player_id, tournament_game_player.player_id, tournament_game_player.player_handle FROM tournament_game_player WHERE tournament_game_player.tournament_id = ? AND tournament_game_player.tourney_round_id = ? AND tournament_game_player.Game_session = ? AND tournament_game_player.table_id = ? AND tournament_game_player.player_id <> ?");
$opposingPlayer->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$opposingPlayer->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$opposingPlayer->bindParam("s", "".(isset($_GET['gs'])?$_GET['gs']:"")  ."", "-1"); //WAQB_Param3
$opposingPlayer->bindParam("s", "".(isset($_GET['tbl'])?$_GET['tbl']:"")  ."", "-1"); //WAQB_Param4
$opposingPlayer->bindParam("i", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param5
$opposingPlayer->execute();?>
<?php
$tournament_players = new WA_MySQLi_RS("tournament_players",$battlecomm_sqli,1);
$tournament_players->setQuery("SELECT tournament_players.* FROM tournament_players WHERE tournament_players.user_login_id = ? AND tournament_players.tournament_id = ?");
$tournament_players->bindParam("s", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param1
$tournament_players->bindParam("i", "".$_GET['tourney']  ."", "-1"); //WAQB_Param2
$tournament_players->execute();
?>
<?php
$Factions = new WA_MySQLi_RS("Factions",$battlecomm_sqli,2);
$Factions->setQuery("SELECT * FROM AssignedFactions WHERE player_id = ?");
$Factions->bindParam("i", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //colname
$Factions->execute();
?>
<?php
if (isset($_POST["scoreSubmit"]) || isset($_POST["scoreSubmit_x"])) {
  $UpdateQuery = new WA_MySQLi_Query($battlecomm_sqli);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "tournament_game_player";
  $UpdateQuery->bindColumn("game_result", "s", "".((isset($_POST["GameOutcome"]))?$_POST["GameOutcome"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("game_points", "i", "".((isset($_POST["GamePoints"]))?$_POST["GamePoints"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("mission_points", "i", "".((isset($_POST["MissionPoints"]))?$_POST["MissionPoints"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("total_points", "i", "".((isset($_POST["totalRoundPoints"]))?$_POST["totalRoundPoints"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("Notes_comments", "s", "".((isset($_POST["textarea"]))?$_POST["textarea"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->addFilter("tourney_game_player_id", "=", "i", "".($GamePlayers->getColumnVal("tourney_game_player_id"))  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
if (isset($_POST["scoreSubmit"]) || isset($_POST["scoreSubmit_x"])) {
  $UpdateQuery = new WA_MySQLi_Query($battlecomm_sqli);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "tournament_players";
  $UpdateQuery->bindColumn("totalScore", "i", "".((isset($_POST["tournamentTotalPoints"]))?$_POST["tournamentTotalPoints"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->addFilter("tournament_players_id", "=", "i", "".((isset($_POST["tourneyPlayersID"]))?$_POST["tourneyPlayersID"]:"")  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Submit Game Outcome</title>
<link rel="stylesheet" type="text/css" href="../Styles/dmxNotify.css" />
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxNotify.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
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
<script type="text/javascript">
function dmxNotifyAction() {   //ver 1.00
  if (arguments && arguments.length > 0) {
    if(typeof arguments[0] == 'object'){
      jQuery.dmxNotify(arguments[0]);
    }else if(arguments[0] === 'closeAll'){
       jQuery.dmxNotify.closeAll();
    }
  }
}
</script>
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
                <p><h2>BattleComm.com Tourney Tool</h2></p>
<p>Submit Outcome for <?php echo($Recordset1->getColumnVal("tournament_name")); ?> / Round <?php echo($rounds->getColumnVal("Round_Title")); ?>. </p>
<p> Players:  <?php echo($loggedinUser->getColumnVal("user_handle")); ?>
 
vs. <?php echo($opposingPlayer->getColumnVal("player_handle")); ?>
<p>Signed in as: <?php echo($GamePlayers->getColumnVal("player_handle")); ?>-
<?php echo($loggedinUser->getColumnVal("firstName")); ?>
<?php echo($loggedinUser->getColumnVal("lastName")); ?>
<form action="../tool/overviewRevA.php" method="post" name="player_results_submit" id="player_results_submit">
<table width="200" border="1">
  <tbody>
    <tr>
      <th scope="col">Outcome</th>
      <th scope="col">Points</th>
      <th scope="col">Select</th>
    </tr>
    <tr>
      <td>Win</td>
      <td><?php echo($Recordset1->getColumnVal("WinPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="win"></td>
    </tr>
    <tr>
      <td>Draw</td>
      <td><?php echo($Recordset1->getColumnVal("DrawPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="draw"></td>
    </tr>
    <tr>
      <td>Loss</td>
      <td><?php echo($Recordset1->getColumnVal("LossPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="loss"></td>
    </tr>
  </tbody>
</table>
<p>
  <?php 
		$point_win= $Recordset1->getColumnVal("WinPointValue");
		$point_draw= $Recordset1->getColumnVal("DrawPointValue");
		$point_loss= $Recordset1->getColumnVal("LossPointValue");
		$win_count=0;
		$draw_count=0;
		$loss_count=0;
	
if(isset($_POST['submit']) && ($_POST['game_outcome']))
{
   $outcome=$_POST['game_outcome'];
}
?>
  <?php if ($outcome=='win'){
	$out_points=$Recordset1->getColumnVal("WinPointValue");
	$win_count = 1;}
	elseif ($outcome=='draw'){
		$out_points=$Recordset1->getColumnVal("DrawPointValue");
		$draw_count =1;}
	else {
		$out_points=$Recordset1->getColumnVal("LossPointValue");
		$loss_count=1;} 
       ?>
</p>
<table width="500" border="1">
  <tbody>
    <tr>
      <th scope="col">Mission</th>
      <th scope="col">Points</th>
      <th scope="col">Select</th>
    </tr>
    
    <?php
while(!$MatchedTiebreakers->atEnd()) {
?>
      <tr>
        <td><?php echo($MatchedTiebreakers->getColumnVal("mission_name")); ?></td>
        <td><?php echo($MatchedTiebreakers->getColumnVal("tiebreaker_points")); ?></td>
        <td style="text-align: center"><input name="tiebreaker[]" type="checkbox" id="tiebreaker[]" value=""></td>
      </tr>
      <?php
  $MatchedTiebreakers->moveNext();
}
$MatchedTiebreakers->moveFirst(); //return RS to first record
?>
    <tr>
      <td><input name="tourneyPlayersID" type="hidden" id="tourneyPlayersID" value="<?php echo($tournament_players->getColumnVal("tournament_players_id")); ?>"></td>
      <td>Total Points</td>
      <td><?php
	$tiebreakerTotal = 0;
	$tiepoints=0;
	if(isset($_POST['submit'])){
		if(!empty($_POST['tiebreaker'])){
			foreach($_POST['tiebreaker'] as $tiepoints){
				$tiebreakerTotal += $tiepoints;}	
			
		}
		
		
	}
		echo $tiebreakerTotal;
?></td>
  </tr>
  </tbody>
</table>
<p><strong>Factions</strong></p>
<ul>
  <?php
while(!$Factions->atEnd()) {
?>
  <li><?php echo($Factions->getColumnVal("factions_Name")); ?></li>
  <?php
  $Factions->moveNext();
}
$Factions->moveFirst(); //return RS to first record
?>
</ul>
<p>Outcome: <? echo $outcome; ?></p>
        <p>Choice: <? echo $_POST['game_outcome']; ?>
        <p>Game Points: <? echo $out_points; ?></p>
        <p>Mission Points: <? echo $tiebreakerTotal; ?></p>
        <? $round_total = $out_points + $tiebreakerTotal; ?>
        <p>Total Points for Round: <? echo $round_total; ?> </p>
        <p><? $tournament_totalPoints= $tournament_players->getColumnVal("totalScore");
				$tournament_totalPoints= $round_total + $tournament_totalPoints;
				?>
        
        
        Total Points for Tournament: <?echo $tournament_totalPoints; ?>
        
  <p><input name="submit" type="submit" id="submit" form="player_results_submit" formaction="#" formmethod="POST" value="Generate Results">
		</p>
</form>
<p>Once you submit this form , you acknowledge that the information you are submitting is correct as far as you know and that you and the other participant(s) in this game agree on this outcome. The submissions of all players will be reviewed by the TO and final points will be awarded once the TO confirms the submission and approves it.</p>
<form method="post" name="scoreSubmit" id="scoreSubmit" title="scoreSubmit">
  <p>Game Results to Submit: 
    <input name="tournament_Player_ID" type="hidden" id="tournament_Player_ID" value="<?php echo($tournament_players->getColumnVal("tournament_players_id")); ?>">
  </p>
  <p>
  <table width="500" border="1">
    <tbody>
      <tr>
        <th scope="row">Tournament</th>
        <td style="text-align: center"><?php echo($Recordset1->getColumnVal("tournament_name")); ?>
          <input name="tournamentName" type="hidden" id="tournamentName" value="<?php echo($Recordset1->getColumnVal("tournament_name")); ?>">
          <input name="tournamentID" type="hidden" id="tournamentID" value="<?php echo($Recordset1->getColumnVal("tournament_id")); ?>"></td>
      </tr>
      <tr>
        <th scope="row">Round</th>
        <td style="text-align: center"><?php echo($rounds->getColumnVal("Round_Title")); ?>
          <input name="roundName" type="hidden" id="roundName" value="<?php echo($rounds->getColumnVal("Round_Title")); ?>">
          <input name="roundID" type="hidden" id="roundID" value="<?php echo($rounds->getColumnVal("rounds_id")); ?>"></td>
      </tr>
      <tr>
        <th scope="row">Match</th>
        <td style="text-align: center"><?php echo($GamePlayers->getColumnVal("Game_session")); ?>
          <input name="MatchID" type="hidden" id="MatchID" value="<?php echo($GamePlayers->getColumnVal("Game_session")); ?>"></td>
      </tr>
      <tr>
        <th scope="row">Table</th>
        <td style="text-align: center">Table <?php echo($GamePlayers->getColumnVal("table_id")); ?>
          <input name="tableID" type="hidden" id="tableID" value="<?php echo($GamePlayers->getColumnVal("table_id")); ?>"></td>
      </tr>
      <tr>
        <th scope="row">Player</th>
        <td style="text-align: center"><?php echo($GamePlayers->getColumnVal("player_handle")); ?><input name="tourneyPlayersID" type="hidden" id="tourneyPlayersID" value="<?php echo($tournament_players->getColumnVal("tournament_players_id")); ?>"></td>
      </tr>
      <tr>
        <th scope="row">Outcome</th>
        <td style="text-align: center"><? echo $outcome; ?>
          <input name="GameOutcome" type="hidden" id="GameOutcome" value="<? echo $outcome; ?>"></td>
      </tr>
      <tr>
        <th scope="row">Game Points</th>
        <td style="text-align: center"><? echo $out_points; ?>
          <input name="GamePoints" type="hidden" id="GamePoints" value="<? echo $out_points; ?>"></td>
      </tr>
      <tr>
        <th scope="row">Mission Points</th>
        <td style="text-align: center"><? echo $tiebreakerTotal; ?>
          <input name="MissionPoints" type="hidden" id="MissionPoints" value="<? echo $tiebreakerTotal; ?>"></td>
      </tr>
      <tr>
        <th scope="row">Total Points for Round</th>
        <td style="text-align: center"><? echo $round_total; ?>
          <input name="totalRoundPoints" type="hidden" id="totalRoundPoints" value="<? echo $round_total; ?>"></td>
      </tr>
      <tr>
        <th scope="row">Total Points for Tournament</th>
        <td style="text-align: center"><? echo $tournament_totalPoints; ?> <input type="hidden" name="tournamentTotalPoints" id="tournamentTotalPoints" value="<? echo $tournament_totalPoints; ?>"></td>
      </tr>
      <tr>
        <th scope="row">Notes or Comments</th>
        <td style="text-align: center"><textarea name="textarea" cols="24" rows="8" id="textarea"></textarea></td>
      </tr>
      <tr>
        <th scope="row">Point added to Win/Draw/Loss Count</th>
        <td style="text-align: center"><? echo $win_count;?>/<? echo $draw_count; ?>/<? echo $loss_count; ?></td>
      </tr>
    </tbody>
  </table>
  <p>
  <p>
    <input name="scoreSubmit" type="submit" id="submit2" form="scoreSubmit" formmethod="POST" onClick="dmxNotifyAction({&quot;positionClass&quot;: &quot;toast-bottom-full-width&quot;, &quot;title&quot;: &quot;Your Results Have been submitted.&quot;, &quot;msg&quot;: &quot;You will be notified when the Tournament Organizer has Validated them.&quot;, &quot;extendedTimeOut&quot;: 2000})" value="Submit Results">
    <br>
  </p>


</form>

 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 