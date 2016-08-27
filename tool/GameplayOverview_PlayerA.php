<?php require_once('Connections/localhost.php'); ?>
<?php require_once('webassist/mysqli/rsobj.php'); ?>
<?php require_once('webassist/mysqli/queryobj.php'); ?>
<?php
$ActivePlayer = new WA_MySQLi_RS("ActivePlayer",$localhost,1);
$ActivePlayer->setQuery("SELECT * FROM tournament_game_player WHERE tourney_game_player_id = ?");
$ActivePlayer->bindParam("i", "".($ActivePlayer->getColumnVal("tourney_game_player_id"))  ."", "-1"); //colname
$ActivePlayer->execute();
?>
<?php
$tournamentGameCategory = new WA_MySQLi_RS("tournamentGameCategory",$localhost,1);
$tournamentGameCategory->setQuery("SELECT tournament.*, game_system.*, game_categories.* FROM tournament INNER JOIN game_system ON tournament.game_id = game_system.game_system_id INNER JOIN game_categories ON game_system.games_category = game_categories.game_category WHERE tournament.tournament_id = ?");
$tournamentGameCategory->bindParam("i", "".$_GET['tourney']  ."", "4"); //tourney
$tournamentGameCategory->execute();
?>
<?php
$Rounds = new WA_MySQLi_RS("Rounds",$localhost,1);
$Rounds->setQuery("SELECT * FROM tournament_rounds WHERE tournament_rounds.tournament_id = ?");
$Rounds->bindParam("i", "".$_GET['tourney']  ."", "4"); //tourney
$Rounds->execute();?>
<?php
$tiebreakers = new WA_MySQLi_RS("tiebreakers",$localhost,0);
$tiebreakers->setQuery("SELECT * FROM matched_tiebreakers WHERE matched_tiebreakers.tournament_ID = ? AND matched_tiebreakers.match_id = ?");
$tiebreakers->bindParam("i", "".$_GET['tourney']  ."", "4"); //tourney
$tiebreakers->bindParam("i", "".$_GET['rd']  ."", "32"); //rd
$tiebreakers->execute();
?>
<?php
$opponents = new WA_MySQLi_RS("opponents",$localhost,1);
$opponents->setQuery("SELECT tournament_game_player.tourney_game_player_id, tournament_game_player.player_id, tournament_game_player.player_handle, tournament_game_player.Game_session FROM tournament_game_player WHERE tournament_game_player.player_id != ? AND tournament_game_player.Game_session = ?");
$opponents->bindParam("i", "".($ActivePlayer->getColumnVal("tourney_game_player_id"))  ."", "105"); //opponent
$opponents->bindParam("s", "".$_GET['session']  ."", "Session 1"); //gameSession
$opponents->execute();
?>
<?php
if (isset($_POST["SendResults"]) || isset($_POST["SendResults_x"])) {
  $UpdateQuery = new WA_MySQLi_Query($localhost);
  $UpdateQuery->Action = "update";
  $UpdateQuery->Table = "tournament_game_player";
  $UpdateQuery->bindColumn("player_handle", "s", "", "WA_DEFAULT");
  $UpdateQuery->bindColumn("game_result", "s", "".((isset($_POST["outcome"]))?$_POST["outcome"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("game_points", "i", "".((isset($_POST["confirmOutcome"]))?$_POST["confirmOutcome"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("mission_points", "i", "".((isset($_POST["tiebreaker"]))?$_POST["tiebreaker"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->bindColumn("Notes_comments", "s", "".((isset($_POST["notes"]))?$_POST["notes"]:"")  ."", "WA_DEFAULT");
  $UpdateQuery->addFilter("tourney_game_player_id", "=", "i", "".($ActivePlayer->getColumnVal("tourney_game_player_id"))  ."");
  $UpdateQuery->execute();
  $UpdateGoTo = "GameplayOverview_Confirm.php";
  if (function_exists("rel2abs")) $UpdateGoTo = $UpdateGoTo?rel2abs($UpdateGoTo,dirname(__FILE__)):"";
  $UpdateQuery->redirect($UpdateGoTo);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Game Submission</title>
</head>

<body>
<h3><?php echo($tournamentGameCategory->getColumnVal("tournament_name")); ?>
- <?php echo($Rounds->getColumnVal("Round_Title")); ?> - Game:<?php echo($ActivePlayer->getColumnVal("Game_session")); ?> <?php echo($Rounds->getColumnVal("startTime")); ?> - <?php echo($Rounds->getColumnVal("endTime")); ?></h3>
<p>You are currently signed in as <strong><?php echo($ActivePlayer->getColumnVal("player_handle")); ?></strong></p>
<p><?php echo($ActivePlayer->getColumnVal("table_id")); ?> : <?php echo($ActivePlayer->getColumnVal("player_handle")); ?> vs <?php echo($opponents->getColumnVal("player_handle")); ?></p>
<p>Game System: <?php echo($tournamentGameCategory->getColumnVal("game_system_Title")); ?></p>
<p>Notes or Addendum: <?php echo($Rounds->getColumnVal("notes_rules_changes")); ?></p>
<p>Tiebreakers for Round <?php echo($Rounds->getColumnVal("Round_Title")); ?></p>
<ul>
  <?php
while(!$tiebreakers->atEnd()) {
?>
    <li><?php echo($tiebreakers->getColumnVal("mission_name")); ?> - <?php echo($tiebreakers->getColumnVal("tiebreaker_points")); ?></li>
    <?php
  $tiebreakers->moveNext();
}
$tiebreakers->moveFirst(); //return RS to first record
?>
</ul>
<p>Upon completion of the Game - Fill out the following for submission to the Tournament Organizer for review.</p>
<form action="" method="post" name="results" id="results">
  <p>*****************************Resutls for <?php echo($Rounds->getColumnVal("Round_Title")); ?>
 from <?php echo($ActivePlayer->getColumnVal("player_handle")); ?>
  ***************</p>
  <p>Choose your outcome of <?php echo($tournamentGameCategory->getColumnVal("game_system_Title")); ?> 
   <select name="outcome" id="outcome">
     
     <option value="win">Win</option>
     <option value="Draw">Draw</option>
     <option value="loss">Loss</option>
     <option selected="selected">Choose Outcome</option> 
   </select>
   <br>
   Please confirm your choice: 
   <select name="confirmOutcome" id="confirmOutcome">
     <option>Confirm outcome</option>
     <option value="<?php echo($tournamentGameCategory->getColumnVal("WinPointValue")); ?>">Win</option>
     <option value="<?php echo($tournamentGameCategory->getColumnVal("drawPointValue")); ?>">Draw</option>
     <option value="<?php echo($tournamentGameCategory->getColumnVal("lossPointValue")); ?>">Loss</option>
   </select><p>
  Check the box for each mission you <strong>completed</strong>. <?php
while(!$tiebreakers->atEnd()) {
?>
  <p>   
    <input name="tiebreaker[]" type="checkbox" id="tiebreaker" value="<?php echo($tiebreakers->getColumnVal("tiebreaker_points")); ?>">  <?php echo($tiebreakers->getColumnVal("mission_name")); ?>
    
</p>
  <?php
  $tiebreakers->moveNext();
}
$tiebreakers->moveFirst(); //return RS to first record
?>  
  <p id="win" style="display:none;">
       Win Award <input name="winPoints" type="text" id="winPoints" value="<?php echo($tournamentGameCategory->getColumnVal("WinPointValue")); ?>">
 <p> Do you have any comments or any information to share about this match?</p>
 <p>
   <textarea name="notes" cols="48" rows="6" id="notes">Notes or Comments</textarea>
 </p>
 <p>Once you submit this form, you acknowledge that the information you are submitting is correct as far as you know and that you and the other participant(s) in this game agree on this outcome. The submissions of all players will be reviewed by the TO and final points will be awarded once the TO confirms the submission and approves it.</p>
 <p>&nbsp;
<input name="SendResults" type="submit" id="SendResults" formmethod="POST" value="Submit Results"></p>
</form>
<p>&nbsp;</p>
</body>
</html>