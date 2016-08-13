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
<title>BattleComm: Tournament</title>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "/dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "RoundAssignment" */
       jQuery.dmxDataSet(
         {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundAssignment" */
</script>
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
				<?php include '../Templates/includes/user-navigation.php'; ?>
                             <h2>My Events</h2>
                             <table width="95%" border="1">
                              <tbody>
                                <tr>
                                  <th scope="col">Tournament</th>
                                  <th scope="col">Round</th>
                                  <th scope="col">Match/Table</th>
                                  <th scope="col">&nbsp;</th>
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
                                  <td><a href="tournamentResultDetails.php?td={{tournament_id}}">Tournament Details</a></td>
                                </tr>
                              </tbody>
                            </table>
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 