<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Player Assignment</title>
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap-theme.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "tourneyGameJoin" */
       jQuery.dmxDataSet(
         {"id": "tourneyGameJoin", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tourneyGameJoin" */
  /* dmxDataSet name "playersScore" */
       jQuery.dmxDataSet(
         {"id": "playersScore", "url": "../dmxDatabaseSources/players_score.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "playersScore" */
  /* dmxDataSet name "rounds" */
       jQuery.dmxDataSet(
         {"id": "rounds", "url": "dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "rounds" */

  /* dmxDataSet name "AssignedPlayers" */
       jQuery.dmxDataSet(
         {"id": "AssignedPlayers", "url": "../dmxDatabaseSources/activePlayer.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "AssignedPlayers" */
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
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
   [Eventual Navigation]
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Player Assignment</h2>
      <p>Assigns Players to Round {{rounds.data[0].Round_Title}} of {{tourneyGameJoin.data[0].tournament_name}}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>{{rounds.data[0].Round_Title}} ({{rounds.data[0].startTime}}- {{rounds.data[0].endTime}})</h2>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <th scope="col">Handle</th>
            <th scope="col">Game System</th>
            <th scope="col">Match</th>
            <th scope="col">Table</th>
            <th scope="col">Previous Score</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
          </tr>
          <tr data-binding-repeat="{{playersScore.data}}" data-binding-id="repeat1">
            <td>{{user_handle}}
                  <input name="userID" type="hidden" id="userID" value="{{id}}" data-binding-value="{{id}}">
                  <input name="userHandle" type="hidden" id="userHandle" value="{{user_handle}}" data-binding-value="{{user_handle}}"> <input name="roundID" type="hidden" id="roundID" value="{{rounds.data[0].rounds_id}}" data-binding-value="{{rounds.data[0].rounds_id}}"> <input name="roundTitle" type="hidden" id="roundTitle" value="{{rounds.data[0].Round_Title}}" data-binding-value="{{rounds.data[0].Round_Title}}">
                  <input name="tournamentID" type="hidden" id="tournamentID" value="{{rounds.data[0].tournament_id}}" data-binding-value="{{rounds.data[0].tournament_id}}"></td>
            <td>{{tourneyGameJoin.data[0].game_system_Title}}
            <input name="GameTitle" type="hidden" id="GameTitle" value="{{tourneyGameJoin.data[0].game_system_Title}}" data-binding-value="{{tourneyGameJoin.data[0].game_system_Title}}"> <input name="GameID" type="hidden" id="GameID" value="{{tourneyGameJoin.data[0].game_system_id}}" data-binding-value="{{tourneyGameJoin.data[0].game_system_id}}"></td>
            <td><input name="MatchID" type="text" id="MatchID" size="4"></td>
            <td>Table
              <input name="TableID" type="text" id="TableID" size="4"></td>
            <td>{{totalPoints}}</td>
            <td><input name="Assign" type="button" id="Assign" onClick="dmxDatabaseActionControl('run','PlayerRoundAssignment',{'data':{&quot;player_id&quot;: &quot;{{@id}}&quot;}},this)" value="Assign"></td>
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
        </tbody>
      </table>
      <p>&nbsp;</p>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr data-binding-repeat="{{AssignedPlayers.data}}" data-binding-id="repeat2">
            <td>{{player_handle}}</td>
            <td>Match {{Game_session}}</td>
            <td>Table {{table_id}}</td>
            <td>Delete</td>
            <td>ReAssign</td>
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
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
  /* dmxDatabaseAction name "PlayerRoundAssignment" */
       jQuery.dmxDatabaseAction(
         {"id": "PlayerRoundAssignment", "url": "../dmxDatabaseActions/PlayerRoundAssign.php", "data": {"player_id": "{{$FORM.userID}}", "player_handle": "{{$FORM.userHandle}}", "tourney_round_id": "{{$FORM.roundID}}", "tourney_round_title": "{{$FORM.roundTitle}}", "tournament_id": "{{$FORM.tournamentID}}", "game_id": "{{$FORM.GameID}}", "game_title": "{{$FORM.GameTitle}}", "Game_session": "{{$FORM.MatchID}}", "table_id": "{{$FORM.TableID}}"}, "success": "dmxDataBindingsAction('refresh','AssignedPlayers',{});"}
       );
  /* END dmxDatabaseAction name "PlayerRoundAssignment" */
</script>
</body>
</html>