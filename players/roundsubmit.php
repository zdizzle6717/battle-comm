<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}?>
<?php
$TournamentAndGame = new WA_MySQLi_RS("TournamentAndGame",$battlecomm_sqli,1);
$TournamentAndGame->setQuery("SELECT tournament.*, game_system.* FROM tournament INNER JOIN game_system ON tournament.game_id = game_system.game_system_id WHERE tournament.tournament_id = ?");
$TournamentAndGame->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$TournamentAndGame->execute();?>
<?php
$Rounds = new WA_MySQLi_RS("Rounds",$battlecomm_sqli,1);
$Rounds->setQuery("SELECT tournament_rounds.* FROM tournament_rounds WHERE tournament_rounds.rounds_id = ?");
$Rounds->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param1
$Rounds->execute();?>
<?php
$matchedTiebreakers = new WA_MySQLi_RS("matchedTiebreakers",$battlecomm_sqli,1);
$matchedTiebreakers->setQuery("SELECT matched_tiebreakers.* FROM matched_tiebreakers WHERE matched_tiebreakers.tournament_ID = ? AND matched_tiebreakers.match_id = ?");
$matchedTiebreakers->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$matchedTiebreakers->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$matchedTiebreakers->execute();
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
$opposingPlayer->setQuery("SELECT tournament_game_player.*, user_login.* FROM tournament_game_player INNER JOIN user_login ON tournament_game_player.player_id = user_login.id WHERE tournament_game_player.tournament_id = ? AND tournament_game_player.tourney_round_id = ? AND tournament_game_player.Game_session = ? AND tournament_game_player.table_id = ? AND tournament_game_player.player_id < ?");
$opposingPlayer->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$opposingPlayer->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$opposingPlayer->bindParam("s", "".(isset($_GET['gs'])?$_GET['gs']:"")  ."", "-1"); //WAQB_Param3
$opposingPlayer->bindParam("s", "".(isset($_GET['tbl'])?$_GET['tbl']:"")  ."", "-1"); //WAQB_Param4
$opposingPlayer->bindParam("i", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param5
$opposingPlayer->execute();
?>
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
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Round Submit</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
  /* dmxDataSet name "RoundAssignment" */
       jQuery.dmxDataSet(
         {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundAssignment" */
</script>
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>Submit Player Outcome for <?php echo($TournamentAndGame->getColumnVal("tournament_name")); ?>/ Round <?php echo($Rounds->getColumnVal("Round_Title")); ?> (<?php echo($Rounds->getColumnVal("rounds_id")); ?>)</h2>
            <p><h2> <?php echo($loggedinUser->getColumnVal("firstName")); ?> <?php echo($loggedinUser->getColumnVal("lastName")); ?> (<?php echo($loggedinUser->getColumnVal("user_handle")); ?>)<br/>
           VS.<br/>
          <?php echo($opposingPlayer->getColumnVal("firstName")); ?> <?php echo($opposingPlayer->getColumnVal("lastName")); ?> (<?php echo($opposingPlayer->getColumnVal("user_handle")); ?> )</h2></p>
            
           <p> Submitting Score as: <?php echo($loggedinUser->getColumnVal("firstName")); ?> <?php echo($loggedinUser->getColumnVal("lastName")); ?></p>
            <p>
            <table width="200" border="1">
  <tbody>
    <tr>
      <th scope="col">Outcome</th>
      <th scope="col">Points</th>
      <th scope="col">Select</th>
    </tr>
    <tr>
      <td>Win</td>
      <td><?php echo($TournamentAndGame->getColumnVal("WinPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="win"></td>
    </tr>
    <tr>
      <td>Draw</td>
      <td><?php echo($TournamentAndGame->getColumnVal("DrawPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="draw"></td>
    </tr>
    <tr>
      <td>Loss</td>
      <td><?php echo($TournamentAndGame->getColumnVal("LossPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="loss"></td>
    </tr>
  </tbody>
</table>

<!--Begin Outcome Score capture/Calculation-->
<?php 
		$point_win= $TournamentAndGame->getColumnVal("WinPointValue"); 
		$point_draw=$TournamentAndGame->getColumnVal("DrawPointValue"); 
		$point_loss= $TournamentAndGame->getColumnVal("LossPointValue");
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
       <!--End Outcome Score calculation -->
</p>
            
           <p> Integer at nisl sollicitudin, iaculis quam non, iaculis dui. Cras quis erat vel elit tempor faucibus. Quisque malesuada aliquam dui in cursus. Praesent eu egestas est, a pretium lorem. Proin sem diam, dapibus eu fermentum vitae, tincidunt a felis. Donec sollicitudin et augue id luctus. Etiam maximus vitae orci a efficitur. Suspendisse nec imperdiet lacus. Pellentesque vulputate erat ac ornare mattis. Aenean ligula ex, congue non ligula id, molestie mollis felis. Aliquam sem eros, mollis quis enim id, pretium lacinia leo. Etiam hendrerit eros eget sapien gravida, et molestie erat maximus. Vivamus malesuada a magna non vehicula. Maecenas maximus justo leo, in vulputate arcu volutpat ut. Maecenas et tempor dui. Cras id suscipit arcu, sed gravida enim.</p>
            
           <p> Sed quis dolor et dolor sodales placerat. Pellentesque ut consectetur neque. Etiam interdum massa nec nisl semper, et commodo quam placerat. Sed eu magna massa. Nullam dignissim pulvinar purus sed sodales. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse lobortis nec erat id varius. Aenean et dictum nulla, ac fringilla quam. Donec gravida metus orci, semper suscipit lacus fringilla fringilla. Nulla et congue dolor. Duis nec mi ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi rhoncus mauris sit amet velit semper, ut vestibulum ligula sollicitudin.</p>

 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 