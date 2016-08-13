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
<script type="text/javascript" src="ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "tournament" */
       jQuery.dmxDataSet(
         {"id": "tournament", "url": "dmxDatabaseSources/tournaments.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament" */
  /* dmxDataSet name "pendingPlayers" */
       jQuery.dmxDataSet(
         {"id": "pendingPlayers", "url": "dmxDatabaseSources/PendingApprovalPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "pendingPlayers" */
  /* dmxDataSet name "RegisteredPlayers" */
       jQuery.dmxDataSet(
         {"id": "RegisteredPlayers", "url": "dmxDatabaseSources/RegisteredPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RegisteredPlayers" */
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
      <h2>Pending Player Approval for &quot;{{tournament.data[0].tournament_name}}&quot;</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Players Pending Registered</h2>
      <p>There are {{pendingPlayers.total}} players awaiting approval. </p>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <th width="15%" scope="col">Username/Handle</th>
            <th width="21%" scope="col">Full Name</th>
            <th width="14%" scope="col">Email</th>
            <th width="35%" scope="col">Date registered</th>
            <th width="15%" scope="col">Approve?</th>
          </tr>
          <tr style="text-align: center" data-binding-repeat="{{pendingPlayers.data}}" data-binding-id="repeat1">
            <td>{{userHandle}}
                  <input name="userID" type="hidden" id="userID" data-binding-value="{{user_login_id}}">
                  <input name="tourneyUserId" type="hidden" id="tourneyUserId" data-binding-value="{{tournament_players_id}}"></td>
            <td>{{firstName}} {{lastName}}</td>
            <td>{{email_Address}}</td>
            <td>{{dateRegistered.formatDate( "MM/dd/yyyy hh:mm a" )}}</td>
            <td><input name="button" type="submit" class="btn-primary" id="button" onClick="dmxDatabaseActionControl('run','updatedTournamentPlayer',{},this)" value="Approve Player ">              <input name="playerApproved" type="hidden" id="playerApproved" value="yes"></td>
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
      <h2>Registered Players</h2>
      <p>There are currently {{RegisteredPlayers.total}} registered players.</p>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <th width="24%" scope="col">Username/Handle</th>
            <th width="20%" scope="col">Full Name </th>
            <th width="20%" scope="col">Email</th>
            <th width="21%" scope="col">Date Registered</th>
            <th width="15%" scope="col">Approved?</th>
          </tr>
          <tr style="text-align: center" data-binding-repeat="{{RegisteredPlayers.data}}" data-binding-id="repeat2">
            <td>{{userHandle}}</td>
            <td>{{firstName}}&nbsp;{{lastName}}</td>
            <td>{{email_Address}}</td>
            <td>{{dateRegistered.formatDate( "MM/dd/yyyy hh:mm a" )}}</td>
            <td>{{user_confirmed}}</td>
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
  /* dmxDatabaseAction name "updatedTournamentPlayer" */
       jQuery.dmxDatabaseAction(
         {"id": "updatedTournamentPlayer", "url": "dmxDatabaseActions/updatedTournamentPlayer.php", "data": {"user_confirmed": "{{$FORM.playerApproved}}", "tournament_playerID": "{{$FORM.tourneyUserId}}"}, "success": "dmxDataBindingsAction('refresh','RegisteredPlayers',{});dmxDataBindingsAction('refresh','pendingPlayers',{});"}
       );
  /* END dmxDatabaseAction name "updatedTournamentPlayer" */
</script>
</body>
</html>