<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}

$tournament = new WA_MySQLi_RS("tournament",$battlecomm_sqli,1);
$tournament->setQuery("SELECT tournament.tournament_id, tournament.tournament_name, tournament.factions_cap, tournament.game_id, tournament.WinPointValue, tournament.DrawPointValue, tournament.LossPointValue, game_system.game_system_id, game_system.game_system_Title, game_system.noOfPlayers FROM tournament INNER JOIN game_system ON tournament.game_id = game_system.game_system_id WHERE tournament.tournament_id = ?");
$tournament->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param1
$tournament->execute();?>
<?php
$rounds = new WA_MySQLi_RS("rounds",$battlecomm_sqli,1);
$rounds->setQuery("SELECT tournament_rounds.rounds_id, tournament_rounds.tournament_id, tournament_rounds.Round_Title FROM tournament_rounds WHERE tournament_rounds.rounds_id = ?");
$rounds->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param1
$rounds->execute();?>
<?php
$Tiebreakers = new WA_MySQLi_RS("Tiebreakers",$battlecomm_sqli,0);
$Tiebreakers->setQuery("SELECT matched_tiebreakers.* FROM matched_tiebreakers WHERE matched_tiebreakers.tournament_ID = ? AND matched_tiebreakers.match_id = ?");
$Tiebreakers->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param1
$Tiebreakers->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$Tiebreakers->execute();
?>
<?php
$RoundPlayers = new WA_MySQLi_RS("RoundPlayers",$battlecomm_sqli,0);
$RoundPlayers->setQuery("SELECT tournament_game_player.*, user_login.id, user_login.firstName, user_login.lastName FROM tournament_game_player INNER JOIN user_login ON tournament_game_player.player_id = user_login.id WHERE tournament_game_player.tourney_round_id = ? AND tournament_game_player.tournament_id = ? AND tournament_game_player.Game_session = ? AND tournament_game_player.table_id = ?");
$RoundPlayers->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param1
$RoundPlayers->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param2
$RoundPlayers->bindParam("s", "".(isset($_GET['gs'])?$_GET['gs']:"")  ."", "-1"); //WAQB_Param3
$RoundPlayers->bindParam("s", "".(isset($_GET['tbl'])?$_GET['tbl']:"")  ."", "-1"); //WAQB_Param4
$RoundPlayers->execute();
?>
<?php
$roundPlayer = new WA_MySQLi_RS("roundPlayer",$battlecomm_sqli,1);
$roundPlayer->setQuery("SELECT tournament_players.tournament_players_id, tournament_players.tournament_id, tournament_players.user_login_id, tournament_players.userHandle, tournament_players.firstName, tournament_players.lastName, tournament_players.totalScore FROM tournament_players WHERE tournament_players.user_login_id = ?");
$roundPlayer->bindParam("s", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param1
$roundPlayer->execute();
?>
<?php
$TourneyGamePlayer = new WA_MySQLi_RS("TourneyGamePlayer",$battlecomm_sqli,1);
$TourneyGamePlayer->setQuery("SELECT tournament_game_player.* FROM tournament_game_player WHERE tournament_game_player.tournament_id = ? AND tournament_game_player.tourney_round_id = ? AND tournament_game_player.Game_session = ? AND tournament_game_player.table_id = ? AND tournament_game_player.player_id = ?");
$TourneyGamePlayer->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param1
$TourneyGamePlayer->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$TourneyGamePlayer->bindParam("s", "".(isset($_GET['gs'])?$_GET['gs']:"")  ."", "-1"); //WAQB_Param3
$TourneyGamePlayer->bindParam("s", "".(isset($_GET['tbl'])?$_GET['tbl']:"")  ."", "-1"); //WAQB_Param4
$TourneyGamePlayer->bindParam("i", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param5
$TourneyGamePlayer->execute();
?>
<?php
 require_once( "../webassist/security_assist/helper_php.php" ); ?>
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
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>Your Score Has Been Summitted.</h2>
			<p>Once it has been approved it will appear in your <a href="index.php">Home Page</a>.</p>
			<a href="mydashboard.php">
			<p></p>
			</a>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 