<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Player Assignment</title>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "players_list" */
       jQuery.dmxDataSet(
         {"id": "players_list", "url": "dmxDatabaseSources/ActivePlayerAccounts.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "players_list" */

  /* dmxDataSet name "tournamentName" */
       jQuery.dmxDataSet(
         {"id": "tournamentName", "url": "dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "1"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentName" */
  /* dmxDataSet name "roundsFiltered" */
       jQuery.dmxDataSet(
         {"id": "roundsFiltered", "url": "dmxDatabaseSources/Rounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "roundsFiltered" */
  /* dmxDataSet name "tournament_game_join" */
       jQuery.dmxDataSet(
         {"id": "tournament_game_join", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament_game_join" */

  /* dmxDataSet name "tournamentPlayers" */
       jQuery.dmxDataSet(
         {"id": "tournamentPlayers", "url": "dmxDatabaseSources/tournamentPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentPlayers" */
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
function dmxDatabaseActionControl(action, id) { // v1.0
  if (jQuery.dmxDatabaseAction) {
    var da = jQuery.dmxDatabaseAction.get(id),
        args = Array.prototype.slice.call(arguments, 2);
    if (da) {
      da[action].apply(da, args);
    }
  }
}
</script>
</head>

<body>
<p align="center"><h3 align="center"> Player/Game Assignment for {{tournamentName.data[0].tournament_name}}- {{roundsFiltered.data[0].Round_Title}}</h3>
<br>
<p> 
<table width="800" border="1" align="center">
  <tr>
    <th scope="col">Player</th>
    <th scope="col">Round</th>
    <th scope="col">Game</th>
    <th scope="col">Game Session</th>
    <th scope="col">Table</th>
    <th scope="col">Approve</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <?php


$GameNum=2;
$numPlayers=2;
$a=1;
$count=1;
$game=1;
$inc=0;
$Fulloutput ="";

 while ($a <= $GameNum) {

	while ($count <=$numPlayers) {
	echo "<tr align=\"center\">
    <td><input name=\"playerHandle\" type=\"text\" id=\"playerHandle\" value=\"{{players_list.data[$inc].playerHandle}}\"><input name=\"playerID\" type=\"hidden\" id=\"playerID\" data-binding-value=\"{{players_list.data[$inc].playerId}}\"></td>
    <td>{{roundsFiltered.data[0].Round_Title}} <input name=\"roundID\" type=\"hidden\" id=\"roundID\" data-binding-value=\"{{roundsFiltered.data[0].rounds_id}}\"></td>
    <td>{{tournament_game_join.data[0].game_system_Title}}- {{tournament_game_join.data[0].game_system_id}}</td>
     <td><input name=\"Game $game\" type=\"text\" id=\"Game $game\" value=\"Game # $game\"></td>
	 <td><input name=\"Table_ID\" type=\"text\" id=\"Table_ID\" value=\"$game\"></td>
    <td> <input type=\"checkbox\" checked=\"checked\"> </td>
	<td><input name=\"registerPlayers\" type=\"button\" id=\"registerPlayers\" value=\"Register Players\"></td>";
		$count++;
		$inc++;
		
	}
$count=1;
$game++;
$a++;

}

?>
  <?php echo "$Fulloutput"; ?>
  <tr align="center">
    <td></td>
    <td align="center"></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr align="center">
    <td></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>

<p>&nbsp;</p>
<form action=" " method="post" id="playerAssignment" name="playerAssignment">
<table width="800" border="1">
  <tr>
    <th scope="col">Player ID</th>
    <th scope="col">Round</th>
    <th scope="col">Game</th>
    <th scope="col">Session</th>
    <th scope="col">Table</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr data-binding-repeat="{{players_list.data}}" data-binding-id="repeat3" data-binding-repeat-size="{{tournament_game_join.data[0].No_of_Games}}">
    <td><input name="playerHandle" type="text" id="playerHandle" data-binding-value="{{playerHandle}}"><input name="playerID" type="hidden" id="playerID" data-binding-value="{{playerId}}"></td>
    <td><input name="Round" type="text" id="Round" data-binding-value="{{roundsFiltered.data[0].Round_Title}}"><input name="roundID" type="hidden" id="roundID" data-binding-value="{{roundsFiltered.data[0].rounds_id}}"></td>
    <td><input name="GameSystem" type="text" id="GameSystem" data-binding-value="{{tournament_game_join.data[0].game_system_Title}}"><input name="GameID" type="hidden" id="GameID" data-binding-value="{{tournament_game_join.data[0].game_system_id}}"></td>
    <td><input name="GameSession" type="text" id="GameSession" value="Game "></td>
    <td><input name="Table" type="text" id="Table" value="Table"></td>
    <td><input type="text" data-binding-value="{{$number}}"></td>
    <td>
	
	<input name="PlayerAssignment" type="submit" id="PlayerAssignment" form="playerAssignment" formmethod="POST" onClick="dmxDatabaseActionControl('run','PlayerAssign',{},this)">
	</td>
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
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table></form>
<p>
<table width="800" border="1">
  <tr>
    <th width="152" scope="col">Player Handle</th>
    <th colspan="2" scope="col">Round</th>
    <th colspan="2" scope="col">Game</th>
    <th width="135" scope="col">Session</th>
    <th width="103" scope="col">Table</th>
    <th width="18" scope="col">&nbsp;</th>
    <th width="23" scope="col">&nbsp;</th>
  </tr>
  <tr data-binding-repeat="{{tournamentPlayers.data}}" data-binding-id="repeat4">
    <td>{{player_handle}}</td>
    <td width="79">{{tourney_round_title}}</td>
    <td width="77">{{tourney_round_id}}</td>
    <td width="94">{{game_title}}</td>
    <td width="61">{{game_id}}</td>
    <td>{{Game_session}}</td>
    <td>{{table_id}}</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table></p>
<p>
</p>
  <p> 
<strong>variable Check:</strong><br>
Game ID:     {{tournament_game_join.data[0].game_system_id}}<br>
Game Title: {{tournament_game_join.data[0].game_system_Title}}S<br>
#Players {{tournament_game_join.data[0].noOfPlayers}}<br>
#Games
{{tournament_game_join.data[0].No_of_Games}}<br>
round ID: </p>
<div data-binding-id="repeat1" data-binding-repeat="roundsFiltered.data">{{rounds_id}}</div>
<br>
round Title
<div data-binding-id="repeat2" data-binding-repeat="roundsFiltered.data">{{Round_Title}}</div>
<br>
tournament ID:{{tournamentName.data[0].tournament_id}}<br>
Game Cat: {{tournament_game_join.data[0].game_category}}<br>
pointsWin:   {{tournament_game_join.data[0].WinPointValue}}<br>
PointsLoss: {{tournament_game_join.data[0].lossPointValue}}<br>
Points:Draw:
{{tournament_game_join.data[0].drawPointValue}}
<script type="text/javascript">
  /* dmxDatabaseAction name "PlayerAssign" */
       jQuery.dmxDatabaseAction(
         {"id": "PlayerAssign", "url": "dmxDatabaseActions/AssignPlayer.php", "data": {"player_id": "{{$FORM.playerID}}", "player_handle": "{{$FORM.playerHandle}}", "tourney_round_id": "{{$FORM.roundID}}", "tourney_round_title": "{{$FORM.Round}}", "tournament_id": "{{tournament_game_join.data[0].tournament_id}}", "game_id": "{{$FORM.GameID}}", "game_title": "{{$FORM.GameSystem}}", "Game_session": "{{$FORM.GameSession}}", "table_id": "{{$FORM.Table}}"}, "success": "dmxDataBindingsAction('refresh','tournamentPlayers',{});"}
       );
  /* END dmxDatabaseAction name "PlayerAssign" */
</script>
</body>
</html>