<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Tournaments List.</title>
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "tourney" */
       jQuery.dmxDataSet(
         {"id": "tourney", "url": "../dmxDatabaseSources/tournaments.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tourney" */
</script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
</head>

<body>
<h3> Tournament Configurations</h3>

<strong>Active Tournaments</strong><br>

<ul>
	
	  <div data-binding-id="repeat1" data-binding-repeat="{{tourney.data}}"><li>{{tournament_name}} - {{tournament_startDate.formatDate( "M-dd-yyyy" )}} through {{Tournament_endDate.formatDate( "M-dd-yyyy" )}} - <a href="tournamentSetup.php?tourney={{tournament_id}}">Configure Tournament</a></li>
	  </div>
	
  </ul>

</body>
</html>