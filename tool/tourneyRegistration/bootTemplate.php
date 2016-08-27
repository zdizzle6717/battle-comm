<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="../admin_temp.css" rel="stylesheet" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../bootstrap/3/css/bootstrap-theme.css" />
<script type="text/javascript" src="../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../bootstrap/3/js/bootstrap.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "tourneyGame" */
       jQuery.dmxDataSet(
         {"id": "tourneyGame", "url": "../dmxDatabaseSources/tournament_gameJoin.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "1"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tourneyGame" */

  /* dmxDataSet name "playersFiltered" */
       jQuery.dmxDataSet(
         {"id": "playersFiltered", "url": "../dmxDatabaseSources/playerListFiltered.php", "data": {"up": "{{$URL.up}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "playersFiltered" */
</script>
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <h2>{{tourneyGame.data[0].tournament_name}}      </h2>
      <p>{{tourneyGame.data[0].tournament_startDate.formatDate( "M dd yyyy" )}}- {{tourneyGame.data[0].Tournament_endDate.formatDate( "M dd yyyy" )}}</p>
      <p>{{tourneyGame.data[0].tournament_info}}</p>
      <p>Featuring {{tourneyGame.data[0].tournament_rounds}} rounds of {{tourneyGame.data[0].game_system_Title}}</p>
      <p>{{tourneyGame.data[0]["tournament_location _name"]}}      <br>
      {{tourneyGame.data[0].tournament_address}} {{tourneyGame.data[0].tournament_city}} {{tourneyGame.data[0].tournament_state}}, {{tourneyGame.data[0].tournament_zip}}</p>
      <p>For more information contact {{tourneyGame.data[0].tournament_admin_name}}<br>
p {{tourneyGame.data[0].tournament_phone}} e {{tourneyGame.data[0].tournament_email}}</p>
      <p>or vist {{tourneyGame.data[0].tournament_name}} at {{tourneyGame.data[0].tournament_URL}}</p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <h2>Register for Tournament</h2>
      <p>By submitting the information below I am indicating that I would like to participate as an active player in {{tourneyGame.data[0].tournament_name}} and will play in all rounds that I am eligiable. Leagalese legalese, etc, etc. Blah blah blah, and so on and so on.</p>
      <form action="" method="post" name="form1">
      <div class="form-group">
        <label class="control-label" for="textfield">Handle/Username:</label>
        <div class="controls">
          <input name="textfield" type="text" class="input-group-lg" id="textfield" placeholder="Text Field" size="50" data-binding-value="{{playersFiltered.data[0].username}}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="textfield">First Name:</label>
        <div class="controls">
          <input name="textfield" type="text" id="textfield" placeholder="Text Field" size="50" data-binding-value="{{playersFiltered.data[0].user_firstName}}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="textfield">Last Name:</label>
        <div class="controls">
          <input name="textfield" type="text" id="textfield" placeholder="Text Field" size="50" data-binding-value="{{playersFiltered.data[0].user_lastName}}">
        </div>
      </div>
      <div class="form-group">
        <label class="control-label" for="textfield">Email:</label>
        <div class="controls">
          
          <input name="email" type="email" id="email" size="50" data-binding-value="{{playersFiltered.data[0].user_email}}">
        </div>
      </div>
      <p>
        <input type="submit" name="submit" id="submit" value="Submit">
      <p>      
      </form></p>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-6">
      <h2>Footer Left	</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
    <div class="col-lg-6">
      <h2>Footer Right</h2>
      <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
    </div>
  </div>
</div>
</body>
</html>