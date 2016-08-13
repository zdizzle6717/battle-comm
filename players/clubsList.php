<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */

  /* dmxDataSet name "Clubs" */
       jQuery.dmxDataSet(
         {"id": "Clubs", "url": "../dmxDatabaseSources/Clubs.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Clubs" */
</script>
</head>
 <?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
        	<?php include '../Templates/includes/user-navigation.php'; ?>
			<h2>Available Clubs</h2>
            <br/>
            <table width="95%" border="1">
              <tbody>
                <tr>
                  <th scope="col">Club Name</th>
                  <th scope="col">Club Details</th>
                  <th scope="col">Join</th>
                </tr></tbody>
                <tr data-binding-id="repeat1" data-binding-repeat="{{Clubs.data}}">
                  <td>{{club_name}}</td>
                  <td><a href="clubDetails.php?cl={{club_key}}">View Details</a></td>
                  <td><a href="joinClub.php?cl={{club_key}}">Join</a></td>
                </tr>
                
              
            </table>
            <p>&nbsp;</p>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 