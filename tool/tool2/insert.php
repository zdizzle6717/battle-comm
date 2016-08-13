<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="../Styles/form_clean.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "filteredTourney" */
       jQuery.dmxDataSet(
         {"id": "filteredTourney", "url": "../dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "filteredTourney" */
function MM_popupMsg(msg) { //v1.0
  alert(msg);
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
<h1>{{filteredTourney.data[0].tournament_name}}</h1>
<form class="clean" id="insertround" name="insertRound">
  <ol>
    <li>
      <fieldset>
        <ol>
          <li>
            <label for="roundTitle">Round Title</label>
            <input type="text" id="roundTitle" name="roundTitle" value="" />
          </li>
          <li>
            <label for="starttime">Start Time</label>
            <input type="text" id="starttime" name="starttime" value="" />
          </li>
          <li>
            <label for="endtime">End Dime</label>
            <input type="text" id="endtime" name="endtime" value="" />
          </li>
          <li>
            <label for="numparticipants">Number of Participants</label>
            <input type="text" id="numparticipants" name="numparticipants" value="" />
          </li>
        </ol>
      </fieldset>
    </li>
  </ol>
  <p style="text-align:right;">
    <input type="reset" value="CANCEL" />
    <input type="submit" formmethod="POST" onClick="dmxDatabaseActionControl('run','insertRounds',{},this)" value="OK" />
    <input name="insert" type="button" id="insert" onClick="dmxDatabaseActionControl('run','insertRounds',{},this)" value="Insert">
  </p>
</form>
<script type="text/javascript">
  /* dmxDatabaseAction name "insertRounds" */
       jQuery.dmxDatabaseAction(
         {"id": "insertRounds", "url": "../dmxDatabaseActions/InsertRounds.php", "data": {"roundTitle": "{{$FORM.roundTitle}}", "starttime": "{{$FORM.starttime}}", "endtime": "{{$FORM.endtime}}", "numparticipants": "{{$FORM.numparticipants}}"}, "error": "MM_popupMsg('And error has occured');"}
       );
  /* END dmxDatabaseAction name "insertRounds" */
</script>
</body>
</html>