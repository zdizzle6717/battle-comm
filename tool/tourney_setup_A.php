<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Configure {{tournament.data[0].tournament_name}}</title>
<link rel="stylesheet" type="text/css" href="Styles/dmxTimepicker.css" />
<link rel="stylesheet" type="text/css" href="Styles/jqueryui/redmond/redmond.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/jquery.ui.slider.js"></script>
<script type="text/javascript" src="ScriptLibrary/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxTimepicker.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "tournament" */
       jQuery.dmxDataSet(
         {"id": "tournament", "url": "dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament" */
  /* dmxDataSet name "game_filtered" */
       jQuery.dmxDataSet(
         {"id": "game_filtered", "url": "dmxDatabaseSources/gameSystem_filtered.php", "data": {"gs": "{{$URL.gs}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "game_filtered" */

  /* dmxDataSet name "games_full" */
       jQuery.dmxDataSet(
         {"id": "games_full", "url": "dmxDatabaseSources/gamesList.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "games_full" */

  /* dmxDataSet name "rounds" */
       jQuery.dmxDataSet(
         {"id": "rounds", "url": "dmxDatabaseSources/Rounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "rounds" */
  /* dmxDataSet name "tournamentRounds" */
       jQuery.dmxDataSet(
         {"id": "tournamentRounds", "url": "dmxDatabaseSources/Tournament_Rounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentRounds" */
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
<h2>Configure Rounds for {{tournament.data[0].tournament_name}}</h2>
<p><?php include('nav.php'); ?></p>

<h3>Configure Rounds and Tables/Sessions</h3>
<p>#of Rounds: <input name="numRounds" type="text" id="numRounds" size="4" maxlength="4" data-binding-value="{{tournament.data[0].tournament_rounds}}">
Game System: {{game_filtered.data[0].game_system_Title}}</p>
<p>&nbsp;</p><form action="" method="post" name="rounds_sumbit" id="rounds_sumbit">
<table width="936" border="1">
  <tr>
    <th width="144" scope="col">Name of Round</th>
    <th width="104" scope="col">#Tables/Games</th>
    <th width="144" scope="col">Start Time</th>
    <th width="144" scope="col">End Time</th>
    <th width="144" scope="col">Game System</th>
    <th width="216" scope="col">Notes/Rule Changes</th>
  </tr>
  <tr align="center" valign="top">
    <td><input name="roundTitle" type="text" id="roundTitle">
      <input name="tournamentID" type="hidden" id="tournamentID" data-binding-value="{{tournament.data[0].tournament_id}}">      &nbsp;</td>
    <td><input name="noTables" type="text" id="noTables" size="4" maxlength="4" data-binding-value="{{tournament.data[0].No_of_Games}}"></td>
    <td><input class="dmxTimepicker" name="RoundStartTime" id="RoundStartTime" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#RoundStartTime").dmxTimepicker(
         {"ampm": true, "timezone": "", "showButtonPanel": true, "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}}
       );
     }
 );
  // ]]>
</script></td>
    <td><input class="dmxTimepicker" name="RoundsEndTime" id="RoundsEndTime" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#RoundsEndTime").dmxTimepicker(
         {"ampm": true, "timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}}
       );
     }
 );
  // ]]>
</script></td>
    <td><input name="game_system" type="text" id="game_system" data-binding-value="{{game_filtered.data[0].game_system_Title}}"><br>
    <span class="editSpan">[Change Game]</span></td>
    <td><textarea name="RoundNotes" id="RoundNotes">&nbsp;</textarea></td>
  </tr>
  <tr>
    <td><input name="submit_round" type="button" id="submit_round" onClick="dmxDatabaseActionControl('run','insertRounds',{},this)" value="Insert Round"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>
<h3>Currently Active Rounds for {{tournament.data[0].tournament_name}}</h3>
<table width="800" border="1">
  <tr>
    <th scope="col">Name of Round</th>
    <th scope="col">#Tables/Games</th>
    <th scope="col">Start Time</th>
    <th scope="col">End Time</th>
    <th scope="col">Game System</th>
    <th scope="col">Notes/Rule Changes</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
 <tr data-binding-repeat="{{tournamentRounds.data}}" data-binding-id="repeat1">
    <td>{{Round_Title}}</td>
    <td>{{num_participants}}</td>
    <td>{{startTime}}</td>
    <td>{{endTime}}</td>
    <td>{{game_filtered.data[0].game_system_Title}}</td>
    <td>{{notes_rules_changes}}</td>
    <td><a href="playerAssignment_new.php?tourney={{tournament_id}}&rd={{rounds_id}}">Register Players </a></td>
    <td><a href="tiebreaker_setup_A.php?tourney="{{tournament_id}}"&rd="{{rounds_id}}">Configure Tiebreakers/Missions</a></td>
  </tr>
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
</table>
<p><a href="tiebreaker_setup_A.php?tourney={{tournament.data[0].tournament_id}}">&gt;&gt;Configure/Add Missions/Tiebreakers&gt;&gt;</a></p>
<p>&nbsp; </p>
<script type="text/javascript">
  /* dmxDatabaseAction name "insertRounds" */
       jQuery.dmxDatabaseAction(
         {"id": "insertRounds", "url": "dmxDatabaseActions/InsertRounds.php", "data": {"tournamentID": "{{$FORM.tournamentID}}", "roundTitle": "{{$FORM.roundTitle}}", "roundStartTime": "{{$FORM.RoundStartTime}}", "RoundsEndTime": "{{$FORM.RoundsEndTime}}", "noTables": "{{$FORM.noTables}}", "game_system": "{{$FORM.game_system}}", "games_title": "", "RoundNotes": "{{$FORM.RoundNotes}}"}, "success": "dmxDataBindingsAction('refresh','tournamentRounds',{});"}
       );
  /* END dmxDatabaseAction name "insertRounds" */
  </script>
</body>
</html>