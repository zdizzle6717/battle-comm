<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: Events</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/magnificent-popup/magnificent-popup.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="Scripts/jquery.magnificant-popup.js"></script>
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
</head>
<?php include 'Templates/parts/header.php'; ?>    
        
        <!-- Middle -->
        <div class="mids">
        	<div class="container_full_width_table no_shadow no_background no_padding">
        		<div class="full_content col" >
                    <div class="frame_u row">
                        <div class="frame_u_bar_full col">
                        	<div class="title_large"><img src="images/Titles/Events.png" alt=""/></div>
                        </div>
                        <div class="frame_ul_corner col"></div>
                        <div class="frame_ur_corner col"></div>
                    </div>
                    <div class="frame_content row">
                        <div class="frame_l_bar col"></div>
                        <div class="frame_r_bar col"></div>
                        <div class="frame_center col">
                            <div class="full_width">
                            	<h2 style="margin:35px 0 10px 0;">My Game Schedule</h2>
                                <ul class="card_bullets">
                                	<li><a href="tool/tourneyRegistration/index.php">Currently Registered</a></li>
                                	<li><a href="tool/tourneyRegistration/index.php">Past Event Listing</a></li>
                                    <li><a href="tool/tourneyRegistration/index.php">Ranking</a></li>
                                </ul>
                            </div>
                        	<div class="full_width">
                            	<h2 style="margin:15px 0 10px 0;">Tournaments</h2>
                                <div class="two_column_1">
                                	<h3>Local</h3>
                                	<a href="tool/tourneyRegistration/index.php"><img src="media/local-tournament.jpg" class="fill" alt=""/></a>
                                </div>
                                <div class="two_column_1">
                                	<h3>State</h3>
                                    <a href="tool/tourneyRegistration/index.php"><img src="media/state-tournament.jpg" class="fill" alt=""/></a>
                                </div>
                                <div class="two_column_1">
                                	<h3>National</h3>
                                    <a href="tool/tourneyRegistration/index.php"><img src="media/national-tournament.jpg" class="fill" alt=""/></a> 
                                </div>
                                <div class="two_column_1">
                                	<h3>Worldwide</h3>
                                    <a href="tool/tourneyRegistration/index.php"><img src="media/worldwide-tournament.jpg" class="fill" alt=""/></a> 
                                </div>
            				</div>
                            <div class="full_width">
                            	<h2 style="margin:20px 0 10px 0;">Locations</h2>
                                <div class="three_column_1">
                                	<h3>Friendly Local Gaming Stores (FLGS)</h3>
                                    <a href="tool/tourneyRegistration/index.php"><img src="media/flgs-locations.jpg" class="fill" alt=""/></a> 
                                </div>
                                <div class="three_column_1">
                                	<h3>Venues</h3>
                                    <a href="tool/tourneyRegistration/index.php"><img src="media/venue-locations.jpg" class="fill" alt=""/></a> 
                                </div>
                                <div class="three_column_1">
                                	<h3>Independent</h3>
                                    <a href="tool/tourneyRegistration/index.php"><img src="media/independent-locations.jpg" class="fill" alt=""/></a> 
                                </div>
            				</div>
	<?php include 'Templates/parts/container-bottom.php'; ?>
<?php include 'Templates/parts/footer.php'; ?>