<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Pending Registrations</title>
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap-theme.css" />
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "PendingRegistrations" */
       jQuery.dmxDataSet(
         {"id": "PendingRegistrations", "url": "dmxDatabaseSources/PendingRegistrations.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "PendingRegistrations" */

  /* dmxDataSet name "ApprovedPlayers" */
       jQuery.dmxDataSet(
         {"id": "ApprovedPlayers", "url": "dmxDatabaseSources/ApprovedPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "yes": "{{$FORM.yes}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "ApprovedPlayers" */
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
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> <?php include("nav.php"); ?></div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Pending Registrations</h2>
      <p>These are registrations that have not been approved by Tournament Organizers.</p>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <td>Handle</td>
            <td>Full Name</td>
            <td>Email</td>
            <td>Appoved?</td>
            <td>Approve <br>
              Registration</td>
            <td>&nbsp;</td>
          </tr>
          <tr data-binding-repeat="{{PendingRegistrations.data}}" data-binding-id="repeat1">
            <td>{{userHandle}}</td>
            <td>{{firstName}} {{lastName}}</td>
            <td>{{email_Address}}</td>
            <td>{{user_confirmed}}</td>
            <td><input name="setActive" type="radio" id="radio" onClick="dmxDataBindingsAction('selectCurrent','repeat1',this)" value="active">
              <input name="tourneyPlayerID" type="hidden" id="tourneyPlayerID" data-binding-value="{{ApprovedPlayers.data[0].tournament_players_id}}">
              <input name="userID" type="hidden" id="userID" data-binding-value="{{ApprovedPlayers.data[0].user_login_id}}">
            <input name="approvePlayer" type="hidden" id="approvePlayer" value="yes">              <input name="button" type="button" id="button" onClick="dmxDatabaseActionControl('run','RegisterPlayers',{'data':{&quot;tournament_players_id&quot;: &quot;{{@tournament_id}}&quot;}},this)" value="Approve"></td>
            <td><input type="submit" name="button2" id="button2" value="Delete"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
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
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Approved Registrations</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <th scope="col">Handle</th>
            <th scope="col">Full Name</th>
            <th scope="col">Email Address</th>
            <th scope="col">Confirmed</th>
            <th scope="col">Delete</th>
            <th scope="col">&nbsp;</th>
          </tr>
          <tr data-binding-repeat="{{ApprovedPlayers.data}}" data-binding-id="repeat2">
            <td>{{userHandle}}</td>
            <td>{{firstName}} {{lastName}}</td>
            <td>{{email_Address}}</td>
            <td>{{user_confirmed}}</td>
            <td><input type="submit" name="button3" id="button3" value="Delete"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
      <p>
      </p>
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
  /* dmxDatabaseAction name "RegisterPlayers" */
       jQuery.dmxDatabaseAction(
         {"id": "RegisterPlayers", "url": "dmxDatabaseActions/registerApprovePlayer.php", "data": {"user_confirmed": "{{$FORM.approvePlayer}}", "tournament_players_id": "{{$FORM.tourneyPlayerID}}"}, "success": "dmxDataBindingsAction('refresh','ApprovedPlayers',{});dmxDataBindingsAction('refresh','PendingRegistrations',{});"}
       );
  /* END dmxDatabaseAction name "RegisterPlayers" */
</script>
</body>
</html>