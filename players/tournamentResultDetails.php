<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); 
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php
$tourneyGamePlayers = new WA_MySQLi_RS("tourneyGamePlayers",$battlecomm_sqli,0);
$tourneyGamePlayers->setQuery("SELECT tournament_game_player.* FROM tournament_game_player WHERE tournament_game_player.tournament_id = ? AND tournament_game_player.player_id = ? GROUP BY tournament_game_player.tourney_round_id");
$tourneyGamePlayers->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param1
$tourneyGamePlayers->bindParam("i", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param2
$tourneyGamePlayers->execute();
?>
<?php
$tournament = new WA_MySQLi_RS("tournament",$battlecomm_sqli,1);
$tournament->setQuery("SELECT tournament.* FROM tournament WHERE tournament.tournament_id = ?");
$tournament->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param1
$tournament->execute();
?>
<?php
$Recordset1 = new WA_MySQLi_RS("Recordset1",$battlecomm_sqli,1);
$Recordset1->setQuery("SELECT tournament_players.* FROM tournament_players WHERE tournament_players.tournament_id = ? AND tournament_players.user_login_id = ?");
$Recordset1->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param1
$Recordset1->bindParam("s", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param2
$Recordset1->execute();
?>
<?php
$Player = new WA_MySQLi_RS("Player",$battlecomm_sqli,1);
$Player->setQuery("SELECT user_login.* FROM user_login WHERE user_login.id = ?");
$Player->bindParam("i", "".$_SESSION['SecurityAssist_id']  ."", "-1"); //Param1
$Player->execute();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<title>BattleComm: Result Details</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
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
</script>
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>Result Details for <?php echo($Player->getColumnVal("firstName")); ?> <?php echo($Player->getColumnVal("lastName")); ?> (<?php echo($Player->getColumnVal("user_handle")); ?>) <?php echo($tournament->getColumnVal("tournament_name")); ?> </h2>
            <?php
while(!$tourneyGamePlayers->atEnd()) {
?>
            <?php echo($tourneyGamePlayers->getColumnVal("player_handle")); ?><br>
<?php echo($tourneyGamePlayers->getColumnVal("game_result")); ?>| Game Points:<?php echo($tourneyGamePlayers->getColumnVal("game_points")); ?> | Mission Points:<?php echo($tourneyGamePlayers->getColumnVal("mission_points")); ?><br>
Total for Round: <?php echo($tourneyGamePlayers->getColumnVal("total_points")); ?>
              <?php
  $tourneyGamePlayers->moveNext();
}
$tourneyGamePlayers->moveFirst(); //return RS to first record
?>

              <br>
              <br>
              Total Points for Tournament:<?php echo($Recordset1->getColumnVal("totalScore")); ?>
<p>&nbsp;</p>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 