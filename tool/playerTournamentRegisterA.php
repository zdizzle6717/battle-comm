<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Register for {{TournamentGame.data[0].tournament_name}}</title>
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap-theme.css" />
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="Styles/dmxNotify.css" />
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxNotify.js"></script>
<script type="text/javascript">
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

  /* dmxDataSet name "TournamentGame" */
       jQuery.dmxDataSet(
         {"id": "TournamentGame", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TournamentGame" */

  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "dmxDatabaseSources/loggedinPlayer.php", "data": {"pl": "{{$URL.pl}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
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
      <h2>{{TournamentGame.data[0].tournament_name}}</h2>
      <h3>{{TournamentGame.data[0].tournament_startDate}} - {{TournamentGame.data[0].Tournament_endDate}}</h3>
      <p>{{TournamentGame.data[0].tournament_info.stripTags( )}}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>Information</h2>
      <ul>
        <li>{{TournamentGame.data[0]["tournament_location _name"]}} <br>
          {{TournamentGame.data[0].tournament_address}} <br>
          {{TournamentGame.data[0].tournament_city}} {{TournamentGame.data[0].tournament_state}}, {{TournamentGame.data[0].tournament_zip}}</li>
        <li>{{TournamentGame.data[0].tournament_phone}}</li>
        <li>Featuring {{TournamentGame.data[0].tournament_rounds}} rounds of {{TournamentGame.data[0].game_system_Title}}</li>
      </ul>
    </div>
    <div class="col-lg-6">
      <img src="uploads/tournament/{{TournamentGame.data[0].tournament_logo_icon}}" width="600"/>   
      <p><img src="" data-binding-src="{{TournamentGame.data[0].game_logo}}" />
      </p>
    </div>
    <p>&nbsp;</p>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Register</h2>
      <p>To participate in the tournament as a player you are required to register. You can only register using your Battle-Comm.com account.<br>
        All registrations require approval from the Tournament Organizers.  You must also agree to the tournaments <a href="#">Terms of Service</a>.</p>
      <p>I wish to register for the tournament as: {{LoggedInUser.data[0].playerHandle}} ({{LoggedInUser.data[0].playerFirstName}} {{LoggedInUser.data[0].playerLastName}})
      <input name="tournamentID" type="hidden" id="tournamentID" data-binding-value="{{TournamentGame.data[0].tournament_id}}">
      <input name="playerID" type="hidden" id="playerID" data-binding-value="{{LoggedInUser.data[0].playerId}}">
      <input name="playerHandle" type="hidden" id="playerHandle" data-binding-value="{{LoggedInUser.data[0].playerHandle}}">
      <input name="playerfirstName" type="hidden" id="playerfirstName" data-binding-value="{{LoggedInUser.data[0].playerFirstName}}">
      <input name="playerLastName" type="hidden" id="playerLastName" data-binding-value="{{LoggedInUser.data[0].playerLastName}}">
      <input name="playerEmail" type="hidden" id="playerEmail" data-binding-value="{{LoggedInUser.data[0].playerEmail}}">
      </p>
      <p>I agree to the tournament Terms of Service: 
        <input name="TOS" type="checkbox" id="TOS" value="Yes">
      </p>
      <p>
        <input name="button" type="button" id="button" onClick="dmxDatabaseActionControl('run','RegisterPlayer',{},this)" value="Register">
      </p>
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
/* dmxDatabaseAction name "RegisterPlayer" */
       jQuery.dmxDatabaseAction(
         {"id": "RegisterPlayer", "url": "dmxDatabaseActions/registerPlayer.php", "data": {"tournament_id": "{{$FORM.tournamentID}}", "user_login_id": "{{$FORM.playerID}}", "userHandle": "{{$FORM.playerHandle}}", "firstName": "{{$FORM.playerfirstName}}", "lastName": "{{$FORM.playerLastName}}", "email_Address": "{{$FORM.playerEmail}}", "dateRegistered": ""}, "success": "dmxNotifyAction({\"positionClass\": \"toast-bottom-full-width\", \"title\": \"Your Registration has been Sent\", \"msg\": \"You will be notified once the Tournament Organizers Approve your registration.\", \"timeOut\": 3000, \"extendedTimeOut\": 2000});"}
       );
  /* END dmxDatabaseAction name "RegisterPlayer" */
</script>
</body>
</html>