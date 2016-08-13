<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="application/javascript" src="js/formvar.js"></script>
<script type="text/javascript">
/* dmxDataSet name "tourneyGame" */
       jQuery.dmxDataSet(
         {"id": "tourneyGame", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tourneyGame" */
  /* dmxDataSet name "player" */
       jQuery.dmxDataSet(
         {"id": "player", "url": "dmxDatabaseSources/activePlayer.php", "data": {"pl": "{{$URL.pl}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "player" */

  /* dmxDataSet name "Rounds_filtered" */
       jQuery.dmxDataSet(
         {"id": "Rounds_filtered", "url": "dmxDatabaseSources/filteredRounds.php", "data": {"rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds_filtered" */

  /* dmxDataSet name "tiebreakers" */
       jQuery.dmxDataSet(
         {"id": "tiebreakers", "url": "dmxDatabaseSources/matchedTiebreakers.php", "data": {"rd": "{{$URL.rd}}", "tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tiebreakers" */
  /* dmxDataSet name "opponents" */
       jQuery.dmxDataSet(
         {"id": "opponents", "url": "dmxDatabaseSources/otherPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "gs": "{{$URL.gs}}", "pl": "{{$URL.pl}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "opponents" */
/* dmxDataSet name "playerRecord" */
       jQuery.dmxDataSet(
         {"id": "playerRecord", "url": "dmxDatabaseSources/PlayerResult.php", "data": {"pr": "{{$URL.pr}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "playerRecord" */
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
function MM_popupMsg(msg) { //v1.0
  alert(msg);
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
<p>{{tourneyGame.data[0].tournament_name}}- Round {{Rounds_filtered.data[0].Round_Title}}</p>
<p>You are signed in as: {{player.data[0].player_handle}}-{{player.data[0].tourney_game_player_id}}</p>
<p>{{Rounds_filtered.data[0].startTime}}- {{Rounds_filtered.data[0].endTime}}</p>
<p>Game: {{player.data[0].Game_session}}</p>
<p>Table: {{player.data[0].player_handle}} vs {{opponents.data[0].player_handle}}</p>
<p>{{player.data[0].tourney_game_player_id}}</p>
<p>Game: {{tourneyGame.data[0].game_system_Title}}<br>
      Win: {{tourneyGame.data[0].WinPointValue}}points<br>
      Loss: {{tourneyGame.data[0].lossPointValue}}points<br>
      Draw:
   {{tourneyGame.data[0].drawPointValue}}points<br>
  <br>
Tiebreakers/Missions:</p>
<div data-binding-id="repeat1" data-binding-repeat="{{tiebreakers.data}}">{{mission_name}} - {{tiebreaker_points}}points</div>
<form name="scoreSubmit" method="post" action=""><p>************Game Results from {{player.data[0].player_handle}}*******************
  <input name="pl" type="hidden" id="pl" data-binding-value="{{player.data[0].player_id}}">
</p>
  <p>Outcome for {{player.data[0].player_handle}} <br>
    <label>
      <input type="radio" name="GameOutcome" value="Win" id="GameOutcome_0">
      Win</label>
    <br>
    <label>
      <input type="radio" name="GameOutcome" value="Loss" id="GameOutcome_1">
      Loss</label>
    <br>
    <label>
      <input type="radio" name="GameOutcome" value="Draw" id="GameOutcome_2">
      Draw</label>
    			<?PHP
			if ($_POST) {
			$selected_radio = $_POST['GameOutcome'];
			echo "<strong>$selected_radio</strong>";
			}
			?>
    <br>
  </p>
  <div data-binding-id="repeat2" data-binding-repeat="{{tiebreakers.data}}">
    <p>
      <input type="checkbox" name="TieBreakers" value="{{tiebreaker_points}}" id="TieBreakers_0">
      {{mission_name}}
      -
    points</p>
    
</div>
  <p><br>
   <label>
      <input name="submit" type="submit" id="submit" formmethod="POST" onClick="dmxDatabaseActionControl('run','updatePlayer',{'data':{&quot;pl&quot;: &quot;{{@player.data[0].player_id}}&quot;}},this)" value="Submit">
</label> <br></form
  > 
<p>Submitted Score:<?php echo "$selected_radio"; ?> <br>
  Game Points: {{playerRecord.data[0].game_points}}<br>
Tiebreaker Points: {{playerRecord.data[0].mission_points}}<br>
______________</p>
<p>Total Points: </p>
<script type="text/javascript">
  /* dmxDatabaseAction name "updatePlayer" */
       jQuery.dmxDatabaseAction(
         {"id": "updatePlayer", "url": "dmxDatabaseActions/updateplayer.php", "data": {"game_result": "", "Game_info": "", "game_points": "{{$FORM.game_result}}", "mission_points": "{{$FORM.TieBreakers}}", "total_points": ""}, "success": "dmxDataBindingsAction('refresh','playerRecord',{});", "error": "MM_popupMsg('Whoops');"}
       );
  /* END dmxDatabaseAction name "updatePlayer" */
  </script>
</body>
</html>