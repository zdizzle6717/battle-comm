<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxServerAction.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "playersRPList" */
       jQuery.dmxDataSet(
         {"id": "playersRPList", "url": "../dmxDatabaseSources/playerRPList.php", "data": {"limit": ""}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "playersRPList" */
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

<body>
<p>&nbsp;</p>
<p>Modify RP for Players</p>
<p>&nbsp;
<div class="updatePlayer" id="updatePlayer" data-binding-detail="repeat1" data-binding-id="updatePlayer">Content for  class "updatePlayer" id "updatePlayer" Goes Here
  <form action="" method="post" name="updatePlayer" id="updatePlayer" title="updatePlayer">
    <p>
      <input name="userIdent" type="hidden" id="userIdent" value="{{id}}">
      {{firstName}} {{lastName}}{{id}}    </p>
    <p><label for="rpValue">Current Reward Points</label><br>
<input name="rpValue" type="text" id="rpValue" value="{{playersRPList.data[0].user_points}}" data-binding-value="{{user_points}}"></p>
    <p>
      <input name="updatePoints" type="submit" id="updatePoints" form="updatePlayer" formmethod="POST" title="UpdatePoints" onClick="dmxDatabaseActionControl('run','pointsTheUpdate',{},this)" value="Update">
    </p>
  </form>
</div></p>

<p><div class="playerFilter" id="playerFilter">
  <input name="filter" type="text" id="filter" onKeyUp="MM_callJS('$.dmxDataBindings.globalScope.update(\'$FORM\');')"> 
  &lt;--Filter by first name, Last name, or email
</div>&nbsp;</p>
<div class="playerList" id="playerList">Content for  class "playerList" id "playerList" Goes Here
  <table width="95%" border="1">
    <tbody>
      <tr>
        <th scope="col">Last Name</th>
        <th scope="col">First Name</th>
        <th scope="col">Email</th>
        <th scope="col">RP Value</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
      </tr>
      <tr data-binding-repeat="{{playersRPList.data}}" data-binding-id="repeat1">
        <td>{{lastName}}
        <input name="userID" type="hidden" id="userID" value="#"></td>
        <td>{{firstName}}</td>
        <td>{{email}}</td>
        <td>{{user_points}}</td>
        <td><input name="edit" type="submit" id="edit" onClick="dmxDataBindingsAction('selectCurrent','repeat1',this)" value="Edit Points"></td>
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
</div>
<script type="text/javascript">
/* dmxServerAction name "pointUpdate" */
       jQuery.dmxServerAction(
         {"id": "pointUpdate", "url": "../dmxConnect/api/updatePoints.php", "form": "#updatePlayer", "data": {}, "onSuccess": "dmxDataBindingsAction('refresh','playersRPList',{'data':{\"limit\": \"\"}});"}
       );
  /* END dmxServerAction name "pointUpdate" */
/* dmxDatabaseAction name "pointsTheUpdate" */
       jQuery.dmxDatabaseAction(
         {"id": "pointsTheUpdate", "url": "../dmxDatabaseActions/updateThePoints.php", "data": {"rpValue": "{{$FORM.rpValue}}", "userIdent": "{{$FORM.userIdent}}"}}
       );
  /* END dmxDatabaseAction name "pointsTheUpdate" */
</script>
</body>
</html>