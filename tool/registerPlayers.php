<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Register Players</title>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "tournaments" */
       jQuery.dmxDataSet(
         {"id": "tournaments", "url": "dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournaments" */
  /* dmxDataSet name "rounds" */
       jQuery.dmxDataSet(
         {"id": "rounds", "url": "dmxDatabaseSources/Rounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "rounds" */

  /* dmxDataSet name "tournament_game_join" */
       jQuery.dmxDataSet(
         {"id": "tournament_game_join", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament_game_join" */
/* dmxDataSet name "players" */
       jQuery.dmxDataSet(
         {"id": "players", "url": "dmxDatabaseSources/players.php", "data": {"player_handle": "{{$FORM.player_handle}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "players" */
function dmxDatabaseActionControl(action, id) { // v1.0
  if (jQuery.dmxDatabaseAction) {
    var da = jQuery.dmxDatabaseAction.get(id),
        args = Array.prototype.slice.call(arguments, 2);
    if (da) {
      da[action].apply(da, args);
    }
  }
}
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
</script>
</head>

<body>
<h2>Register Players for {{tournament_game_join.data[0].tournament_name}} - Any Round </h2>
<p>&nbsp;</p>
<table width="800" border="1">
  <tr>
    <th scope="col">Round</th>
    <th scope="col"># of Game Sessions</th>
    <th scope="col">Players Per Session</th>
    <th scope="col">Game</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr align="center" data-binding-repeat="{{rounds.data}}" data-binding-id="repeat1">
    <td>{{Round_Title}}</td>
    <td>{{tournament_game_join.data[0].No_of_Games}}</td>
    <td>{{tournament_game_join.data[0].noOfPlayers}}</td>
    <td>{{tournament_game_join.data[0].game_system_Title}}</td>
    <td>Bulk Add</td>
    <td>Search for User</td>
  </tr>
</table>
<p>&nbsp;</p>
<p><strong>Manually Register New Player (this will also create a base level Battle-Comm.com Account)</strong></p><form action="" method="post" name="register_player" id="register_player">
<p>Last Name: <input name="last_name" type="text" id="last_name"><br>
First Name: <input name="first_name" type="text" id="first_name"><br>
Handle: <input name="player_handle" type="text" required id="player_handle"><br>
Email: <input name="player_email" type="email" required id="player_email"><br><br>
</p>
<p><input name="registerUser" type="button" id="registerUser" onClick="dmxDatabaseActionControl('run','manualPlayerAdd',{},this)" value="Register Player">&nbsp;</p>

</form>
<hr>

<form><p>Handle: <input name="player_handle" type="text" id="player_handle" data-binding-value="{{players.data[0].playerHandle}}"></p>
<p>Last Name:  <input name="player_lastname" type="text" id="player_lastname" data-binding-value="{{players.data[0].playerLastName}}"></p>
<p>First Name: <input name="player_firstname" type="text" id="player_firstname" data-binding-value="{{players.data[0].playerFirstName}}"></p>
<p>Email: <input name="player_email" type="text" id="player_email" data-binding-value="{{players.data[0].playerEmail}}"></p>
<p>  Round: 
  <select name="roundTitle" id="roundTitle" data-binding-repeat-children="{{rounds.data}}" data-binding-id="repeat2">
    <option value="{{rounds_id}}">{{Round_Title}}</option>
  </select>
  <input name="GameID" type="hidden" id="GameID" data-binding-value="{{tournament_game_join.data[0].game_id}}">
  <input name="gameTitle" type="hidden" id="gameTitle" data-binding-value="{{tournament_game_join.data[0].game_system_Title}}">
  <input name="tournamentID" type="hidden" id="tournamentID" data-binding-value="{{tournament_game_join.data[0].tournament_id}}">
  <input name="playerID" type="hidden" id="playerID" data-binding-value="{{players.data[0].playerId}}">
</p>
<p><input name="Register Player" type="button" id="Register Player" onClick="dmxDatabaseActionControl('run','RegisterUsertoTournament',{},this)" value="Register Player">&nbsp;</p>
</form>
<script type="text/javascript">
/* dmxDatabaseAction name "manualPlayerAdd" */
       jQuery.dmxDatabaseAction(
         {"id": "manualPlayerAdd", "url": "dmxDatabaseActions/addPlayer.php", "data": {"player_handle": "{{$FORM.player_handle}}", "first_name": "{{$FORM.first_name}}", "last_name": "{{$FORM.last_name}}", "player_email": "{{$FORM.player_email}}"}, "success": "dmxDataBindingsAction('refresh','players',{});"}
       );
  /* END dmxDatabaseAction name "manualPlayerAdd" */
/* dmxDatabaseAction name "RegisterUsertoTournament" */
       jQuery.dmxDatabaseAction(
         {"id": "RegisterUsertoTournament", "url": "dmxDatabaseActions/manualPlayerTournamentRegistration.php", "data": {"playerID": "{{$FORM.playerID}}", "player_handle": "{{$FORM.player_handle}}", "round_id": "{{$FORM.roundTitle}}", "tourney_round_title": "", "tournamentID": "{{$FORM.tournamentID}}", "GameID": "{{$FORM.GameID}}", "gameTitle": "{{$FORM.gameTitle}}"}}
       );
  /* END dmxDatabaseAction name "RegisterUsertoTournament" */
</script>
</body>
</html>