<?php require_once('Connections/battlecomm_sqli.php'); ?>
<?php require_once('webassist/mysqli/rsobj.php'); ?>
<?php
$tournamentGameJoin = new WA_MySQLi_RS("tournamentGameJoin",$battlecomm_sqli,1);
$tournamentGameJoin->setQuery("SELECT tournament.*, game_system.* FROM tournament INNER JOIN game_system ON tournament.game_id = game_system.game_system_id WHERE tournament.tournament_id = ?");
$tournamentGameJoin->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$tournamentGameJoin->execute();?>
<?php
$rounds = new WA_MySQLi_RS("rounds",$battlecomm_sqli,1);
$rounds->setQuery("SELECT tournament_rounds.* FROM tournament_rounds WHERE tournament_rounds.tournament_id = ? AND tournament_rounds.rounds_id = ?");
$rounds->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$rounds->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$rounds->execute();?>
<?php
$tournament_players = new WA_MySQLi_RS("tournament_players",$battlecomm_sqli,0);
$tournament_players->setQuery("SELECT tournament_game_player.* FROM tournament_game_player HAVING tournament_game_player.tournament_id = ?");
$tournament_players->bindParam("i", "".(isset($_GET['tourney'])?$_GET['tourney']:"")  ."", "-1"); //WAQB_Param1
$tournament_players->execute();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>TO Manual Round Scoring./title>
</head>

<body>
<p>This is to allow a Tournament Organizer to manually score any/all of the Matches per round.</p>
<p>&nbsp;</p>
<table width="900" border="1">
  <tbody>
    <tr>
      <th scope="col">Handle</th>
      <th scope="col">Match</th>
      <th scope="col">Table</th>
      <th scope="col">Outcome</th>
      <th scope="col">Mission Points</th>
      <th scope="col">Notes</th>
      <th scope="col">Total Points</th>
      <th scope="col">Modify</th>
    </tr>
    <?php
while(!$tournament_players->atEnd()) {
?>
    <tr>
      <td><?php echo($tournament_players->getColumnVal("player_handle")); ?></td>
      <td><?php echo($tournament_players->getColumnVal("Game_session")); ?></td>
      <td><?php echo($tournament_players->getColumnVal("table_id")); ?></td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td style="text-align: center"><input name="modify" type="checkbox" id="modify" value="1"></td>
    </tr>
    <?php
  $tournament_players->moveNext();
}
$tournament_players->moveFirst(); //return RS to first record
?>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>