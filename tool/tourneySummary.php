<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script type="text/javascript" src="ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "TournamentSummary" */
       jQuery.dmxDataSet(
         {"id": "TournamentSummary", "url": "dmxDatabaseSources/Tournament_Full.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TournamentSummary" */
  /* dmxDataSet name "TournamentRounds" */
       jQuery.dmxDataSet(
         {"id": "TournamentRounds", "url": "dmxDatabaseSources/tourneyRounds.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TournamentRounds" */
</script>
</head>

<body>
<h2>Summary of Setup for {{TournamentSummary.data[0].tournament_name}}</h2>

<div id="main" class="content">
  <p>Dates:{{TournamentSummary.data[0].tournament_startDate}} - {{TournamentSummary.data[0].Tournament_endDate}}</p>
  <p>{{TournamentSummary.data[0]["tournament_location _name"]}}</p>
  <p>{{TournamentSummary.data[0].tournament_address}}<br>
  {{TournamentSummary.data[0].tournament_city}} {{TournamentSummary.data[0].tournament_state}}, {{TournamentSummary.data[0].tournament_zip}}</p>
  <p>p-{{TournamentSummary.data[0].tournament_phone}} | f-[Fax]</p>
  <p>e-{{TournamentSummary.data[0].tournament_email}} | Contact: {{TournamentSummary.data[0].tournament_admin_id}}</p>
  <p>{{TournamentSummary.data[0].tournament_URL}}</p>
  <hr>
  <p><strong>Schedule</strong></p>
  <ul>
 <div data-binding-id="repeat1" data-binding-repeat-children="{{TournamentRounds.data}}">
   <li>Round &quot;<strong>{{Round_Title}}</strong>&quot; - {{startTime}} to {{endTime}} | {{num_participants}} tables playing [ Game] with [win] for a win, [loss] for a loss, and [draw] for a draw.
  
 </li> </div>
 </ul>
  <p>&nbsp;</p>
  <p>Tiebreakers:</p>
  <ul>
    <li>[TieBreakers]- [points]<br>
    </li>
  </ul>
</div>
</body>
</html>