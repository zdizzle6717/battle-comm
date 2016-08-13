<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Configure Tiebreakers</title>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "tournament" */
       jQuery.dmxDataSet(
         {"id": "tournament", "url": "dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament" */
  /* dmxDataSet name "Rounds" */
       jQuery.dmxDataSet(
         {"id": "Rounds", "url": "dmxDatabaseSources/Rounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds" */
  /* dmxDataSet name "tiebreakersFull" */
       jQuery.dmxDataSet(
         {"id": "tiebreakersFull", "url": "dmxDatabaseSources/tiebreakers_Full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tiebreakersFull" */
  /* dmxDataSet name "matchedTiebreakers" */
       jQuery.dmxDataSet(
         {"id": "matchedTiebreakers", "url": "dmxDatabaseSources/matchedTiebreakers.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "matchedTiebreakers" */
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
<link href="admin_temp.css" rel="stylesheet" type="text/css">
</head>

<body>
<p>
<?php include('nav.php'); ?>
</p>

<h3>Configure Tiebreakers/Missions for {{tournament.data[0].tournament_name}}</h3>

<p>

Content

</p><form action="" method="post" name="tiebreaker" id="tiebreaker">
<table width="800" border="1">
  <tr>
    <th width="293" scope="col">Round</th>
    <th width="491" scope="col">Tiebreaker/Mission Name</th>
    <th width="491" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td><select name="match_name" id="match_name" data-binding-repeat-children="{{Rounds.data}}" data-binding-id="repeat1">
      &nbsp;
      <option value="{{rounds_id}}">{{Round_Title}}</option>
    </select><input name="tournamentID" type="hidden" id="tournamentID" data-binding-value="{{tournament.data[0].tournament_id}}"></td>
    <td><p>
      <select name="mission_name" id="mission_name" data-binding-repeat-children="{{tiebreakersFull.data}}" data-binding-id="repeat2">
        &nbsp;
        <option value="{{tiebreaker_name}}">{{tiebreaker_name}}</option>
      </select>
      </td>
    <td><input name="Add Tiebreaker" type="button" id="Add Tiebreaker" onClick="dmxDatabaseActionControl('run','insertTiebreakers',{},this)" value="Add Tiebreaker">&nbsp;</td>
  </tr>
</table>

</form>
<table width="800" border="1">
  
</table>
<p>&nbsp;</p>
<p>Configured Tiebreakers</p>
<table width="600" border="1">
  <tr>
    <th width="50%" scope="col">Round</th>
    <th width="50%" scope="col">Mission</th>
  </tr>
  <tr align="center" data-binding-repeat="{{matchedTiebreakers.data}}" data-binding-id="repeat3">
    <td>{{match_id}}</td>
    <td>{{mission_name}}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
&gt;&gt;&gt;<a href="playerAssignment_new.php?tourney={{tournament.data[0].tournament_id}}">Player Assignment</a>&gt;&gt;&gt;<script type="text/javascript">
  /* dmxDatabaseAction name "insertTiebreakers" */
       jQuery.dmxDatabaseAction(
         {"id": "insertTiebreakers", "url": "dmxDatabaseActions/insertTiebreaker.php", "data": {"match_id": "{{$FORM.match_name}}", "tournament_ID": "{{$FORM.tournamentID}}", "match_name": "{{$FORM.match_name}}", "mission_id": "{{$FORM.mission_name}}", "mission_name": "{{$FORM.mission_name}}"}, "success": "dmxDataBindingsAction('refresh','matchedTiebreakers',{});"}
       );
  /* END dmxDatabaseAction name "insertTiebreakers" */
</script>
</body>
</html>