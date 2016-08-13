<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Assign Rounds</title>
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "tournamentGame" */
       jQuery.dmxDataSet(
         {"id": "tournamentGame", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentGame" */

  /* dmxDataSet name "Rounds" */
       jQuery.dmxDataSet(
         {"id": "Rounds", "url": "dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds" */

  /* dmxDataSet name "currentUser" */
       jQuery.dmxDataSet(
         {"id": "currentUser", "url": "dmxDatabaseSources/currentUser.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "currentUser" */
  /* dmxDataSet name "ActivePlayers" */
       jQuery.dmxDataSet(
         {"id": "ActivePlayers", "url": "dmxDatabaseSources/activePlayer.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "ActivePlayers" */

  /* dmxDataSet name "AssignedTournamentPlayers" */
       jQuery.dmxDataSet(
         {"id": "AssignedTournamentPlayers", "url": "dmxDatabaseSources/tournamentPlayersAssigned.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "AssignedTournamentPlayers" */
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
<script type="text/javascript" src="bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> <?php include("nav.php"); ?></div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Player Assignment</h2>
      <p>Assign Players to Tournament "{{tournamentGame.data[0].tournament_name}} &quot; Round "{{Rounds.data[0].Round_Title}}&quot;</p>
      <p>Players Per Session (Game):{{tournamentGame.data[0].noOfPlayers}} # of Games: {{tournamentGame.data[0].No_of_Games}}</p>
      <p>Currently logged in as: {{currentUser.data[0].user_handle}}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Heading</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      <table width="875" border="1">
        <tbody>
          <tr>
    <th scope="col">Handle</th>
    <th scope="col">Round</th>
    <th scope="col">Table</th>
    <th scope="col">&nbsp;</th>
    </tr>
          <tr data-binding-repeat="{{ActivePlayers.data}}" data-binding-id="repeat1">
            <td><input name="userID" type="hidden" id="userID" value="{{user_login_id}}" data-binding-value="{{user_login_id}}">
            <input name="userHandle" type="text" id="userHandle" value="{{userHandle}}" size="48" data-binding-value="{{userHandle}}">
            <input name="tournamentID" type="hidden" id="tournamentID" value="{{tournamentGame.data[0].tournament_id}}" data-binding-value="{{tournamentGame.data[0].tournament_id}}"></td>
            <td><input name="roundID" type="hidden" id="roundID" value="{{Rounds.data[0].rounds_id}}" data-binding-value="{{Rounds.data[0].rounds_id}}">
            <input name="RoundName" type="text" id="RoundName" value="{{Rounds.data[0].Round_Title}}" data-binding-value="{{Rounds.data[0].Round_Title}}">
            <input name="GameID" type="hidden" id="GameID" value="{{tournamentGame.data[0].game_id}}" data-binding-value="{{tournamentGame.data[0].game_id}}">
            <input name="GameTitle" type="hidden" id="GameTitle" value="{{tournamentGame.data[0].game_system_Title}}" data-binding-value="{{tournamentGame.data[0].game_title}}"></td>
            <td><input name="table" type="text" id="table" value="Table">
            <input name="playerassigne" type="hidden" id="playerassigne" value="yes"></td>
            <td><input name="button" type="button" id="button" onClick="dmxDatabaseActionControl('run','TournamentPlayerInsert',{'data':{&quot;player_id&quot;: &quot;{{@user_login_id}}&quot;}},this)" value="Add Player"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
      <h1>Assigned Players</h1>
      <table width="875" border="1">
        <tbody>
          <tr>
    <th width="220" scope="col">Handle</th>
    <th width="90" scope="col">Round</th>
    <th width="141" scope="col">Table</th>
    <th width="170" scope="col">&nbsp;</th>
    <th width="220" scope="col">&nbsp;</th>
  </tr>
          <tr data-binding-repeat="{{AssignedTournamentPlayers.data}}" data-binding-id="repeat2">
            <td>{{player_handle}}</td>
            <td>{{tourney_round_title}}</td>
            <td>{{table_id}}</td>
            <td><input type="button" name="button2" id="button2" value="Delete"></td>
            <td>Game Overview/Outcome</td>
          </tr>
          <tr>
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
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
      <p>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>Footer Left</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
<script type="text/javascript">
  /* dmxDatabaseAction name "TournamentPlayerInsert" */
       jQuery.dmxDatabaseAction(
         {"id": "TournamentPlayerInsert", "url": "dmxDatabaseActions/TrounamentPlayerInsert.php", "data": {"player_id": "{{$FORM.userID}}", "player_handle": "{{$FORM.userHandle}}", "tourney_round_id": "{{$FORM.roundID}}", "tourney_round_title": "{{$FORM.RoundName}}", "tournament_id": "{{$FORM.tournamentID}}", "game_id": "{{$FORM.GameID}}", "game_title": "{{$FORM.GameTitle}}", "Game_session": "", "table_id": "{{$FORM.table{{ActivePlayers.link.current}}}}"}, "success": "dmxDatabaseActionControl('run','updateTournamentPlayerAssignment',{},this);dmxDataBindingsAction('refresh','AssignedTournamentPlayers',{});dmxDataBindingsAction('refresh','ActivePlayers',{});"}
       );
  /* END dmxDatabaseAction name "TournamentPlayerInsert" */
  /* dmxDatabaseAction name "updateTournamentPlayerAssignment" */
       jQuery.dmxDatabaseAction(
         {"id": "updateTournamentPlayerAssignment", "url": "dmxDatabaseActions/updateTournamentPlayerAssignment.php", "data": {"tournament_id": "{{$FORM.tournamentID}}", "user_login_id": "{{$FORM.userID}}", "playerAssigned": "{{$FORM.playerassigned}}"}}
       );
  /* END dmxDatabaseAction name "updateTournamentPlayerAssignment" */
/* dmxDatabaseAction name "DeleteAssignedPlayer" */
       jQuery.dmxDatabaseAction(
         {"id": "DeleteAssignedPlayer", "url": "dmxDatabaseActions/DeleteAssignedPlayer.php", "data": {"tourney_game_player_id": "{{AssignedTournamentPlayers.data[0].player_id}}"}}
       );
  /* END dmxDatabaseAction name "DeleteAssignedPlayer" */
</script>
</body>
</html>