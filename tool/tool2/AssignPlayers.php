<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "tournamentPlayers" */
       jQuery.dmxDataSet(
         {"id": "tournamentPlayers", "url": "../dmxDatabaseSources/players.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentPlayers" */
</script>
</head>

<body>
<div data-binding-id="repeat1" data-binding-repeat="{{tournamentPlayers.data}}">{{user_login_id}}</div>
</body>
</html>