<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: User Profile</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/profile.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
    <link href="../includes/jQueryTabs/jQueryTabs1.css" rel="stylesheet" type="text/css">
    <link type="text/css" title="css-layouts-ignore" rel="stylesheet" href="../includes/jQueryTabs/font-awesome-4.2.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>    
    <script type="text/javascript" src="../includes/jQueryTabs/extendjQueryTabs.js"></script>
    <script type="text/javascript" src="../includes/jQueryTabs/jQueryTabs.js"></script>
    <script src="../includes/jQueryTabs/jQueryTabs1.js" type="text/javascript"></script>
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
      /* dmxDataSet name "PlayerProfile" */
           jQuery.dmxDataSet(
             {"id": "PlayerProfile", "url": "../../dmxDatabaseSources/PlayerProfileEdit.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
           );
      /* END dmxDataSet name "PlayerProfile" */
      /* dmxDataSet name "RoundAssignment" */
           jQuery.dmxDataSet(
             {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
           );
      /* END dmxDataSet name "RoundAssignment" */
    </script>
</head>
<?php include '../Templates//parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
                <div class="two_column_1">
                  <h2 class="center no_shadow">Update User Profile</h2>
                    	<p class="user-bio">This is a sample bio.  New functionality to modify your profile will be added in the near future.</p>
                        <!--
                        
                    	<div id="jQueryTabs1" class="jQueryTabs_container skin7">
                    	  <div class="jQueryTabs_nav">
                    	    <ul class="jQueryTabs_navUL">
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content1" class="jQueryTabs_navLink selected"> <i class="jQueryTabs_navImg fa fa-home"></i> <span class="jQueryTabs_navSpan">Home</span> </a> </li>
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content2" class="jQueryTabs_navLink"> <i class="jQueryTabs_navImg fa fa-book"></i> <span class="jQueryTabs_navSpan">Login</span> </a> </li>
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content3" class="jQueryTabs_navLink"> <i class="jQueryTabs_navImg fa fa-pencil"></i> <span class="jQueryTabs_navSpan">Edit Profile</span> </a> </li>
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content4" class="jQueryTabs_navLink"> <i class="jQueryTabs_navImg fa fa-cog"></i> <span class="jQueryTabs_navSpan">Change Icon</span> </a> </li>
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content5" class="jQueryTabs_navLink"> <i class="jQueryTabs_navImg fa fa-camera-retro"></i> <span class="jQueryTabs_navSpan">Upload/Edit Photos</span> </a> </li>
                  	      </ul>
                  	    </div>
                    	  <div class="jQueryTabs_content">
                    	    <div id="jQueryTabs1_content1" class="jQueryTabs_contentDivs">
                    	      <h1>Tab 1 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  	      </div>
                    	    <div id="jQueryTabs1_content2" class="jQueryTabs_contentDivs hidden">
                    	      <h1>Tab 2 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  	      </div>
                    	    <div id="jQueryTabs1_content3" class="jQueryTabs_contentDivs hidden">
                    	      <h1>Tab 3 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  	      </div>
                    	    <div id="jQueryTabs1_content4" class="jQueryTabs_contentDivs hidden">
                    	      <h1>Tab 4 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  	      </div>
                    	    <div id="jQueryTabs1_content5" class="jQueryTabs_contentDivs hidden">
                    	      <h1>Tab 5 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              
                          
                  	      </div>
                  	    </div>
                           
                  	  </div>
                       -->
                </div>
                <div class="two_column_1">
                	<div class="center"><br/><img src="../images/profile_image_default.png" alt="" class="shadow"/></div>
                    <h1 class="center">[username]</h1>
        			<div class="center">
                        <ul class="inline">
                            <li class="item"><a class="" href="#" target="_self">Send a Message</a></li>
                            <li><a href="#">Create Match</a></li>
                            <li><a href="#">Add as Friend</a></li>
                        </ul>
                    </div>
                </div>
                <div class="full_width">
                	<div class="two_column_1">
                    	   <h2 class="center">Info</h2>
                            <ul class="list">
                              <li class="">Available to Play: <b>&nbsp;Yes</b></li>
                              <li class="">Local to you: &nbsp;Yes &nbsp; Approx Distance: 10 mi</li>
                              <li class="">Local Store: <a href="#" target="_self" class="anchor3">DryRox Games and Artisinal Cheeses</a></li>
                              <li class="">Games: &nbsp;Chess, Warhammer 40K, Magic.</li>
                            </ul>            	
                    </div>
                    <div class="two_column_1">
                    	<div class="recent_articles">
                          <h2>Recent Activity</h2>
                          <ul>
                            <li> <a href="#">Played [Game] with [Username] and [Username]</a>
                              <div class="separator"></div>
                            </li>
                            <li> <a href="#">Played [Game] with [Username]</a>
                              <div class="separator"></div>
                            </li>
                            <li> <a href="#">Signed up for [Tournament]</a>
                              <div class="separator"></div>
                            </li>
                            <li> <a href="#">Attended [Event] at [FLGS]</a>
                              <div class="separator"></div>
                            </li>
                          </ul>
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="full_width">
                	<h2>Photostream</h2>
                	<div class="center thumbnail">
                    	<img src="../media/filler/dice.png" alt="" />
                    	<img src="../media/filler/game1.jpeg" alt=""/> 
                        <img src="../media/filler/game3.jpg" alt=""/>
                    	<img src="../media/filler/game2.jpg" alt=""/> 
                    </div>
                </div>  
 		<?php include '../Templates/parts/container-bottom.php'; ?>   
<?php include '../Templates/parts/footer.php'; ?> 