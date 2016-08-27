<?php require_once( "../../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../../loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Register for Tournaments</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/magnificent-popup/magnificent-popup.css">
    <link href="../admin_temp.css" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
    <script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
    <script type="text/javascript" src="../../bootstrap/3/js/bootstrap.js"></script>
    <script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
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
<?php include '../../Templates//parts/header.php'; ?>
		<?php include '../../Templates/parts/container-top.php'; ?>
			<?php include '../../Templates/includes/user-navigation.php'; ?>
    <div class="full_width">
      <h2>Register for Upcoming Tournaments</h2>
      <p>*You are currently logged in as "{{loggedinPlayer.data[0].user_handle}}" ({{loggedinPlayer.data[0].firstName}}{{loggedinPlayer.data[0].lastName}})</p>
           <p><strong>UPCOMING TOURNAMENTS</strong></p>
        <div class="info">
            <div data-binding-id="repeat1" data-binding-repeat="{{tournamentDates.data}}">
            <li style="margin-top: 10px;padding-top: 4px;border-top: 1px solid rgba(0, 0, 0, 0.28);"><strong>{{tournament_name}}</strong><br/><button type="button" class="button-link" onclick="location.href='../playerTournamentRegister.php?tourney={{tournament_id}}'">Register Now</button></li>
            </div>
        </div>
           <p></p>
           <p><strong>MY CURRENT TOURNAMENT REGISTRATIONS</strong></p>
        <div class="info">    
          <div title="{{tournament_name}}" data-binding-id="repeat2" data-binding-repeat="RegisteredTournament.data">
            <li>{{tournament_name}} {{tournament_startDate}} - {{Tournament_endDate}} | Details</li>
          </div>
        </div>
    </div>
  
  <div class="row">
    <div class="two_column_1">
      <h2>News</h2>
      <p>[news feed coming soon]</p>
    </div>
    <div class="two_column_1">
      <h2>Events</h2>
      <p>[Events feed coming soon]</p>
    </div>
</div>
 		<?php include '../../Templates/parts/container-bottom.php'; ?>   
<?php include '../../Templates/parts/footer.php'; ?> 