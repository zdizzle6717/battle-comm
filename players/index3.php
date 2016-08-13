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
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="/Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="/Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="/Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="/Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="/Styles/magnificent-popup/magnificent-popup.css">
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script>
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
  /* dmxDataSet name "tournamentRoundPlayers" */
       jQuery.dmxDataSet(
         {"id": "tournamentRoundPlayers", "url": "../dmxDatabaseSources/tournamentRoundPlayers.php", "data": {"game_session_ID": "{{$FORM.game_session_ID}}", "player_round_ID": "{{$FORM.player_round_ID}}", "player_table_ID": "{{$FORM.player_table_ID}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournamentRoundPlayers" */
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
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
<!-- Begin User Level Navigation -->
        	<div id="PlayerNav">
                <a href="/players/index.php">Player Home</a> | <a href="/players/mydashboard.php">My Dashboard</a> | 
                <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                <a href="../tool/index.php">Tournament Admin</a> |
                  <?php } // End Show Region ?>
                <a href="user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Account</a> |
                
                <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                  <a href="../admin/index.php"> System Administrator</a>
                  <?php } // End Show Region ?>
                 | 
                <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
                <a href="../clubsAdmin/index.php">Club Admin</a>
                <?php } // End Show Region ?>
            </div>
<!-- End User Level Navigation -->
            <div class="customizedPageTitle">
            	<h2>Welcome, {{loggedInPlayer.data[0].firstName}} {{loggedInPlayer.data[0].lastName}} - {{loggedInPlayer.data[0].user_handle}}            	</h2>
</div></p>
            
           
<h2>Tournaments </h2>
<a href="../tool/tourneyRegistration/index.php">Register for upcoming Tournaments</a>

           <h3>My Active Events</h3>
           <p>
           <table width="90%" border="1" align="left">
  <tbody>
    <tr>
      <th scope="col">Tournament</th>
      <th scope="col">Round</th>
      <th scope="col">Match/Table</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr data-binding-repeat="{{RoundAssignment.data}}" data-binding-id="repeat1">
      <td>{{tournament_name}}<input name="tourneyID" type="hidden" id="tourneyID" value="{{tournament_id}}"></td>
      <td>{{tourney_round_title}}<input name="player_round_ID" type="hidden" id="player_round_ID" value="{{tourney_round_id}}"><br>
     <div data-binding-repeat="{{tournamentRoundPlayers.data}}" data-binding-id="repeat4">{{player_handle.join( "/", "player_handle" )}}     </div>
	  </td>
      <td>{{Game_session}}/ {{table_id}}
                <input name="game_session_ID" type="hidden" id="game_session_ID" value="{{Game_session}}"> <input name="player_table_ID" type="hidden" id="player_table_ID" value="{{table_id}}"></td>
      <td><a href="FactionAssignment.php?td={{tournament_id}}&rd={{tourney_round_id}}&gsi={{game_id}}&gs={{Game_session}}">Choose<br>
        Factions</a></td>
      <td><a href="submitscoreA.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">Submit Results</a>
        
      </td>
      <td><a href="scoreview.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">View Results</a></td>
      <td><a href="tournamentResultDetails.php?td={{tournament_id}}">Tournament Overview</a></td>
    </tr>
  </tbody>
</table>
          </p> 
          <p><h2>My Clubs</h2>
          <div id="club" name="club" data-binding-show="{{MyClubs.data[0].club_name}}">
          <div data-binding-id="repeat2" data-binding-repeat="{{MyClubs.data}}">
            <tr>{{club_name}}</tr>
          </div>
          </div>
          <div data-binding-show="{{}}" data-binding-hide="{{MyClubs.data[0].club_name}}">
            <p>You do not currenlty belong to any clubs</p>
          </div>
          </p>
                     
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 