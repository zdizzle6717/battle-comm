<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Assign Rounds</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap-theme.css" />
<link href="../admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
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
</script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript" src="../../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2 class="Header">
        <h2>BattleComm.com Site Administration</h2></h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> <?php include("../nav.php"); ?></div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Site Administration</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Heading</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
      <table width="90%" border="1">
        <tbody>
          <tr>
            <td colspan="2">Player Profiles</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><a href="../../admin/players/playersLogin/user_profile_insert.php">Insert/Add New Player</a></td>
            <td><a href="../../admin/players/playersLogin/user_login_results.php">List All Player Profiles</a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><a href="../../admin/players/playersLogin/user_login_search.php">Search Player Profiles</a></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2">Clubs Admin</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>Insert/Add NewClub (Admin)</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
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
          </tr>
          <tr>
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
          </tr>
          <tr>
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
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </tbody>
      </table>
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