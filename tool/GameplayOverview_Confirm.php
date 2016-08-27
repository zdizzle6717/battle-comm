<?php require_once('Connections/localhost.php'); ?>
<?php require_once('webassist/mysqli/rsobj.php'); ?>
<?php
$ActivePlayer = new WA_MySQLi_RS("ActivePlayer",$localhost,1);
$ActivePlayer->setQuery("SELECT * FROM tournament_game_player WHERE tourney_game_player_id = ?");
$ActivePlayer->bindParam("i", "".(isset($_GET['pl'])?$_GET['pl']:"")  ."", "-1"); //colname
$ActivePlayer->execute();?>
<?php
$tournamentGameCategory = new WA_MySQLi_RS("tournamentGameCategory",$localhost,1);
$tournamentGameCategory->setQuery("SELECT tournament.*, game_system.*, game_categories.* FROM tournament INNER JOIN game_system ON tournament.game_id = game_system.game_system_id INNER JOIN game_categories ON game_system.games_category = game_categories.game_category WHERE tournament.tournament_id = ?");
$tournamentGameCategory->bindParam("i", "".$_GET['tourney']  ."", "4"); //tourney
$tournamentGameCategory->execute();?>
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
$opponents->bindParam("i", "".$_GET['pl']  ."", "105"); //opponent
$opponents->bindParam("s", "".$_GET['session']  ."", "Session 1"); //gameSession
$opponents->execute();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
 <p>Confirm Game submission from <?php echo($ActivePlayer->getColumnVal("player_handle")); ?>
 </p>
 <p>&nbsp;</p>
 <p>Please confirm that the following submission is correct.</p>
 <p>If you need to change anything please go back and make the changes on the previous page.</p>
 <p>&nbsp;</p>
 <p>GameOutcome: <?php echo((isset($_POST["outcome"]))?$_POST["outcome"]:"") ?></p>
 <p>MissionPoints: <?php echo((isset($_POST["tiebreaker"]))?$_POST["tiebreaker"]:"") ?></p>
 <p>Notes/Comments: <?php echo((isset($_POST["notes"]))?$_POST["notes"]:"") ?></p>
 <p>&nbsp;</p>
 <p>If it's all correct, you can submit your results to the TO. Once they confirm and approve your<br>
 results the points wil be awarded and automatically applied to your account.</p>
 <p><input type="submit">&nbsp;</p>
</body>
</html>