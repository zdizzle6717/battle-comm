<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("loginA.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "loggedInPlayer" */
       jQuery.dmxDataSet(
         {"id": "loggedInPlayer", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "loggedInPlayer" */
  </script>
  <script type="text/javascript">
  /* dmxDataSet name "RoundAssignment" */
       jQuery.dmxDataSet(
         {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "json"}
       );
  /* END dmxDataSet name "RoundAssignment" */
  </script>
<script type="text/javascript">

  /* dmxDataSet name "Tournaments" */
       jQuery.dmxDataSet(
         {"id": "Tournaments", "url": "../dmxDatabaseSources/tournamentFullList.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Tournaments" */
</script>
</head>

<body>
<!-- Begin User Level Navigation -->
        	<div id="PlayerNav">
                <a href="/players/index.php">Player Home</a> | <a href="/players/mydashboard.php">My Dashboard</a> | 
                <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                <a href="../tool/index.php">Tournament Admin</a> |
                  <?php } // End Show Region ?>
                <a href="user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Account</a> |
                <a href="editProfileA.php">Edit Profile (A)</a> |
                <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                  <a href="../admin/index.php"> System Administrator</a>
                  <?php } // End Show Region ?>
                 | 
                <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
                <a href="../clubsAdmin/index.php">Club Admin</a>
                <?php } // End Show Region ?>
            </div>
<!-- End User Level Navigation -->
<h2>Active Events for {{loggedInPlayer.data[0].firstName}} {{loggedInPlayer.data[0].lastName}} ({{loggedInPlayer.data[0].user_handle}})</h2>
<table width="90%" border="1">
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
      <td>{{tournament_name}}</td>
      <td>{{tourney_round_title}}</td>
      <td>{{Game_session}}/ {{table_id}}</td>
      <td><a href="FactionAssignment.php?td={{tournament_id}}&rd={{tourney_round_id}}&gsi={{game_id}}&gs={{Game_session}}">Choose<br>
        Factions</a></td>
      <td><p><a href="roundDetail.php?td={{tournament_id}}&rd={{tourney_round_id}}">View Details</a></p></td>
      <td><a href="submitscore.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">Submit Results</a>
        
        </td>
      <td><a href="scoreview.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">View Results</a></td>
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

</body>
</html>