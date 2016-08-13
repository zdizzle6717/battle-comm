<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxServerAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "playerProfile" */
       jQuery.dmxDataSet(
         {"id": "playerProfile", "url": "../dmxDatabaseSources/PlayerProfileEdit.php", "data": {"limit": "1"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "playerProfile" */
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
<p>Server Connect Test</p>
<p>{{playerProfile.data[0].user_bio}}</p>
<p>&nbsp;</p>
<form action="" method="post" name="bioUpdate" id="bioUpdate" title="bioUpdate">
  <p>Bio: 
    <textarea name="textarea" cols="48" rows="8" id="textarea"></textarea>
  </p>
  <p>
    <input name="userID" type="hidden" id="userID" value="6">
    <input name="submit" type="submit" id="submit" formmethod="POST" value="Submit">
  </p>
</form>
<p>&nbsp;</p>
<script type="text/javascript">
/* dmxServerAction name "updateBio" */
       jQuery.dmxServerAction(
         {"id": "updateBio", "url": "../dmxConnect/api/updateBio.php", "form": "#bioUpdate", "data": {"userBio": "{{$FORM.textarea}}"}, "onSuccess": "dmxDataBindingsAction('refresh','playerProfile',{});"}
       );
  /* END dmxServerAction name "updateBio" */
</script>
</body>
</html>