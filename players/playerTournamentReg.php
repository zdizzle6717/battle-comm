<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Register for {{TournamentGameJoin.data[0].tournament_name}}</title>
<link href="../tool/admin_temp.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../Styles/dmxNotify.css" />
<script src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<style type="text/css">
.version {
	font-size: x-small;
}
</style>
<script type="text/javascript" src="../ScriptLibrary/dmxNotify.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "TournamentGameJoin" */
       jQuery.dmxDataSet(
         {"id": "TournamentGameJoin", "url": "../dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TournamentGameJoin" */
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "../dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
function GP_popupConfirmMsg(msg) { //v1.0
  document.MM_returnValue = confirm(msg);
}
function dmxAjaxFormAction(formID, action, elemToProc){ // v1.00
	var theFormElem = jQuery('#'+formID),
	theSuccessRegion = theFormElem.parent().children(".dmxAjaxFormSuccess"),
	theErrorRegion = theFormElem.parent().children(".dmxAjaxFormError");
	switch(action){
		case "toggle": 
		  switch (elemToProc){
				case "form": if(theFormElem)theFormElem.fadeToggle("fast");break;
				case "success": if(theSuccessRegion) theSuccessRegion.fadeToggle("fast");break;
				case "error": if(theErrorRegion) theErrorRegion.fadeToggle("fast");break;
		  }
			break;
		case "show":
		  switch (elemToProc){
				case "form": if(theFormElem && theFormElem.is(':hidden'))theFormElem.fadeToggle("fast");break;
				case "success": if(theSuccessRegion && theSuccessRegion.is(':hidden')) theSuccessRegion.fadeToggle("fast");break;
				case "error": if(theErrorRegion && theErrorRegion.is(':hidden')) theErrorRegion.fadeToggle("fast");break;
		  }		
			break;
		case "hide":
		  switch (elemToProc){
				case "form": if(theFormElem && theFormElem.is(':visible'))theFormElem.fadeToggle("fast");break;
				case "success": if(theSuccessRegion && theSuccessRegion.is(':visible')) theSuccessRegion.fadeToggle("fast");break;
				case "error": if(theErrorRegion && theErrorRegion.is(':visible')) theErrorRegion.fadeToggle("fast");break;
		  }		
			break;
		case "submit":
			var theOnSubmit = theFormElem.attr('onsubmit');
			if (theOnSubmit) {
				var onSubmitFunc = new Function(theOnSubmit);
				var currentEvent = window.event || arguments.callee.caller.arguments[0];
				var ret = onSubmitFunc.call(theFormElem.get(0),currentEvent);
				if (jQuery.Event(currentEvent).isDefaultPrevented() || ret === false) return false;
			}
			theFormElem.submit(); 
			return; 	
	}
	//Prevent default click
	var evt = window.event || arguments.callee.caller.arguments[0];
	if (evt) {
	  evt = jQuery.Event(evt);
	  evt.preventDefault();
	}
}
function dmxNotifyAction() {   //ver 1.00
  if (arguments && arguments.length > 0) {
    if(typeof arguments[0] == 'object'){
      jQuery.dmxNotify(arguments[0]);
    }else if(arguments[0] === 'closeAll'){
       jQuery.dmxNotify.closeAll();
    }
  }
}
  /* dmxDataSet name "pendingApprovalPlayers" */
       jQuery.dmxDataSet(
         {"id": "pendingApprovalPlayers", "url": "../dmxDatabaseSources/PendingApprovalPlayers.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "pendingApprovalPlayers" */
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
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
<div class="container">
      <h2>Register for {{TournamentGameJoin.data[0].tournament_name}}</h2>
  <div class="row" id="nav">
    <div class="col-lg-12">
     
    </div>
  </div>
  <div class="row">
    <div class="three_column_1">
      <h2>{{TournamentGameJoin.data[0].tournament_name}} </h2>
      <p>{{TournamentGameJoin.data[0].tournament_info}} <span class="version">v2.1</span></p>
    </div>
  </div>
  <div class="row">
    <div class="three_column_1">
      <h2>Tournament Information</h2>
      <ul>
        <li>{{TournamentGameJoin.data[0].tournament_startDate}} - {{TournamentGameJoin.data[0].Tournament_endDate}}</li>
        <li>{{TournamentGameJoin.data[0]["tournament_location _name"]}} <br>
          {{TournamentGameJoin.data[0].tournament_address}} <br>
        {{TournamentGameJoin.data[0].tournament_city}} {{TournamentGameJoin.data[0].tournament_state}}. {{TournamentGameJoin.data[0].tournament_zip}}</li>
        <li><a href="{{TournamentGameJoin.data[0].tournament_URL}}">{{TournamentGameJoin.data[0].tournament_URL}}</a></li>
      </ul>
      <p></p>
    </div>
    <div class="three_column_1">
      <h2><img src="uploads/tournament/{{TournamentGameJoin.data[0].tournament_logo_icon}}"  alt="{{TournamentGameJoin.data[0].tournament_name}}" width="600"/></h2>
      <p>&nbsp;</p>
      <p>{{TournamentGameJoin.data[0].game_system_Title}}</p>
      <p><img src="uploads/gameSystems/{{TournamentGameJoin.data[0].game_logo}}"  alt="{{TournamentGameJoin.data[0].game_system_Title}}"/></p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2 class="float_left">Register</h2>
      <p>To participate in the tournament as a player you are required to register. You can only register using your Battle-Comm.com account.<br>
        All registrations require approval from the Tournament Organizers.  You must also agree to the tournaments <a href="#">Terms of Service</a></p>
      
      <table width="95%" border="1">
        <tbody>
          <tr>
            <td><strong>Handle</strong></td>
            <td><strong>Full Name</strong></td>
            <td><strong>Email</strong></td>
            <td><strong>Agree to Terms</strong></td>
            <td>&nbsp;</td>
          </tr>
<tr>
            <td>{{LoggedInUser.data[0].user_handle}}
<input name="PlayerID" type="hidden" id="PlayerID" value="{{LoggedInUser.data[0].id}}" data-binding-value="{{LoggedInUser.data[0].id}}"> <input name="tournamentID" type="hidden" id="tournamentID" value="{{TournamentGameJoin.data[0].tournament_id}}" data-binding-value="{{TournamentGameJoin.data[0].tournament_id}}"> <input name="playerHandle" type="hidden" id="playerHandle" value="{{LoggedInUser.data[0].user_handle}}" data-binding-value="{{LoggedInUser.data[0].user_handle}}"></td>
            <td>{{LoggedInUser.data[0].firstName}}{{LoggedInUser.data[0].lastName}}
              <input name="playerFirstName" type="hidden" id="playerFirstName" value="{{LoggedInUser.data[0].firstName}}" data-binding-value="{{LoggedInUser.data[0].firstName}}">
                      <input name="playerLastName" type="hidden" id="playerLastName" value="{{LoggedInUser.data[0].lastName}}" data-binding-value="{{LoggedInUser.data[0].lastName}}"> </td>
            <td>{{LoggedInUser.data[0].email}}<input name="playerEmail" type="hidden" id="playerEmail" value="{{LoggedInUser.data[0].email}}" data-binding-value="{{LoggedInUser.data[0].email}}">
            <input name="player_confirmed" type="hidden" id="player_confirmed" value="yes"></td>
            <td><em>Yes by default( for testing)</em></td>
            <td><input name="button" type="button" id="button" onClick="dmxDatabaseActionControl('run','RegisterPlayer',{},this)" value="Register"></td>
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
      <div data-binding-id="repeat1" data-binding-repeat="{{pendingApprovalPlayers.data}}">{{userHandle}}{{dateRegistered}} {{user_confirmed}}</div>
      <p><a href="../players/index.php">[Back to Player Home Page]</a></p>
    </div>
  </div>
  <div class="row">
    <div class="two_column_1">
      <h2>Footer Left</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
    <div class="two_column_1">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
<script type="text/javascript">
  /* dmxDatabaseAction name "RegisterPlayer" */
       jQuery.dmxDatabaseAction(
         {"id": "RegisterPlayer", "url": "../dmxDatabaseActions/registerPlayer.php", "data": {"user_confirmed": "{{$FORM.player_confirmed}}", "userHandle": "{{$FORM.playerHandle}}", "firstName": "{{$FORM.playerFirstName}}", "lastName": "{{$FORM.playerLastName}}", "email_Address": "{{$FORM.playerEmail}}", "tournament_id": "{{$FORM.tournamentID}}", "user_login_id": "{{$FORM.PlayerID}}"}, "success": "dmxDataBindingsAction('refresh','pendingApprovalPlayers',{});dmxNotifyAction({\"positionClass\": \"toast-bottom-full-width\", \"title\": \"Your Registration has been Sumitted\", \"msg\": \" Once your Registration is approved you will be notified via email.\", \"extendedTimeOut\": 2000, \"tapToDismiss\": false});"}
       );
  /* END dmxDatabaseAction name "RegisterPlayer" */
</script>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 