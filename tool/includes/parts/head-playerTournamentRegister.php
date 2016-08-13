<!doctype html>
<html>
<head>
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/magnificent-popup/magnificent-popup.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Register for {{TournamentGameJoin.data[0].tournament_name}}</title>
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../Styles/dmxNotify.css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../../js/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../../js/mobile-toggle.js"></script>
<script type="text/javascript" src="../../js/backtotop.js"></script>
<style type="text/css">
.version {
	font-size: x-small;
}
</style>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxNotify.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "TournamentGameJoin" */
       jQuery.dmxDataSet(
         {"id": "TournamentGameJoin", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TournamentGameJoin" */
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
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
</script><script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
</head>