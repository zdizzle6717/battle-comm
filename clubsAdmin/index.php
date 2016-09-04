<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("ClubAdmin")){
	WA_Auth_RestrictAccess("../accessdenied.php");
}
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
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
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */

  /* dmxDataSet name "ClubsByOwner" */
       jQuery.dmxDataSet(
         {"id": "ClubsByOwner", "url": "../dmxDatabaseSources/ClubByOwner.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "ClubsByOwner" */
</script>
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
        	<?php include '../Templates/includes/user-navigation.php'; ?>
			<div class="full_width">
				<hr>
				<h2 class="push-top-2x">Club Admin</h2>
			</div>
            <button type="button" class="button-link" onclick="location.href='clubinsert.php'">Add/Insert New Club</button>
            <br/>
           <h3>My Clubs</h3>
           <div class="full_width">
           <table width="95%" border="1">
             <tbody>
               <tr>
                 <th scope="col">Club Name</th>
                 <th scope="col">Members</th>
                 <th scope="col">Edit</th>
                 <th scope="col">Delete</th>
               </tr>
               <tr style="text-align: center" data-binding-repeat="{{ClubsByOwner.data}}" data-binding-id="repeat1">
                 <th scope="row">{{club_name}}</th>
                 <td>[ComingSoon]</td>
                 <td>Edit Club</td>
                 <td>Delete Club</td>
               </tr>
             </tbody>
           </table>
            </div>
            <h3>Membership Requests (Coming Soon)</h3>
 		<?php include '../Templates/parts/container-bottom.php'; ?>
<?php include '../Templates/parts/footer.php'; ?>
