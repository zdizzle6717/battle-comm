<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Assign Rounds</title>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<link rel="stylesheet" type="text/css" href="../Styles/dmxNotify.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxNotify.js"></script>
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
/* dmxDataSet name "news" */
       jQuery.dmxDataSet(
         {"id": "news", "url": "../../dmxDatabaseSources/news.php", "data": {"sort": "news_date_published", "limit": "3"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "news" */

  /* dmxDataSet name "Tournament" */
       jQuery.dmxDataSet(
         {"id": "Tournament", "url": "../dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Tournament" */

  /* dmxDataSet name "Round(Filtered)" */
       jQuery.dmxDataSet(
         {"id": "Round(Filtered)", "url": "../dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Round(Filtered)" */

  /* dmxDataSet name "Rounds_Filtered" */
       jQuery.dmxDataSet(
         {"id": "Rounds_Filtered", "url": "../dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds_Filtered" */
  /* dmxDataSet name "Round_players" */
       jQuery.dmxDataSet(
         {"id": "Round_players", "url": "../dmxDatabaseSources/Rounds_Players.php", "data": {"rd": "{{$URL.rd}}", "limit": "1000"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Round_players" */
/* dmxDataSet name "tournamentPlayers" */
       jQuery.dmxDataSet(
         {"id": "tournamentPlayers", "url": "../dmxDatabaseSources/tournamentPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
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
function dmxNotifyAction() {   //ver 1.00
  if (arguments && arguments.length > 0) {
    if(typeof arguments[0] == 'object'){
      jQuery.dmxNotify(arguments[0]);
    }else if(arguments[0] === 'closeAll'){
       jQuery.dmxNotify.closeAll();
    }
  }
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

      <h2>Manual Round Scoring</h2>
      <p>Manual Scoring for {{Tournament.data[0].tournament_name}}/{{Rounds_Filtered.data[0].Round_Title}}</p>
 
    <p>Instructions (blah blah).</p>  <br>
      <span class="bg-danger"><strong>**Warning** Using this on already scored rounds could cause that data to be overwritten**</strong></span>
      <p>Total Players: {{Round_players.total}}
      
      <table width="95%" border="1" >
        <tbody>
          <tr>
            <th scope="col">Handle</th>
            <th scope="col">Round</th>
            <th scope="col">Match</th>
            <th scope="col">Table </th>
            <th scope="col">Outcome</th>
            <th scope="col">Game Points</th>
            <th scope="col">Mission Points</th>
            <th scope="col">Notes</th>
            <th scope="col">Total Round Score</th>
            <th scope="col"><p>Total Tournament Score</p></th>
            <th scope="col">&nbsp;</th>
          </tr>
          <tr data-binding-repeat="{{Round_players.data}}" data-binding-id="repeat1">
            <th scope="col">{{player_handle}}</th>
            <th scope="col">                  {{tourney_round_id}}</th>
            <th scope="col">{{Game_session}}</th>
            <th scope="col">{{table_id}}</th>
            <th scope="col">{{game_result}}</th>
            <th scope="col">{{game_points}}</th>
            <th scope="col">{{mission_points}}</th>
            <th scope="col">{{Notes_comments}}</th>
            <th scope="col">{{total_points}}</th>
            <th scope="col"><div data-binding-html="{{totalScore}}">{{totalScore}}</div></th>
            <th scope="col"><a href="#" class="btn-link" onClick="dmxDataBindingsAction('selectCurrent','repeat1',this)">Edit Results</a></th>
          </tr>
          <tr>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
            <th scope="col">&nbsp;</th>
          </tr>
          <tr>
            <th colspan="10" scope="col"><div class="RoundEdit" id="RoundEdit" data-binding-detail="repeat1" data-binding-id="RoundEdit">
              <table width="95%" border="1">
                <tbody>
                  <tr>
                    <td width="2%">&nbsp;</td>
                    <td width="16%">Outcome</td>
                    <td width="21%">Game Points</td>
                    <td width="30%">Mission Points</td>
                    <td width="16%">Notes</td>
                    <td width="15%">Total Round Score</td>
                    <td width="15%">Total Tournament Score</td>
                    <td width="0%">&nbsp;</td> 
                    </tr>
                  <tr>
                    <td><input name="tourney_game_id" type="hidden" id="tourney_game_id" value="{{tourney_game_player_id}}">
                    <input name="tournamentPlayersID" type="hidden" id="tournamentPlayersID" value="{{tournament_players_id}}">{{player_handle}}
                      <input name="playerID" type="text" id="playerID" value="{{tourney_players_id}}" size="3" maxlength="4"></td>
                    <td><select name="ChooseOutcome" id="ChooseOutcome" title="ChooseOutcome">
                      <option value="win">Win</option>
                      <option value="draw">Draw</option>
                      <option value="loss">Loss</option>
                      <option selected>Choose Outcome...</option>
                    </select></td>
                    <td><input name="GamePoints" type="text" id="GamePoints" value="{{game_points}}" size="4" maxlength="4"></td>
                    <td><input name="MissionPoints" type="text" id="MissionPoints" value="{{mission_points}}" size="4" maxlength="4"></td>
                    <td><textarea name="notes" id="notes"></textarea></td>
                    <td><input name="TotalScore" type="text" id="TotalScore" value="{{total_points}}" size="4" maxlength="4"></td>
                    <td><input name="totalTournamentScoreUpdated" type="text" id="totalTournamentScoreUpdated" value="{{totalScore}}" size="4" maxlength="4"></td>
                    <td><input name="UpdateScore" type="submit" id="UpdateScore" formmethod="POST" onClick="dmxDatabaseActionControl('run','UpdateRoundScores',{'data':{&quot;tourney_game_player_id&quot;: &quot;{{@tourney_game_player_id}}&quot;}},this)" value="Update Score"></td>
                    </tr>
                </tbody>
            </table>
            </div>
            </th>
            <th scope="col">&nbsp;</th>
          </tr>
        </tbody>
      </table>

<div id="updateDetal" class="updateDetail">
<table width="95%" border="0">
  <tbody>
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
    </tr>
  </tbody>
</table>
</div>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 
<script type="text/javascript">
  /* dmxDatabaseAction name "UpdateRoundScores" */
       jQuery.dmxDatabaseAction(
         {"id": "UpdateRoundScores", "url": "../dmxDatabaseActions/updateRoundResults.php", "data": {"tourney_game_player_id": "{{$FORM.tourney_game_id}}", "game_result": "{{$FORM.ChooseOutcome}}", "Game_info": "", "game_points": "{{$FORM.GamePoints}}", "mission_points": "{{$FORM.MissionPoints}}", "total_points": "{{$FORM.TotalScore}}", "Notes_comments": "{{$FORM.textarea}}", "tourney_game_id": "{{$FORM.tourney_game_id}}"}, "success": "dmxDataBindingsAction('refresh','Round_players',{});dmxDatabaseActionControl('run','updateTournamentPlayers',{},this);"}
       );
  /* END dmxDatabaseAction name "UpdateRoundScores" */
  /* dmxDatabaseAction name "updateTournamentPlayers" */
       jQuery.dmxDatabaseAction(
         {"id": "updateTournamentPlayers", "url": "../dmxDatabaseActions/updateTournamentPlayers.php", "data": {"totalScore": "{{$FORM.totalTournamentScoreUpdated}}", "tournament_players_id": "{{$FORM.tournamentPlayersID}}"}, "success": "dmxDataBindingsAction('refresh','Round_players',{});dmxNotifyAction({\"positionClass\": \"toast-top-full-width\", \"title\": \"Round Scoring has been Updated\", \"msg\": \"Blah blah more info more info blah blah blah\", \"timeOut\": 8000, \"extendedTimeOut\": 2000});"}
       );
  /* END dmxDatabaseAction name "updateTournamentPlayers" */
</script>
