<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Assign Rounds</title>
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="bootstrap/3/css/bootstrap-theme.css" />
<link href="admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript">
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

  /* dmxDataSet name "news" */
       jQuery.dmxDataSet(
         {"id": "news", "url": "../../dmxDatabaseSources/news.php", "data": {"sort": "news_date_published", "limit": "3"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "news" */

  /* dmxDataSet name "tourneyGame_Join" */
       jQuery.dmxDataSet(
         {"id": "tourneyGame_Join", "url": "../dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tourneyGame_Join" */

  /* dmxDataSet name "Round" */
       jQuery.dmxDataSet(
         {"id": "Round", "url": "../dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Round" */
  /* dmxDataSet name "gamePlayers_byRound" */
       jQuery.dmxDataSet(
         {"id": "gamePlayers_byRound", "url": "../dmxDatabaseSources/tournamentGamePlayers_byRound.php", "data": {"rd": "{{$URL.rd}}", "tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "gamePlayers_byRound" */
</script>
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>Header</h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> <?php include("nav.php"); ?></div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Overview for [{{tourneyGame_Join.data[0].tournament_name}}]/[{{Round.data[0].Round_Title}}]</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Session Overview/Edit/Approve</h2>
      <table width="95%" border="1">
        <tbody>
          <tr>
            <th scope="col">Handle</th>
            <th scope="col">Match</th>
            <th scope="col">Table</th>
            <th scope="col">Result</th>
            <th scope="col">Game Point</th>
            <th scope="col">Mission Points</th>
            <th scope="col">Total Points</th>
            <th scope="col">Approve</th>
          </tr>
          <tr data-binding-repeat="{{gamePlayers_byRound.data}}" data-binding-id="repeat2">
            <td><input name="playerID" type="hidden" id="playerID" value="{{player_id}}" data-binding-value="{{player_id}}">
              {{player_handle}}</td>
            <td>{{Game_session}}</td>
            <td>{{table_id}}</td>
            <td><input name="GameResult{{$index}}" type="text" id="{{game_result}}" value="{{game_result}}"></td>
            <td><input name="gamePoints{{repeat2.$index}}" type="text" id="gamePoints{{$index}}" value="{{game_points}}"></td>
            <td><input name="tiebreakerPoints{{$index}}" type="text" id="tiebreakerPoints{{$index}}" value="{{mission_points}}"></td>
            <td><input name="totalPoints{{$index}}" type="text" id="totalPoints{{$index}}" value="{{total_points}}"></td>
            <td><input type="checkbox" name="checkbox" id="checkbox"></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
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
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
      <p>&nbsp;</p>
      <p>
      </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>News</h2>
      <div id="newsWrapper" data-binding-id="repeat1" data-binding-repeat="{{news.data}}"><img src="" width="120" data-binding-src="{{featured_image}}" align="texttop" /><strong>{{news_title}}</strong> -{{news_date_published}} - {{news_callout.trunc( 50, true, "…" )}} <a href="#">[Read More...]</a></div>
    </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
</body>
</html>