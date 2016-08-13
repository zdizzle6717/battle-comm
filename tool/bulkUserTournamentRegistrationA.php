<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "playerAccounts" */
       jQuery.dmxDataSet(
         {"id": "playerAccounts", "url": "dmxDatabaseSources/ActivePlayerAccounts.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "playerAccounts" */

  /* dmxDataSet name "tournament_games_join" */
       jQuery.dmxDataSet(
         {"id": "tournament_games_join", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament_games_join" */

  /* dmxDataSet name "Rounds" */
       jQuery.dmxDataSet(
         {"id": "Rounds", "url": "dmxDatabaseSources/Rounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds" */
</script>
</head>

<body>
<p>Register Users to [Tournament]</p>
<p>Game System:</p>
<p># of Sessions:</p>
<p># of Players Per Game:</p>
<p>Points for a Win:<br>
  Points for a Loss:<br>
Points for a Draw:</p>
<table width="800" border="1">
  <tr>
    <th scope="col">UserName</th>
    <th scope="col">Round</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  <tr>
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
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>