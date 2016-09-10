<?php require_once( "webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script type="text/javascript" src="Scripts/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="Scripts/mobile-toggle.js"></script>
	<script type="text/javascript" src="Scripts/backtotop.js"></script>
	<link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
	<script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
	<script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
	<script type="text/javascript">
	  /* dmxDataSet name "LoggedInUser" */
	       jQuery.dmxDataSet(
	         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
	       );
	  /* END dmxDataSet name "LoggedInUser" */
	  /* dmxDataSet name "tournamentAdminFilter" */
	       jQuery.dmxDataSet(
	         {"id": "tournamentAdminFilter", "url": "dmxDatabaseSources/tournamentAdminFilter.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
	       );
	  /* END dmxDataSet name "tournamentAdminFilter" */
	  /* dmxDataSet name "logged_in_player_full" */
		   jQuery.dmxDataSet(
			 {"id": "logged_in_player_full", "url": "dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
		   );
	  /* END dmxDataSet name "logged_in_player_full" */
	  /* dmxDataSet name "loggedInPlayer" */
		   jQuery.dmxDataSet(
			 {"id": "loggedInPlayer", "url": "dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
		   );
	  /* END dmxDataSet name "loggedInPlayer" */
	</script>
</head>
<?php $pathToFile = $_SERVER['DOCUMENT_ROOT'];
include ($pathToFile. "/Templates/parts/header.php"); ?>
	<?php include ($pathToFile. "/Templates/parts/container-top.php"); ?>
            <!-- Begin User Level Navigation --><!-- End User Level Navigation -->
			<div class="full_width">
				<hr>
				<h2 class="text-center push-top-2x">ACCESS DENIED</h2>
			</div>
            <p>You have attempted access to content that you do not currently have permissions to.</p>
            <p>&nbsp;</p>
            <p>If you feel this was in error, please contact us at bryce (at) battlecomm.com and let us know what what happened.</p>
            <p>If you are follwing a link from outside battlecomm.com and you got this message you can attempt to<a href="loginA.php"> login</a> to access the content (if your Battlecomm account has the correct permissions).</p>
	<?php include ($pathToFile. "/Templates/parts/container-bottom.php"); ?>
<?php include ($pathToFile. "/Templates/parts/footer.php"); ?>
