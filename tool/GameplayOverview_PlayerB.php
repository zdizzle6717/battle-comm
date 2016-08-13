<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="admin_temp.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxSecurityProvider.js"></script>
<?php $out_points=0; ?>
<script type="text/javascript">
  /* dmxDataSet name "tournamentGame" */
       jQuery.dmxDataSet(
         {"id": "tournamentGame", "url": "../dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentGame" */
  /* dmxDataSet name "ActivePlayer" */
       jQuery.dmxDataSet(
         {"id": "ActivePlayer", "url": "../dmxDatabaseSources/activePlayer.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "ActivePlayer" */

  /* dmxDataSet name "Rounds" */
       jQuery.dmxDataSet(
         {"id": "Rounds", "url": "dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds" */
  /* dmxDataSet name "opponents" */
       jQuery.dmxDataSet(
         {"id": "opponents", "url": "../dmxDatabaseSources/otherPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "opponents" */
  /* dmxDataSet name "TiebreakersFiltered" */
       jQuery.dmxDataSet(
         {"id": "TiebreakersFiltered", "url": "dmxDatabaseSources/matchedTiebreakers.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TiebreakersFiltered" */

function MM_popupMsg(msg) { //v1.0
  alert(msg);
}

function MM_changeProp(objId,x,theProp,theValue) { //v9.0
  var obj = null; with (document){ if (getElementById)
  obj = getElementById(objId); }
  if (obj){
    if (theValue == true || theValue == false)
      eval("obj.style."+theProp+"="+theValue);
    else eval("obj.style."+theProp+"='"+theValue+"'");
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
      <h2>{{tournamentGame.data[0].tournament_name}} - Round &quot;{{Rounds.data[0].Round_Title}} &quot; Game: {{ActivePlayer.data[0].Game_session}}- {{Rounds.data[0].startTime.formatDate( "HH:mm a" )}} - {{Rounds.data[0].endTime.formatDate( "HH:mm a" )}}</h2>
      <p>You are currently signed in as {{ActivePlayer.data[0].player_handle}}</p>
      <p><strong>Game Info:<br>
      </strong></p>
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
      <p>&nbsp;</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Results for {{Rounds.data[0].Round_Title}} Player: {{ActivePlayer.data[0].player_handle}}</h2>
      <p>Choose the outcome of the Game:<br>
      </p>
      <form action="" method="post" name="player_results_submit" id="player_results_submit">
      <table width="200" border="1">
        <tbody>
          <tr>
            <td>Outcome</td>
            <td>Points</td>
            <td>Select</td>
          </tr>
          <tr>
            <td>Win</td>
            <td>{{tournamentGame.data[0].WinPointValue}}</td>
            <td><input type="radio" name="game_outcome" id="radio" value="win"></td>
          </tr>
          <tr>
            <td>Draw</td>
            <td>{{tournamentGame.data[0].drawPointValue}}</td>
            <td><input type="radio" name="game_outcome" id="radio" value="draw"></td>
          </tr>
          <tr>
            <td>Loss</td>
            <td>{{tournamentGame.data[0].lossPointValue}}</td>
            <td><input type="radio" name="game_outcome" id="radio" value="loss"></td>
          </tr>
        </tbody>
      </table>
      <p>{{ActivePlayer.data[0].player_handle}}
        <?php $outcome=" ";  $out_points="0"; $game_total=0; ?>
       <!--<p> <select name="outcome" class="form-group-sm" id="outcome">
          <option value="nada">Chose Outcome</option>
          <option value="win">Win</option>
          <option value="draw">Draw</option>
          <option value="loss">Loss</option>
        </select></p>
        -->
        <br>
        <input name="Input_win_points" type="hidden" id="Input_win_points" value="{{tournamentGame.data[0].WinPointValue.toNumber( )}}" data-binding-value="{{tournamentGame.data[0].WinPointValue.toNumber( )}}">
        <?php
			$win_points=0;
			$draw_points=0;
			$loss_points=0;
			$win_int=0;
			
			$win_points = $_POST['Input_win_points'];
			$win_int = $win_points;
			$win_math= $win_points + $win_points;
		    ?>
      <p>Win Points: <?php echo $win_points; ?><br />
      Win Points (as int): <?php echo $win_int; ?> <br />
			$win_points: <?php echo gettype($win_points);  ?><br />
            $win_int: <?php echo gettype($win_int); ?><br /> 
            $win_math: <?php echo gettype($win_math); ?> <?php echo $win_math; ?>   
        </p>
        
         <?php 
	
if(isset($_POST['submit']) && ($_POST['game_outcome']))
{
   $outcome=$_POST['game_outcome'];
}
?>
        <?php if ($outcome=='win'){
	$out_points="{{tournamentGame.data[0].WinPointValue}}";}
	elseif ($outcome=='draw'){
		$out_points="{{tournamentGame.data[0].drawPointValue}}";}
	else {
		$out_points="{{tournamentGame.data[0].lossPointValue}}";} 
       ?>
       <?php $sub_out_points= $out_points; ?>
        <?php echo $outcome; ?> | <?php echo $sub_out_points; ?>
       
      <p>:
        <input name="gamepoints" type="hidden" class="form-control" id="gamepoints" form="player_results_submit" value="<?php echo $sub_out_points; ?>"><?php echo gettype($sub_out_points); ?>
      </p>
      **********************************************************************<br />
      Game Points: <?php echo bin2hex($out_points); ?><br />
      <?php
	  			$int_swap_out_points = (int)$out_points;
				?>
      Game Points 2: <?php var_dump($int_swap_out_points); ?><br/>
      <?php
	  			$math_swap_out_points = $out_points * "1"; 
	  ?>
      Game Points 3: <?php var_dump($math_swap_out_points); ?><br/>
      *************************************************************************
      <p>Total Points: <?php echo $sub_out_points; ?></p>
      <p>Check the box for each mission you <strong>completed</strong>. </p>
      <table width="575" border="1">
        <tbody>
          <tr>
            <td>Tiebreaker Title</td>
            <td>Points</td>
            <td>&nbsp;</td>
          </tr>
          <tr data-binding-repeat="{{TiebreakersFiltered.data}}" data-binding-id="repeat2">
            <td>{{mission_name}}-({{tiebreaker_points}})</td>
            <td>{{tiebreaker_points}}</td>
            <td><input name="tiebreaker[]" type="checkbox" id="tiebreaker[]" value="{{tiebreaker_points}}"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>Total Points</td>
            <td> <?php
	$tiebreakerTotal = 0;
	$tiepoints=0;
	if(isset($_POST['submit'])){
		if(!empty($_POST['tiebreaker'])){
			foreach($_POST['tiebreaker'] as $tiepoints){
				$tiebreakerTotal += $tiepoints;}	
			
		}
		
		
	}
		echo $tiebreakerTotal;
?>&nbsp;</td>
          </tr>
        </tbody>
      </table>
     
      <input name="totalTieBreakerPoints" type="hidden" class="form-control" id="totalTieBreakerPoints" value="<?php echo $tiebreakerTotal; ?>">
      <p>Do you have any comments or any information to share about this match?</p>
      <p>
        <textarea name="notes_comments" cols="50" rows="8" class="form-control" id="notes_comments"></textarea>
        <br>
      </p>
      <p>Once you submit this form , you acknowledge that the information you are submitting is correct as far as you know and that you and the other participant(s) in this game agree on this outcome. The submissions of all players will be reviewed by the TO and final points will be awarded once the TO confirms the submission and approves it.
        <input name="userID" type="hidden" class="form-control" id="userID" value="{{ActivePlayer.data[0].tourney_game_player_id}}">
      </p>
      <p>
        <input name="submit" type="submit" class="bg-primary" id="submit" formmethod="POST" onClick="dmxDatabaseActionControl('run','updatePlayer',{},this);MM_changeProp('submitted','','display','inline','DIV')" value="Generate Results">
      </p></form>
      <p>&nbsp;</p>
      <script type="text/javascript">
  /* dmxDatabaseAction name "updatePlayer" */
       jQuery.dmxDatabaseAction(
         {"id": "updatePlayer", "url": "../dmxDatabaseActions/updateplayer.php", "data": {"game_result": "{{$FORM.outcome}}", "game_points": "{{$FORM.gamepoints}}", "mission_points": "{{$FORM.tiebreaker[0]}}", "total_points": "{{$FORM.gamepoints}}", "Notes_comments": "{{$FORM.notes_comments}}", "tourney_game_player_id": "{{$FORM.userID}}"}, "success": "dmxDataBindingsAction('refresh','ActivePlayer',{'data':{\"tourney\": \"{{@$URL.tourney}}\", \"rd\": \"{{@$URL.rd}}\"}});MM_changeProp('submitted','','display','inline','DIV');", "error": "MM_popupMsg('Problem.');"}
       );
  /* END dmxDatabaseAction name "updatePlayer" */
      </script>
      <?php
	  			$game_total=0;
	  			$missionPoints=$tiebreakerTotal;
				$totalgamepoints=intval($out_points);
				$game_total= $tiebreakerTotal + intval($out_points); 
	 ?>
      <div class="submitted" id="submitted2" style="display:inline">
        <p>This is the information you will be submitting.<br>
          <br>
          
          Outcome: <?php echo $outcome ?> <input name="gameResult" type="hidden" id="gameResult" value="<?php echo $outcome ?>"><br>
          Game Points <?php echo $out_points; ?><input name="GamePoints" type="hidden" id="gamePoints" value="<?php echo $out_points; ?>"><br>
          TieBreaker Points: <?php echo $tiebreakerTotal; ?><input name="MissionPoints" type="hidden" id="MissionPoints" value="<?php echo $tiebreakerTotal; ?>"> <br>
          TotalGame Points: <?php echo $game_total; ?>
        </p>
        <p>Notes: {{$FORM.notes_comments}}</p>
        <p>****Testing Varialbe Output****</p>
        $tiebreaker= <?php echo gettype($tiebreakerTotal); ?><br />
        $out_points= <?php echo gettype($out_points); ?><br />
        $missionpoints= <? echo gettype($missionPoints);?> <br />
        $totalgamepoints= <? echo gettype($totalgamepoints); ?> <br />
        $game_total= <? echo gettype($game_total); ?><br />
        $tiebreakerTotal =<? echo gettype($tiebreakerTotal);?> <?php echo $tiebreakerTotal;?><br />
        $outcome = <?php echo gettype($outcome);?> $outcome:<?php echo $outcome; ?><br />
        <p>If you approve of the above data and it is correct. Press Submit.</p>
        <p>
          <input name="button" type="submit" class="bg-primary" id="button" onClick="dmxDatabaseActionControl('run','updatePlayer',{},this)" value="Submit">
        </p>
        <p><strong>Updated Results</strong><br>
        </p>
        <table width="50%" border="1">
          <tbody>
            <tr>
              <th width="26%" scope="row">Handle</th>
              <td width="74%">{{ActivePlayer.data[0].player_handle}}</td>
            </tr>
            <tr>
              <th scope="row">Round</th>
              <td>{{ActivePlayer.data[0].tourney_round_title}}</td>
            </tr>
            <tr>
              <th scope="row">Match</th>
              <td>{{ActivePlayer.data[0].Game_session}}</td>
            </tr>
            <tr>
              <th scope="row">Table</th>
              <td>{{ActivePlayer.data[0].table_id}}</td>
            </tr>
            <tr>
              <th scope="row">Result</th>
              <td>{{ActivePlayer.data[0].game_result}}</td>
            </tr>
            <tr>
              <th scope="row">Mission Points</th>
              <td>{{ActivePlayer.data[0].mission_points}}</td>
            </tr>
            <tr>
              <th scope="row">Game Points</th>
              <td>{{ActivePlayer.data[0].game_points}}</td>
            </tr>
            <tr>
              <th scope="row">Total Points</th>
              <td>{{ActivePlayer.data[0].total_points}}</td>
            </tr>
            <tr>
              <th scope="row">Notes</th>
              <td>{{ActivePlayer.data[0].Notes_comments}}</td>
            </tr>
            <tr>
              <th scope="row">Approved</th>
              <td>{{ActivePlayer.data[0].results_approved}}</td>
            </tr>
          </tbody>
        </table>
        <p>&nbsp; </p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>Heading</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
    <div class="col-lg-6">
      <h2>Heading</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
<h3>&nbsp;</h3>
<p><br>
</p>

<p><?php include("nav.php"); ?></p>
</div>
</body>
</html>