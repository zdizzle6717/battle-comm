<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Assign Rounds</title>
<link href="admin_temp.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<link rel="stylesheet" type="text/css" href="fontawesome/css/font-awesome.min.css" />
<script type="text/javascript" src="includes/extendjQuery.js"></script>
<script type="text/javascript" src="includes/LightBox/extendLightbox.js"></script>
<script type="text/javascript" src="includes/LightBox/LightBox1.js"></script>
<link rel="stylesheet" type="text/css" href="includes/LightBox/LightBox1.css">
<link rel="stylesheet" type="text/css" href="includes/LightBox/xtdLightbox.css">
<link href="../players/css/customPlayer.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
/* dmxDataSet name "tiebreakersMenu" */
       jQuery.dmxDataSet(
         {"id": "tiebreakersMenu", "url": "dmxDatabaseSources/tiebreakers_menu.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tiebreakersMenu" */
  /* dmxDataSet name "tournament" */
       jQuery.dmxDataSet(
         {"id": "tournament", "url": "dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament" */

  /* dmxDataSet name "rounds" */
       jQuery.dmxDataSet(
         {"id": "rounds", "url": "dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "rounds" */

  /* dmxDataSet name "tiebreakersFull" */
       jQuery.dmxDataSet(
         {"id": "tiebreakersFull", "url": "dmxDatabaseSources/tiebreakers_Full.php", "data": {"tiebreaker": "{{$FORM.tiebreaker}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tiebreakersFull" */
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
/* dmxDataSet name "matchedTiebreakers" */
       jQuery.dmxDataSet(
         {"id": "matchedTiebreakers", "url": "dmxDatabaseSources/matchedTiebreakers.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "matchedTiebreakers" */
function MM_callJS(jsStr) { //v2.0
  return eval(jsStr)
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
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
        	<?php include '../Templates/includes/user-navigation.php'; ?>
      <h1 class="center">BattleComm.com Tourney Tool</h1>
 
  <div>
    <div>
      <h2>Assign Objectives/Missions for {{tournament.data[0].tournament_name}}- Round &quot;{{rounds.data[0].Round_Title}}</h2>
      <p>[Instructions and so forth]</p>
    </div>
  </div>
  <div >
    <div>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <th colspan="5" scope="col">Mission/Objective</th>
            <th scope="col">Select</th>
            <th scope="col">&nbsp;</th>
          </tr>
          <tr>
            <td colspan="5"><select name="tibreakerSelect" id="tibreakerSelect" title="tiebreakerSelect" onBlur="dmxDataBindingsAction('refresh','tiebreakersFull',{'data':{&quot;tiebreaker&quot;: &quot;{{@$FORM.tibreakerSelect}}&quot;}})" data-binding-repeat-children="{{tiebreakersMenu.data}}" data-binding-id="select">
              <option value="{{tourney_tiebreaker_id}}">{{tiebreaker_name}} </option>
            </select>
will be assigned to Round &quot;{{rounds.data[0].Round_Title}}</td>
            <td><input name="button" type="button" id="button" onClick="dmxDatabaseActionControl('run','insertMatchedTiebreaker',{},this)" value="Add Mission"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5"><div data-binding-id="detail1" data-binding-detail="select">
              <p>{{tiebreaker_name}}-</p>
              <p> {{tiebreaker_conditions}}</p>
              <p>{{point_value}} points 
                <input name="tiebreakerName" type="hidden" id="tiebreakerName" data-binding-value="{{tiebreaker_name}}"> <input name="tiebreakerConditions" type="hidden" id="tiebreakerConditions" data-binding-value="{{tiebreaker_conditions}}"> <input name="tiebreakerPoints" type="hidden" id="tiebreakerPoints" data-binding-value="{{point_value}}">
                <input name="tournamentID" type="hidden" id="tournamentID" data-binding-value="{{tournament.data[0].tournament_id}}"> <input name="roundID" type="hidden" id="roundID" data-binding-value="{{rounds.data[0].rounds_id}}">
                <input name="ruondName" type="hidden" id="ruondName" data-binding-value="{{rounds.data[0].Round_Title}}">
                <input name="tiebreakerID" type="hidden" id="tiebreakerID" data-binding-value="{{tourney_tiebreaker_id}}">
              </p>
            </div></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="5">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
      <p>
      <table width="95%" border="1">
  <tbody>
    <tr>
      <th scope="col">Mission/TieBreaker</th>
      <th scope="col">Point Value</th>
      <th scope="col">Round</th>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr data-binding-repeat="{{matchedTiebreakers.data}}" data-binding-id="repeat1">
      <td>{{mission_name}}</td>
      <td>{{tiebreaker_points}}</td>
      <td>{{match_name}}</td>
      <td><input name="button2" type="button" id="button2" onClick="dmxDataBindingsAction('selectCurrent','repeat1',this);dmxDatabaseActionControl('run','Delete Matched Tiebreaker',{'data':{&quot;matched_tiebreakers&quot;: &quot;{{@matched_tiebreakers}}&quot;}},this)" value="Delete Mission"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>

      </p>
      
    </div>
  </div>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?>
<script type="text/javascript">
  /* dmxDatabaseAction name "insertMatchedTiebreaker" */
       jQuery.dmxDatabaseAction(
         {"id": "insertMatchedTiebreaker", "url": "dmxDatabaseActions/insertTiebreaker.php", "data": {"match_id": "{{$FORM.roundID}}", "tournament_ID": "{{$FORM.tournamentID}}", "match_name": "{{$FORM.ruondName}}", "mission_id": "{{$FORM.tiebreakerID}}", "mission_name": "{{$FORM.tiebreakerName}}", "tiebreaker_points": "{{$FORM.tiebreakerPoints}}"}, "success": "dmxDataBindingsAction('refresh','matchedTiebreakers',{});"}
       );
  /* END dmxDatabaseAction name "insertMatchedTiebreaker" */
</script>


<script type="text/javascript">
  /* dmxDatabaseAction name "Delete Matched Tiebreaker" */
       jQuery.dmxDatabaseAction(
         {"id": "Delete Matched Tiebreaker", "url": "dmxDatabaseActions/DeleteMatchedTiebreaker.php", "data": {"matched_tiebreakers": "{{matchedTiebreakers.data[0].matched_tiebreakers}}"}, "success": "dmxDataBindingsAction('refresh','matchedTiebreakers',{});"}
       );
  /* END dmxDatabaseAction name "Delete Matched Tiebreaker" */
</script>