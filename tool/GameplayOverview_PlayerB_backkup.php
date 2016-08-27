<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="admin_temp.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxSecurityProvider.js"></script>
<script type="text/javascript">
/* dmxSecurityProvider name "dmxSecurityProvider" */
       jQuery.dmxSecurityProvider(
         {"url": "dmxSecurityProviders/dmxSiteSecurity.php", "form": {"username": "", "password": "", "remember": ""}, "modalText": {"title": "Please sign in"}}
       );
  /* END dmxSecurityProvider name "dmxSecurityProvider" */
/* dmxDataSet name "tournamentGame" */
       jQuery.dmxDataSet(
         {"id": "tournamentGame", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentGame" */
  /* dmxDataSet name "ActivePlayer" */
       jQuery.dmxDataSet(
         {"id": "ActivePlayer", "url": "dmxDatabaseSources/activePlayer.php", "data": {"pl": "{{$URL.pl}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "ActivePlayer" */

  /* dmxDataSet name "Rounds" */
       jQuery.dmxDataSet(
         {"id": "Rounds", "url": "dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds" */
  /* dmxDataSet name "opponents" */
       jQuery.dmxDataSet(
         {"id": "opponents", "url": "dmxDatabaseSources/otherPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "gs": "{{$URL.gs}}", "rd": "{{$URL.rd}}", "pl": "{{$URL.pl}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "opponents" */
  /* dmxDataSet name "TiebreakersFiltered" */
       jQuery.dmxDataSet(
         {"id": "TiebreakersFiltered", "url": "dmxDatabaseSources/matchedTiebreakers.php", "data": {"rd": "{{$URL.rd}}", "tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TiebreakersFiltered" */
function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
  }
}
function MM_popupMsg(msg) { //v1.0
  alert(msg);
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
<h3>{{tournamentGame.data[0].tournament_name}} - Round &quot;{{Rounds.data[0].Round_Title}} &quot; Game: {{ActivePlayer.data[0].Game_session}}- {{Rounds.data[0].startTime.formatDate( "HH:mm a" )}} - {{Rounds.data[0].endTime.formatDate( "HH:mm a" )}}</h3>
<p>You are currently signed in as {{ActivePlayer.data[0].player_handle}}</p>
<p><strong>Game Info:<br></strong></p>
<p>{{ActivePlayer.data[0].table_id}}-- {{ActivePlayer.data[0].player_handle}} vs. {{opponents.data[0].player_handle}}</p>
<p>Game System: {{tournamentGame.data[0].game_system_Title}}</p>
<p>Notes or Addendum: {{Rounds.data[0].notes_rules_changes}}</p>
<p>Tiebreakers/Missions for Round {{Rounds.data[0].Round_Title}}</p>
<table width="593" border="1">
  <tbody>
    <tr>
      <td><strong>Tiebreaker Title</strong></td>
      <td><strong>Tiebreaker  Points</strong></td>
    </tr>
    <tr data-binding-repeat="{{TiebreakersFiltered.data}}" data-binding-id="repeat1">
      <td>{{mission_name}}</td>
      <td>{{tiebreaker_points}}</td>
    </tr>
  </tbody>
</table>
<p>Upon completion of the Game - Fill out the following for submission to the Tournament Organizer for review.</p>
<p>************************Results for {{Rounds.data[0].Round_Title}} Player: {{ActivePlayer.data[0].player_handle}}********************</p>
<p>Choose the outcome of the Game:<br>
</p><form action="" method="post" name="player_results_submit" id="player_results_submit">
<table width="200" border="1">
  <tbody>
    <tr>
      <td>Outcome</td>
      <td>Points</td>
      </tr>
    <tr>
      <td>Win</td>
      <td>{{tournamentGame.data[0].WinPointValue}}</td>
      </tr>
    <tr>
      <td>Draw</td>
      <td>{{tournamentGame.data[0].drawPointValue}}</td>
      </tr>
    <tr>
      <td>Loss</td>
      <td>{{tournamentGame.data[0].lossPointValue}}</td>
      </tr>
  </tbody>
</table>
<p>{{ActivePlayer.data[0].player_handle}} 
  <?php $outcome=" ";  $out_points="0"; ?>
<select id="outcome" name="outcome">
  <option value="nada">Chose Outcome</option>
  <option value="win">Win</option>
  <option value="draw">Draw</option>
  <option value="loss">Loss</option>
</select>
 <!--<label>
   <br>
   <input type="radio" name="outcome" value="win" id="outcome_0">
   Win</label>
 <br>
 <label>
   <input type="radio" name="outcome" value="draw" id="outcome_1">
   Draw</label>
 <br>
 <label>
   <input type="radio" name="outcome" value="loss" id="outcome_2">
   Loss</label>-->
 <br><?php echo $outcome; ?>
<?php 
	
if(isset($_POST['submit']) && ($_POST['outcome'] != "nada"))
{
   $outcome=$_POST['outcome'];
}
?><?php if ($outcome=='win'){
	$out_points="{{tournamentGame.data[0].WinPointValue}}";}
	elseif ($outcome=='draw'){
		$out_points="{{tournamentGame.data[0].drawPointValue}}";}
	else {
		$out_points="{{tournamentGame.data[0].lossPointValue}}";} 
       ?>
	   <p>:
<input name="gamepoints" id="gamepoints" type="hidden" form="player_results_submit" value="<?php echo $out_points; ?>">
  </p>
  <p>Check the box for each mission you <strong>completed</strong>. </p>
<table width="575" border="1">
  <tbody>
    <tr>
      <td>Tiebreaker Title</td>
      <td>Points</td>
      <td>&nbsp;</td>
    </tr>
    <tr data-binding-repeat="{{TiebreakersFiltered.data}}" data-binding-id="repeat2">
      <td>{{mission_name}}</td>
      <td>{{tiebreaker_points}}</td>
      <td><input name="tiebreaker[]" type="checkbox" id="tiebreaker[]" value="{{tiebreaker_points}}"></td>
    </tr>
  </tbody>
</table>
<?php 
			$tievalue = 0;
			if (is_array($tievalue)){
			$tievalue = array_sum ($_POST['tiebreaker']);
			}
			echo $tievalue;
?>
<input name="totalTieBreakerPoints" type="hidden" id="totalTieBreakerPoints" value="<?php echo $tievalue; ?>">
<p>Do you have any comments or any information to share about this match?</p>
<p>
  <textarea name="notes_comments" cols="50" rows="8" id="notes_comments"></textarea>
  <br>
</p>
<p>Once you submit this form , you acknowledge that the information you are submitting is correct as far as you know and that you and the other participant(s) in this game agree on this outcome. The submissions of all players will be reviewed by the TO and final points will be awarded once the TO confirms the submission and approves it.
  <input name="userID" type="hidden" id="userID" value="{{ActivePlayer.data[0].tourney_game_player_id}}">
</p>
<p>
  <input name="submit" type="submit" id="submit" formmethod="POST" onClick="dmxDatabaseActionControl('run','updatePlayer',{},this);MM_changeProp('submitted','','display','inline','DIV')" value="Submit">
</p> </form>
<p>&nbsp;</p> 

<script type="text/javascript">
  /* dmxDatabaseAction name "updatePlayer" */
       jQuery.dmxDatabaseAction(
         {"id": "updatePlayer", "url": "dmxDatabaseActions/updateplayer.php", "data": {"game_result": "{{$FORM.outcome}}", "game_points": "{{$FORM.gamepoints}}", "mission_points": "{{$FORM.tiebreaker[0]}}", "total_points": "{{$FORM.gamepoints}}", "Notes_comments": "{{$FORM.notes_comments}}", "tourney_game_player_id": "{{$FORM.userID}}"}, "success": "dmxDataBindingsAction('refresh','ActivePlayer',{});MM_changeProp('submitted','','display','inline','DIV');", "error": "MM_popupMsg('Problem.');"}
       );
  /* END dmxDatabaseAction name "updatePlayer" */
</script>
<div class="submitted" id="submitted" style="display:inline">
  <p>Your information has been submitted. <br>
    <br>
Outcome: <?php echo $outcome ?><br>
Game Points  <?php echo $out_points; ?><br>
TieBreaker Points: <?php echo $tievalue; ?> <br>
Notes: {{ActivePlayer.data[0].Notes_comments}}<br>
  </p>
</div>
<p><?php include("nav.php"); ?></p>
</body>
</html>