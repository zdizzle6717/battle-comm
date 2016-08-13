<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript">
/* dmxDataSet name "tournamentsFiltered" */
       jQuery.dmxDataSet(
         {"id": "tournamentsFiltered", "url": "../dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentsFiltered" */

  /* dmxDataSet name "RoundsFiltered" */
       jQuery.dmxDataSet(
         {"id": "RoundsFiltered", "url": "../dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundsFiltered" */

  /* dmxDataSet name "factions" */
       jQuery.dmxDataSet(
         {"id": "factions", "url": "../dmxDatabaseSources/factions.php", "data": {"gsi": "{{$URL.gsi}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "factions" */

  /* dmxDataSet name "AssignedFactions" */
       jQuery.dmxDataSet(
         {"id": "AssignedFactions", "url": "../dmxDatabaseSources/AssignedFactionsForRound.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "gs": "{{$URL.gs}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "AssignedFactions" */
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

<body class="PlayerGameDetail">
<p><strong>Available Factions for</strong> {{tournamentsFiltered.data[0].game_title}}</p>
<table width="400" border="1">
  <tbody>
    <tr>
      <th width="220" scope="col">Faction</th>
      <th width="364" scope="col">Join</th>
    </tr>
    <tr data-binding-repeat="{{factions.data}}" data-binding-id="repeat1">
      <td>{{faction_id}}
<div data-binding-html="{{faction_id}}"></div>
        <input name="FacName" type="text" id="FacName" value="{{faction_name}}" readonly>
      <input name="IDforFaction" type="hidden" id="IDforFaction" value="{{faction_id}}" data-binding-value="{{faction_id}}"></td>
      <td style="text-align: center"><input name="button" type="button" id="button" onClick="dmxDatabaseActionControl('run','FactionAssign',{},this)" value="Join Faction"></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
<script type="text/javascript">
  /* dmxDatabaseAction name "FactionAssign" */
       jQuery.dmxDatabaseAction(
         {"id": "FactionAssign", "url": "../dmxDatabaseActions/AssignFactions.php", "data": {"factions_Name": "{{$FORM.FacName}}", "factions_id": "{{$FORM.IDforFaction}}", "tourney": ""}}
       );
  /* END dmxDatabaseAction name "FactionAssign" */
</script>
</body>
</html>