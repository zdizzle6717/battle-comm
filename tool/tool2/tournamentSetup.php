<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="../Styles/dmxTimepicker.css" />
<link rel="stylesheet" type="text/css" href="../Styles/jqueryui/black-tie/black-tie.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script><script type="text/javascript" src="../ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.ui.slider.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery.ui.touch-punch.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxTimepicker.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript">
/* dmxDataSet name "tournaments" */
       jQuery.dmxDataSet(
         {"id": "tournaments", "url": "../dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournaments" */

  /* dmxDataSet name "tournamentRounds" */
       jQuery.dmxDataSet(
         {"id": "tournamentRounds", "url": "../dmxDatabaseSources/tourneyRounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
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
<p>&nbsp;</p>
<h3>Setup for {{tournaments.data[0].tournament_name}}</h3>
<p>&nbsp;</p>
<p>{{tournaments.data[0].tournament_name}} has {{tournaments.data[0].tournament_rounds}} rounds.</p>
<table width="700" border="1">
  <tr>
    <th scope="col">Round Title</th>
    <th scope="col">Start Time</th>
    <th scope="col">End Time</th>
    <th scope="col"># of Participants</th>
  </tr>
  <tr data-binding-repeat="{{tournamentRounds.data}}" data-binding-id="repeat1">
    <td>{{Round_Title}}</td>
    <td>{{startTime}}</td>
    <td>{{startTime}}</td>
    <td>{{num_participants}}</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>Configure Rounds</p>
<form action="" method="post" name="AddRound" id="AddRound"><table width="700" border="1">
  <tr>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
    <td><input name="Round_Title" type="text" id="Round_Title"></td>
    <td><input class="dmxTimepicker" name="dmxTimepicker1" id="dmxTimepicker1" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxTimepicker1").dmxTimepicker(
         {"timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "showTime": false}
       );
     }
 );
  // ]]>
</script></td>
    <td><input class="dmxTimepicker" name="dmxTimepicker2" id="dmxTimepicker2" />
<script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxTimepicker2").dmxTimepicker(
         {"timezone": "", "showOn": "both", "duration": "slow", "showOptions": {"direction": "up", "easing": "swing"}, "showTime": false}
       );
     }
 );
  // ]]>
</script></td>
    <td><input name="num_Participants" type="text" id="num_Participants"></td>
  </tr>
  <tr>
    <td><input name="insert_round" type="button" id="insert_round" onClick="dmxDatabaseActionControl('run','insertNewroundsForm',{},this)" value="Insert"></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

</form>

<p>&nbsp;</p>
<script type="text/javascript">
  /* dmxDatabaseAction name "insertNewroundsForm" */
       jQuery.dmxDatabaseAction(
         {"id": "insertNewroundsForm", "url": "../dmxDatabaseActions/InsertRounds.php", "data": {"Round_Title": "{{$FORM.Round_Title}}", "dmxTimepicker1": "{{$FORM.dmxTimepicker1}}", "dmxTimepicker2": "{{$FORM.dmxTimepicker2}}", "num_Participants": "{{$FORM.num_Participants}}"}, "success": "dmxDataBindingsAction('refresh','tournamentRounds',{});"}
       );
  /* END dmxDatabaseAction name "insertNewroundsForm" */
</script>
</body>
</html>