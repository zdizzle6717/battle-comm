<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once('../webassist/mysqli/queryobj.php'); ?>
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
$roundPlayer->setQuery("SELECT tournament_players.tournament_players_id, tournament_players.tournament_id, tournament_players.user_login_id, tournament_players.userHandle, tournament_players.firstName, tournament_players.lastName, tournament_players.totalScore FROM tournament_players WHERE tournament_players.user_login_id = ? AND tournament_players.tournament_id = ?");
$roundPlayer->bindParam("s", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param1
$roundPlayer->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param2
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
if (isset($_POST["SubmitScore"]) || isset($_POST["SubmitScore_x"])) {
  $UpdateQuery = new WA_MySQLi_Query($battlecomm_sqli);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "tournament_game_player";
  $UpdateQuery->bindColumn("tourney_game_player_id", "i", "".((isset($_POST["tourneyPlayerID"]))?$_POST["tourneyPlayerID"]:"")  ."", "WA_IGNORE");
  $UpdateQuery->bindColumn("game_result", "s", "".((isset($_POST["OutCome"]))?$_POST["OutCome"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("game_points", "i", "".((isset($_POST["GamePoints"]))?$_POST["GamePoints"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("mission_points", "i", "".((isset($_POST["missionPoints"]))?$_POST["missionPoints"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("total_points", "i", "".((isset($_POST["totalRound"]))?$_POST["totalRound"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->addFilter("tourney_game_player_id", "=", "i", "".((isset($_POST["tourneyPlayerID"]))?$_POST["tourneyPlayerID"]:"")  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<?php
if (isset($_POST["SubmitScore"]) || isset($_POST["SubmitScore_x"])) {
  $UpdateQuery = new WA_MySQLi_Query($battlecomm_sqli);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "tournament_players";
  $UpdateQuery->bindColumn("totalScore", "i", "".((isset($_POST["hiddenField"]))?$_POST["hiddenField"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->addFilter("tournament_players_id", "=", "i", "".($roundPlayer->getColumnVal("tournament_players_id"))  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "scoreconfirm.php";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
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
function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}
function MM_showHideLayers() { //v9.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) 
  with (document) if (getElementById && ((obj=getElementById(args[i]))!=null)) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}
</script>
</head>
 <?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>Confirm Round Results for <?php echo($tournament->getColumnVal("tournament_name")); ?>/ Round <?php echo($rounds->getColumnVal("Round_Title")); ?></h2>
			<p>Players: </p><?php
while(!$RoundPlayers->atEnd()) {
?>
			<?php echo($RoundPlayers->getColumnVal("firstName")); ?> <?php echo($RoundPlayers->getColumnVal("lastName")); ?>
			<?php
  $RoundPlayers->moveNext();
}
$RoundPlayers->moveFirst(); //return RS to first record
?>
            <p>Submitting Score as <?php echo($roundPlayer->getColumnVal("firstName")); ?> <?php echo($roundPlayer->getColumnVal("lastName")); ?> <?php echo($roundPlayer->getColumnVal("tournament_players_id")); ?></p>
            
           <p> 
           <p> <form action="submitscore.php" method="post" name="player_results_submit" id="player_results_submit">
           
           <table width="200" border="1">
  <tbody>
    <tr>
      <th scope="col">Outcome</th>
      <th scope="col">Points</th>
      <th scope="col">Select</th>
    </tr>
    <tr>
      <td>Win</td>
      <td><?php echo($tournament->getColumnVal("WinPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="win"></td>
    </tr>
    <tr>
      <td>Draw</td>
      <td><?php echo($tournament->getColumnVal("DrawPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="draw"></td>
    </tr>
    <tr>
      <td>Loss</td>
      <td><?php echo($tournament->getColumnVal("LossPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="loss"></td>
    </tr>
  </tbody>
</table>
<!--Begin Outcome Score capture/Calculation-->
<?php 
		$point_win= $tournament->getColumnVal("WinPointValue"); 
		$point_draw=$tournament->getColumnVal("DrawPointValue");
		$point_loss= $tournament->getColumnVal("LossPointValue");
		$win_count=0;
		$draw_count=0;
		$loss_count=0;
	
if(isset($_POST['submit']) && ($_POST['game_outcome']))
{
   $outcome=$_POST['game_outcome'];
}
?>
  <?php if ($outcome=='win'){
	$out_points=$tournament->getColumnVal("WinPointValue");
	$win_count = 1;}
	elseif ($outcome=='draw'){
		$out_points=$tournament->getColumnVal("DrawPointValue");
		$draw_count =1;}
	elseif ($outcome=='loss') {
		$out_points=$tournament->getColumnVal("LossPointValue");
		$loss_count=1;} 
	else {
		$out_points=0;}
       ?>
       <!--End Outcome Score calculation -->
	<?php
		$gamePointsTotal=$out_points;
		?>

</p>
            <p>
              <input name="Total Game Points" type="text" id="Total Game Points" value="<? echo $gamePointsTotal; ?>">
            <table width="500" border="1">
  <tbody>
    <tr>
      <th scope="col">Mission</th>
      <th scope="col">Points</th>
      <th scope="col">Select</th>
    </tr>
    
    <?php
while(!$Tiebreakers->atEnd()) {
?>
    <tr>
      <td><?php echo($Tiebreakers->getColumnVal("mission_name")); ?></td>
      <td><?php echo($Tiebreakers->getColumnVal("tiebreaker_points")); ?></td>
      <td style="text-align: center"><input name="tiebreaker[]" type="checkbox" id="tiebreaker[]" value="<?php echo($Tiebreakers->getColumnVal("tiebreaker_points")); ?>"></td>
    </tr>
    <?php
  $Tiebreakers->moveNext();
}
$Tiebreakers->moveFirst(); //return RS to first record
?>
    <tr>
      <td><input name="tourneyPlayersID" type="hidden" id="tourneyPlayersID" value="<?php echo($roundPlayer->getColumnVal("tournament_players_id")); ?>"></td>
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
</table></p>
            
           <p> <p>Outcome: <input name="OutCome" type="text" id="OutCome" value="<?php echo((isset($_POST["game_outcome"]))?$_POST["game_outcome"]:"") ?>"></p>
       <!-- <p>Choice: <? echo $_POST['game_outcome']; ?>-->
        <p>Game Points:<input name="GamePoints" type="text" id="GamePoints" value="<? echo $gamePointsTotal; ?>"> </p>
        <p>Mission Points: 
          <input name="missionPoints" type="text" id="missionPoints" value="<? echo $tiebreakerTotal; ?>">
          </p>
        <? $round_total = $gamePointsTotal + $tiebreakerTotal; ?>
        <p>Total Points for Round: 
          <input name="totalRound" type="text" id="totalRound" value="<? echo $round_total ?>">
           </p>
        <p><? $tournament_totalPoints= $roundPlayer->getColumnVal("totalScore");
				$tournament_totalPoints= $round_total + $tournament_totalPoints;
				?>
        
        
        Total Points for Tournament: <?echo $tournament_totalPoints; ?>
        
        <input type="hidden" name="hiddenField" id="hiddenField" value=" <?echo $tournament_totalPoints; ?>">
        <p>h:<?php echo($TourneyGamePlayer->getColumnVal("player_handle")); ?>  
  id:<?php echo($TourneyGamePlayer->getColumnVal("tourney_game_player_id")); ?>
  plID; <?php echo($TourneyGamePlayer->getColumnVal("tourney_players_id")); ?>
  <input name="tourneyPlayerID" type="hidden" id="tourneyPlayerID" form="player_results_submit" value="<?php echo($TourneyGamePlayer->getColumnVal("tourney_game_player_id")); ?>"><?php echo($TourneyGamePlayer->getColumnVal("tourney_game_player_id")); ?>
  <div id="generate" name="generate" style="display:none;"><input name="submit" type="submit" id="submit" form="player_results_submit" formaction="#" formmethod="POST" onClick="MM_showHideLayers('SubmitScore','','show');MM_showHideLayers('submit','','hide')" onMouseDown="MM_changeProp('submit','','display','inline','DIV')" value="Generate Results"></div>
  <div id="submit" name="submit" style="display:inline;"><input name="SubmitScore" type="submit" id="SubmitScore" formaction="#" value="Submit Score">
  </div>
		</p></p>
            </p></p></form></p>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 