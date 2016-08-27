<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap-theme.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/3/js/bootstrap.js"></script>
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
         {"id": "matchedTiebreakers", "url": "dmxDatabaseSources/matchedTiebreakers.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "tiebreaker": "{{$FORM.tiebreaker}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "matchedTiebreakers" */
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

  /* dmxDataSet name "tiebreakersDrill" */
       jQuery.dmxDataSet(
         {"id": "tiebreakersDrill", "url": "dmxDatabaseSources/tiebreakers_Full.php", "data": {"tiebreaker": "{{$FORM.tiebreaker}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tiebreakersDrill" */
</script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
   <?php include('nav.php'); ?>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Configure Tiebreakers/Missions for {{tournament.data[0].tournament_name}}- Round &quot;{{Rounds.data[0].Round_Title}}&quot;</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
     
<table width="800" border="1">
  
</table>
<p>&nbsp;</p>
<table width="95%" border="1">
  <tbody>
    <tr>
      <th scope="col">Tiebreaker/Mission Name</th>
      <th scope="col">Select Tiebreaker</th>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr>
      <td><select name="tiebreaker" id="tiebreaker" data-binding-repeat-children="{{tiebreakersFull.data}}" data-binding-id="tiebreaker">
        <option value="{{tourney_tiebreaker_id}}">{{tiebreaker_name}} </option>
      </select></td>
      <td><input name="button" type="button" id="button" onClick="dmxDatabaseActionControl('run','insertTiebreakers',{},this)" value="Add Tiebreaker"></td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<p>Configured Tiebreakers</p>
<table width="600" border="1">
  <tr>
    <th width="50%" scope="col">Round</th>
    <th width="50%" scope="col">Mission</th>
    <th width="50%" scope="col">Points</th>
    <th width="50%" scope="col">&nbsp;</th>
  </tr>
  <tr data-binding-repeat="{{tiebreakersDrill.data}}" data-binding-id="repeat1">
    <td>&nbsp;</td>
    <td>{{tiebreaker_name}}</td>
    <td>{{point_value}}</td>
    <td>&nbsp;</td>
  </tr>
</table>
&gt;&gt;&gt;<a href="playerAssignment_new.php?tourney={{tournament.data[0].tournament_id}}">Player Assignment</a>&gt;&gt;&gt;<script type="text/javascript">
  /* dmxDatabaseAction name "insertTiebreakers" */
       jQuery.dmxDatabaseAction(
         {"id": "insertTiebreakers", "url": "dmxDatabaseActions/insertTiebreaker.php", "data": {"match_id": "{{Rounds.data[0].rounds_id}}", "tournament_ID": "{{Rounds.data[0].tournament_id}}", "match_name": "{{Rounds.data[0].Round_Title}}", "mission_id": "{{$FORM.tiebreaker}}", "mission_name": "{{$FORM.tiebreaker}}", "tiebreaker_points": ""}, "success": "dmxDataBindingsAction('refresh','matchedTiebreakers',{});"}
       );
  /* END dmxDatabaseAction name "insertTiebreakers" */
</script>
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
</body>
</html>