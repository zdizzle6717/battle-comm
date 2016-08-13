<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tournament Results feed test</title>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "TournamentResults" */
       jQuery.dmxDataSet(
         {"id": "TournamentResults", "url": "dmxDatabaseSources/TournamentResults.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TournamentResults" */

  /* dmxDataSet name "TournamentGameJoin" */
       jQuery.dmxDataSet(
         {"id": "TournamentGameJoin", "url": "dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TournamentGameJoin" */

  /* dmxDataSet name "Rounds" */
       jQuery.dmxDataSet(
         {"id": "Rounds", "url": "dmxDatabaseSources/Tournament_Rounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Rounds" */
</script>
</head>

<body>
<h1>Tournament Results Feed Test 1</h1>
<p>&nbsp;</p>
<p>{{TournamentGameJoin.data[0].tournament_name}}</p>
<p>&nbsp;</p>
<table width="60%" border="0">
  <tbody>
    <tr data-binding-repeat="{{TournamentResults.data.groupBy( &quot;tourney_round_title&quot; )}}" data-binding-id="repeat1">
      <td width="23%">{{tourney_round_title}}</td>
      <td width="77%" data-binding-repeat="{{$value}}" data-binding-id="repeat3">{{tourney_round_title}}<br>
        Session{{Game_session.groupBy( "Game_session" )}}<br/>
        <strong>{{player_handle}}</strong>-<em>{{game_result}}</em></td>
    </tr>
  </tbody>
</table>
<p>&nbsp;</p>
</body>
</html>