<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: {{loggedInPlayer.data[0].user_handle}}</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
    <link href="../Styles/customPlayer.css" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
    <script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "loggedInPlayer" */
       jQuery.dmxDataSet(
         {"id": "loggedInPlayer", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "loggedInPlayer" */
    </script>
<script type="text/javascript">
  /* dmxDataSet name "RoundAssignment" */
       jQuery.dmxDataSet(
         {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundAssignment" */
    </script>
<script type="text/javascript">

  /* dmxDataSet name "Tournaments" */
       jQuery.dmxDataSet(
         {"id": "Tournaments", "url": "../dmxDatabaseSources/tournamentFullList.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Tournaments" */
  /* dmxDataSet name "MyClubs" */
       jQuery.dmxDataSet(
         {"id": "MyClubs", "url": "../dmxDatabaseSources/PersonalClubs.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "MyClubs" */
    </script>
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
            <?php include '../Templates/includes/user-navigation.php'; ?>

<div class="two_column_1" style="padding-top:0px">
	<h3 style="font-size:1.5em;" >Welcome, {{loggedInPlayer.data[0].firstName}} {{loggedInPlayer.data[0].lastName}}</h3>
</div>
<div class="two_column_1" style="padding-top:0px">
    <h1 style="text-align:right; font-size:1.5em; margin:10px 0 10px;">{{loggedInPlayer.data[0].user_handle}}</h1>
</div>


<h2>Tournaments </h2>
<div class="full_width">
    <div class="info">
    <button type="button" class="button-link" onclick="location.href='../tool/tourneyRegistration/index.php'">Register</button>
    <br/>for upcoming Tournaments.
    </div>

               <h3>My Active Events</h3>
      <div class="mobile-table">
      <table border="1" class="mobile-table">
        <thead class="cf">
          <tr>
            <th><strong>Tournament</strong></th>
            <th><strong>Round</strong></th>
            <th><strong>Match/Table</strong></th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
      <tbody>
        <tr data-binding-repeat="{{RoundAssignment.data}}" data-binding-id="repeat1">
          <td>{{tournament_name}}</td>
          <td>{{tourney_round_title}}</td>
          <td>{{Game_session}}/ {{table_id}}</td>
          <td><a href="FactionAssignment.php?td={{tournament_id}}&rd={{tourney_round_id}}&gsi={{game_id}}&gs={{Game_session}}">Choose<br>
            Factions</a></td>
          <td><a href="submitscoreA.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">Submit Results</a>

          </td>
          <td><a href="scoreview.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">View Results</a></td>
          <td><a href="tournamentResultDetails.php?td={{tournament_id}}">Tournament Overview</a></td>
        </tr>
        <tr>
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
   	<script>
	/* Adds Header Labels for Mobile-Friendly */
		(function ($) {
		$.fn.rte = function () {
			var that = this;
				this.find('th').each(function (index) {
					index++;
					that.find('tr td:nth-child(' + index + ')').attr('data-title', that.find('th:nth-child(' + index + ')').text());
				});
			}
		})(jQuery);
				$('.mobile-table').rte();
	</script>
    </div>
</div>
      <h2>My Clubs</h2>
<div class="full_width">
      <div id="club" name="club" data-binding-show="{{MyClubs.data[0].club_name}}">
      <div data-binding-id="repeat2" data-binding-repeat="{{MyClubs.data}}">
        <tr>{{club_name}}</tr>
      </div>
      </div>
      <div data-binding-show="{{}}" data-binding-hide="{{MyClubs.data[0].club_name}}">
        <p>You do not currenlty belong to any clubs</p>
      </div>
      <br/>
     <button type="button" class="button-link" onclick="location.href='clubsList.php'">Join a Club</button>
</div>
<?php include '../Templates/parts/container-bottom.php'; ?>
<?php include '../Templates/parts/footer.php'; ?>
