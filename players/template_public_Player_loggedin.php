<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../../js/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../../js/mobile-toggle.js"></script>
<script type="text/javascript" src="../../js/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../css/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
  /* dmxDataSet name "RoundAssignment" */
       jQuery.dmxDataSet(
         {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundAssignment" */
</script>
</head>

<body>
<!--ProfileNav script and structure -->
    	<!-- HEADER -->
        <div class="nav placeholder center" id="returnhome">
        </div>
        <div class="nav row center">
<script type="text/javascript">
<!--
	function toggle_visibility(id) {
	   var e = document.getElementById(id);
	   if(e.style.display == 'block')
		  e.style.display = 'none';
	   else
		  e.style.display = 'block';
	}
//-->
</script>
<?php $pathtofile = $_SERVER['DOCUMENT_ROOT']; ?>
<div class="profilenav"><a onclick="toggle_visibility('account-nav');"><img src="../uploads/player/{{LoggedInUser.data[0].user_handle}}/{{LoggedInUser.data[0].user_icon}}" alt="{{LoggedInUser.data[0].user_handle}}" width="37"/></a>
    <div id="account-nav">
    	<div class="account_name">{{LoggedInUser.data[0].firstName}} {{LoggedInUser.data[0].lastName}}</div>
      <ul class="accountnav no_bullets">
        	<li><a href="index.php">Player Home</a></li>
            <li><a href="../playerProfile/EditProfileA.php">My Profile</a></li>
            <li><a href="#">Messages</a></li>
            <li><a href="../logout.php">Logout</a></li>
        </ul>
    </div>
</div>
<!--End ProfileNav structure -->
		<?php $toplevel = $_SERVER['DOCUMENT_ROOT']. "/Templates/parts/";
    		 include ($toplevel. "header.php"); ?>
        <?php include ($toplevel. "container-top.php"); ?>
<!-- Begin User Level Navigation -->
        <div id="PlayerNav">
                    <a href="/players/index.php">Player Home</a> |  <a href="/players/mytournaments.php">My Dashboard </a>
                    <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                    | <a href="../tool/index.php">Tournament Admin</a> |
                    <?php } // End Show Region ?>
                    <a href="playerProfile/EditProfileA.php">Edit Account</a>
                    <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                    | <a href="../admin/index.php"> System Administrator </a> |
                    <?php } // End Show Region ?>
                    <a href="../clubsAdmin/index.php">
                    <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
                    Club Admin
                    <?php } // End Show Region ?>
                    </a></div>
<!-- End User Level Navigation -->
			<h2>{{LoggedInUser.data[0].firstName}} {{LoggedInUser.data[0].lastName}} Dashboard</h2>
			<h4>Active Events</h4>
			</p>
                             <table width="95%" border="1">
  <tbody>
    <tr>
      <td>Tournament Name</td>
      <td>Round</td>
      <td>Match/Table</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr data-binding-repeat="{{RoundAssignment.data}}" data-binding-id="repeat1">
      <td>{{tournament_name}}</td>
      <td>{{tourney_round_title}}</td>
      <td>Match {{Game_session}}/ Table {{table_id}}</td>
      <td><a href="FactionAssign2.php?tourney={{tournament_id}}&rd={{tourney_round_id}}&gsi={{game_id}}&gs={{Game_session}}">Choose<br>
        Factions</a></td>
      <td><p><a href="roundDetail.php?tourney={{tournament_id}}&rd={{tourney_round_id}}">View Details</a></p></td>
      <td><p><a href="../tool/overviewRevA.php?tourney={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">Submit Results</a></p>
        
        <p>&nbsp;</p></td>
    </tr>
  </tbody>
</table></p>
            
           <p><h4>My Profile</h4> Sed orci purus, tempor nec commodo ut, tincidunt a sem. In nec imperdiet leo. Sed aliquet ut purus a commodo. Nunc facilisis quam sagittis ex cursus, consequat sodales quam accumsan. Maecenas pulvinar neque facilisis consequat maximus. Pellentesque tempor venenatis vehicula. Fusce est elit, consectetur id magna at, viverra ullamcorper nisl. Proin posuere ut ligula id aliquam. Vivamus ac tristique justo, non imperdiet neque. In vitae nisl nec lorem cursus tempus.</p>
            <p>
            Vivamus sed egestas urna. Nunc odio purus, laoreet quis sagittis vitae, imperdiet ut urna. Cras tortor ligula, ultrices non vehicula id, finibus at lacus. Etiam venenatis, felis ut elementum tincidunt, nulla lorem vulputate ante, sed volutpat quam odio quis metus. Donec mollis blandit risus vitae tincidunt. Duis sit amet congue mauris. Phasellus egestas ligula at lacus suscipit tristique.</p>
            
           <p> Integer at nisl sollicitudin, iaculis quam non, iaculis dui. Cras quis erat vel elit tempor faucibus. Quisque malesuada aliquam dui in cursus. Praesent eu egestas est, a pretium lorem. Proin sem diam, dapibus eu fermentum vitae, tincidunt a felis. Donec sollicitudin et augue id luctus. Etiam maximus vitae orci a efficitur. Suspendisse nec imperdiet lacus. Pellentesque vulputate erat ac ornare mattis. Aenean ligula ex, congue non ligula id, molestie mollis felis. Aliquam sem eros, mollis quis enim id, pretium lacinia leo. Etiam hendrerit eros eget sapien gravida, et molestie erat maximus. Vivamus malesuada a magna non vehicula. Maecenas maximus justo leo, in vulputate arcu volutpat ut. Maecenas et tempor dui. Cras id suscipit arcu, sed gravida enim.</p>
            
           <p> Sed quis dolor et dolor sodales placerat. Pellentesque ut consectetur neque. Etiam interdum massa nec nisl semper, et commodo quam placerat. Sed eu magna massa. Nullam dignissim pulvinar purus sed sodales. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse lobortis nec erat id varius. Aenean et dictum nulla, ac fringilla quam. Donec gravida metus orci, semper suscipit lacus fringilla fringilla. Nulla et congue dolor. Duis nec mi ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi rhoncus mauris sit amet velit semper, ut vestibulum ligula sollicitudin.</p>
		<?php include ($toplevel. "container-bottom.php"); ?>
<?php include ($toplevel. "footer.php"); ?>