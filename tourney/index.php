<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Assign Rounds</title>
<link rel="stylesheet" type="text/css" href="../tool/bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../tool/bootstrap/3/css/bootstrap-theme.css" />
<link href="../tool/admin_temp.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../tool/ScriptLibrary/dmxDatabaseAction.js"></script>
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

  /* dmxDataSet name "TournamentFullList" */
       jQuery.dmxDataSet(
         {"id": "TournamentFullList", "url": "../dmxDatabaseSources/tournamentFullList.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "TournamentFullList" */
</script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<link rel="stylesheet" type="text/css" href="../fontawesome/css/font-awesome.min.css" />
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2><img src="../images/BC_Web_Logo_alt.png" width="538" height="125" alt=""/></h2>
    </div>
  </div>
  <div class="row" id="nav">
  	<div class="col-lg-12"> <?php include("nav.php"); ?></div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Battle-Comm Administration</h2>
      <ul>
        <li>Game Systems Admin
          <ul>
            <li>Game Categories Admin</li>
          </ul>
        </li>
        <li>Tournament Admin
          <ul>
            <li>Create New Tournament</li>
            <li>List My Tournaments</li>
          </ul>
        </li>
        <li>Venue Admin
          <ul>
            <li>Add New Venue</li>
          </ul>
        </li>
        <li>Add/Edit Objectives/Missions</li>
        <li>Player/Tournament Registration</li>
      </ul>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Current Tournaments</h2>
      <table width="875" border="1" align="center">
        <tbody>
          <tr data-binding-repeat="{{TournamentFullList.data}}" data-binding-id="repeat1">
            <td width="341">{{tournament_name}}</td>
            <td width="221">{{tournament_startDate.formatDate( "MM.dd.yyyy" )}}</td>
            <td width="254">{{Tournament_endDate.formatDate( "MM.dd.yyyy" )}}</td>
            <td width="31"><i class="fa fa-pencil fa-2x"></i></td>
          </tr>
          <tr>
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
      
    </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
</body>
</html>