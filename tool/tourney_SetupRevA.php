<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Round Configuration for {Tournament}</title>
<link rel="stylesheet" type="text/css" href="../Styles/dmxTimepicker.css" />
<link rel="stylesheet" type="text/css" href="../Styles/jqueryui/black-tie/black-tie.css" />
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script><script type="text/javascript" src="../ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.ui.slider.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxTimepicker.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
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
/* dmxDataSet name "GameTourneyJoin" */
       jQuery.dmxDataSet(
         {"id": "GameTourneyJoin", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "GameTourneyJoin" */
  /* dmxDataSet name "tournamentRounds" */
       jQuery.dmxDataSet(
         {"id": "tournamentRounds", "url": "dmxDatabaseSources/Tournament_Rounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentRounds" */
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
<script type="text/javascript" src="../ScriptLibrary/dmxServerAction.js"></script>
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
        	<?php include '../Templates/includes/user-navigation.php'; ?>

      <h1 class="center">BattleComm.com Tourney Tool</h1>
  
  
      <h2>Configure Rounds for {{GameTourneyJoin.data[0].tournament_name}}</h2>
      <h3>Configure Rounds and Tables/Sessions. </h3>
      <p># of Rounds: 
        <input name="textfield" type="text" id="textfield" size="4" data-binding-value="{{GameTourneyJoin.data[0].tournament_rounds}}">
Game System: {{GameTourneyJoin.data[0].game_system_Title}}      </p>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <th width="138" scope="col">Name of Round</th>
            <th width="101" scope="col">#Tables/Games</th>
            <th width="138" scope="col">Start Time</th>
            <th width="138" scope="col">End Time</th>
            <th width="138" scope="col">Game System</th>
            <th width="315" scope="col">Notes/Rule Changes</th>
            <th width="69" scope="col">&nbsp;</th>
          </tr>
          <tr style="text-align: center">
            <td><input type="text" name="RoundName" id="RoundName"><input name="tournamentID" type="hidden" id="tournamentID" data-binding-value="{{GameTourneyJoin.data[0].tournament_id}}"></td>
            <td><input name="NumberOfGames" type="text" id="NumberOfGames" size="4" maxlength="4" data-binding-value="{{GameTourneyJoin.data[0].No_of_Games}}"></td>
            <td>&nbsp;
              <input class="dmxTimepicker" name="roundStart" id="roundStart" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#roundStart").dmxTimepicker(
         {"timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}}
       );
     }
 );
  // ]]>
</script></td>
            <td>&nbsp;
              <input class="dmxTimepicker" name="roundEnd" id="roundEnd" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#roundEnd").dmxTimepicker(
         {"timeFormat": "hh:mm", "timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}}
       );
     }
 );
  // ]]>
</script></td>
            <td><input name="GameSystem" type="text" id="GameSystem" data-binding-value="{{GameTourneyJoin.data[0].game_system_Title}}">
            <input name="gameID" type="hidden" id="gameID" data-binding-value="{{GameTourneyJoin.data[0].game_id}}"><input name="adminName" type="hidden" id="adminName" value="<?php echo $_SESSION['svAdminName'];?>"></td>
            <td><textarea name="roundNotes" cols="48" rows="4" id="roundNotes"></textarea></td>
            <td><input name="addRound" type="button" id="addRound" onClick="dmxDatabaseActionControl('run','insertRounds',{},this)" value="Add Round"></td>
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

      <h2>Currently Active Rounds for {{GameTourneyJoin.data[0].tournament_name}}</h2>
      <br/>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <th width="138" scope="col">Name of Round</th>
            <th width="101" scope="col">#Tables/Games</th>
            <th width="138" scope="col">Start Time</th>
            <th width="138" scope="col">End Time</th>
            <th width="138" scope="col">Game System</th>
            <th width="315" scope="col">Notes/Rule Changes</th>
            <th width="69" scope="col">&nbsp;</th>
            <th width="69" scope="col">&nbsp;</th>
            <th width="69" scope="col">&nbsp;</th>
            <th width="69" scope="col">&nbsp;</th>
          </tr>
          <tr style="text-align: center" data-binding-repeat="{{tournamentRounds.data}}" data-binding-id="repeat1">
            <td>{{Round_Title}}
            <input name="roundID" type="hidden" id="roundID" data-binding-value="{{rounds_id}}"></td>
            <td>{{num_participants}}</td>
            <td>{{startTime}}</td>
            <td>{{endTime}}</td>
            <td>{{$FORM.GameSystem}}</td>
            <td>{{notes_rules_changes}}</td>
            <td><a href="playerAssignment_A_3_rev.php?tourney={{GameTourneyJoin.data[0].tournament_id}}&rd={{rounds_id}}">Assign Players </a></td>
            <td><p><a href="playerAssignment_A_2_rev.php?tourney={{GameTourneyJoin.data[0].tournament_id}}&rd={{rounds_id}}">Assign Players/Previous Scores</a></p></td>
            <td><p><a href="tiebreaker_assign.php?tourney={{GameTourneyJoin.data[0].tournament_id}}&rd={{rounds_id}}">Assign Missions/Objectives</a></p></td>
            <td><input name="button" type="button" id="button" onClick="dmxDatabaseActionControl('run','DeleteTournamentRound',{'data':{&quot;rounds_id&quot;: &quot;{{@rounds_id}}&quot;}},this)" value="Delete"></td>
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
             <td>&nbsp;</td>
             <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 
<script type="text/javascript">
  /* dmxDatabaseAction name "insertRounds" */
       jQuery.dmxDatabaseAction(
         {"id": "insertRounds", "url": "dmxDatabaseActions/InsertRounds.php", "data": {"tournament_id": "{{$FORM.tournamentID}}", "adminName": "{{$FORM.adminName}}", "Round_Title": "{{$FORM.RoundName}}", "startTime": "{{$FORM.roundStart}}", "endTime": "{{$FORM.roundEnd}}", "num_participants": "{{$FORM.NumberOfGames}}", "games_id": "{{$FORM.gameID}}", "games_title": "{{$FORM.gameID}}", "notes_rules_changes": "{{$FORM.roundNotes}}"}, "success": "dmxDataBindingsAction('refresh','tournamentRounds',{});"}
       );
  /* END dmxDatabaseAction name "insertRounds" */
  /* dmxDatabaseAction name "DeleteTournamentRound" */
       jQuery.dmxDatabaseAction(
         {"id": "DeleteTournamentRound", "url": "dmxDatabaseActions/deleteRound.php", "data": {"rounds_id": "{{$FORM.roundID}}"}, "success": "dmxDataBindingsAction('refresh','tournamentRounds',{});"}
       );
  /* END dmxDatabaseAction name "DeleteTournamentRound" */
</script>