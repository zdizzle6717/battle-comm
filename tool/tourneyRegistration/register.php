<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Register for {{tourneyGame.data[0].tournament_name}}</title>
<link href="../admin_temp.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap-theme.css" />
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "tourneyGame" */
       jQuery.dmxDataSet(
         {"id": "tourneyGame", "url": "../dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "1"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tourneyGame" */
  /* dmxDataSet name "playersFiltered" */
       jQuery.dmxDataSet(
         {"id": "playersFiltered", "url": "../../dmxDatabaseSources/playerListFiltered.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "playersFiltered" */
  /* dmxDataSet name "newTournamentPlayer" */
       jQuery.dmxDataSet(
         {"id": "newTournamentPlayer", "url": "../../dmxDatabaseSources/tournamentPlayers.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "newTournamentPlayer" */
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
function MM_popupMsg(msg) { //v1.0
  alert(msg);
}
function MM_setTextOfLayer(objId,x,newText) { //v9.0
  with (document) if (getElementById && ((obj=getElementById(objId))!=null))
    with (obj) innerHTML = unescape(newText);
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
<script type="text/javascript" src="../../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>{{tourneyGame.data[0].tournament_name}}</h2>
      <p>{{tourneyGame.data[0].tournament_startDate.formatDate( "M dd yyyy" )}}- {{tourneyGame.data[0].Tournament_endDate.formatDate( "M dd yyyy" )}}</p>
      <div data-binding-html="{{tourneyGame.data[0].tournament_info}}"></div>
      <p><?php echo $_SESSION['SecurityAssist_id']; ?></p>
      <p>Featuring {{tourneyGame.data[0].tournament_rounds}} rounds of {{tourneyGame.data[0].game_system_Title}}</p>
      <p>{{tourneyGame.data[0]["tournament_location _name"]}}      <br>
      {{tourneyGame.data[0].tournament_address}} {{tourneyGame.data[0].tournament_city}} {{tourneyGame.data[0].tournament_state}}, {{tourneyGame.data[0].tournament_zip}}</p>
      <p>For more information contact {{tourneyGame.data[0].tournament_admin_name}}<br>
p {{tourneyGame.data[0].tournament_phone}} e {{tourneyGame.data[0].tournament_email}}</p>
      <p>or vist {{tourneyGame.data[0].tournament_name}} at <a href="{{tourneyGame.data[0].tournament_URL}}" target="_blank">{{tourneyGame.data[0].tournament_URL}}</a></p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Register for Tournament</h2>
      <p>By submitting the information below I am indicating that I would like to participate as an active player in {{tourneyGame.data[0].tournament_name}} and will play in all rounds that I am eligiable. And I will follow and adhere to all established and published rules of the tournament.</p>
      <form action="" method="post" name="registerPlayer" id="registerPlayer">
      <div class="form-group">
        <label class="control-label" for="username">Handle/Username:</label>
        <div class="controls">
          <input name="username" type="text" class="input-group-lg" id="username" placeholder="Text Field" value="{{playersFiltered.data[0].user_handle}}" size="50" data-binding-value="{{playersFiltered.data[0].user_handle}}">
          <input name="user_login_id" type="hidden" id="user_login_id" data-binding-value="{{playersFiltered.data[0].id}}" value="{{playersFiltered.data[0].id}}">
          <input name="tournamentID" type="hidden" id="tournamentID" value="{{tourneyGame.data[0].tournament_id}}" data-binding-value="{{tourneyGame.data[0].tournament_id}}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="username">First Name:</label>
        <div class="controls">
          <input name="firstName" type="text" id="firstName" placeholder="Text Field" size="50" value="{{playersFiltered.data[0].firstName}}" data-binding-value="{{playersFiltered.data[0].firstName}}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="username">Last Name:</label>
        <div class="controls">
          <input name="lastName" type="text" id="lastName" placeholder="Text Field" size="50" value="{{playersFiltered.data[0].lastName}}" data-binding-value="{{playersFiltered.data[0].lastName}}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="username">Email:</label>
        <div class="controls">
          
          <input name="email" type="email" id="email" size="50" value="{{playersFiltered.data[0].email}}" data-binding-value="{{playersFiltered.data[0].email}}">
        </div>
      </div>
      <p>
        <input name="button2" type="button" class="bg-primary" id="button2" onClick="dmxDatabaseActionControl('run','registerPlayer',{},this)" value="Register">
      <p>You will receive a notification to your registered email account and a message in your Battle-Comm account once your registration has been approved by the tournamen torganizers.
      <div class="alert-success" id="alert-success" style="display:none">Your registration has been submitted.</div>
      <p>      
      </form></p>
      <table width="530" border="1" align="center">
        <tbody>
          <tr align="center" style="text-align: center">
            <th width="238" scope="col">Handle</th>
            <th width="203" scope="col">Name</th>
            <th width="67" scope="col">Email</th>
            <th width="67" scope="col">Confirmed</th>
          </tr>
          <tr>
            <td>{{newTournamentPlayer.data[0].userHandle}}</td>
            <td>{{newTournamentPlayer.data[0].firstName}} {{newTournamentPlayer.data[0].lastName}}</td>
            <td>{{newTournamentPlayer.data[0].email_Address}}</td>
            <td>{{newTournamentPlayer.data[0].user_confirmed}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>News [Coming Soon]</h2>
      <p>[news feed coming soon]</p>
    </div>
    <div class="col-lg-6">
      <h2>Events [Coming Soon]</h2>
      <p>[Events feed coming soon]</p>
    </div>
  </div>
</div>
<script type="text/javascript">
  /* dmxDatabaseAction name "registerPlayer" */
       jQuery.dmxDatabaseAction(
         {"id": "registerPlayer", "url": "../../dmxDatabaseActions/registerPlayer.php", "data": {"user_confirmed": "", "userHandle": "{{$FORM.username}}", "firstName": "{{$FORM.firstName}}", "lastName": "{{$FORM.lastName}}", "email_Address": "{{$FORM.email}}", "tournament_id": "{{$FORM.tournamentID}}", "user_login_id": "{{$FORM.user_login_id}}"}, "success": "MM_changeProp('alert-success','','display','inline','DIV');dmxDataBindingsAction('refresh','newTournamentPlayer',{});MM_setTextOfLayer('alert-success','','This was done successfully');", "error": "MM_popupMsg('There has been an error');"}
       );
  /* END dmxDatabaseAction name "registerPlayer" */
</script>
</body>
</html>