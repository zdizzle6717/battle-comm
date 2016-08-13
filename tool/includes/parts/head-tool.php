<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Register for Tournaments</title>
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/magnificent-popup/magnificent-popup.css">
<link href="../admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="../../bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript" src="../../js/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../../js/mobile-toggle.js"></script>
<script type="text/javascript" src="../../js/backtotop.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "tournamentDates" */
       jQuery.dmxDataSet(
         {"id": "tournamentDates", "url": "../../dmxDatabaseSources/tournamentDates.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentDates" */

  /* dmxDataSet name "loggedinPlayer" */
       jQuery.dmxDataSet(
         {"id": "loggedinPlayer", "url": "../../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "loggedinPlayer" */

  /* dmxDataSet name "RegisteredTournament" */
       jQuery.dmxDataSet(
         {"id": "RegisteredTournament", "url": "../../dmxDatabaseSources/RegisteredTournaments.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RegisteredTournament" */
</script>
</head>