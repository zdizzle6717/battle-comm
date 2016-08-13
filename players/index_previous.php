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
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "logged in player" */
       jQuery.dmxDataSet(
         {"id": "logged in player", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged in player" */
</script>
</head>

    <body>
    	<!-- HEADER -->
        <div class="nav placeholder center" id="returnhome">
        </div>
        <div class="nav row center">
        	<?php include 'includes/account-nav.php'; ?>
            <div class="mobilenav">
                <?php include 'includes/top-navigation.php'; ?>
            </div>
            <div class="uppernav">
                <?php include 'includes/top-navigation.php'; ?>
            </div>
           	<script type="text/javascript">
				$('.scrollDown').click(function(){
					$('html, body').animate({
						scrollTop: $( $(this).attr('href') ).offset().top
					}, 800);
					return false;
				});
			</script>
		</div>
        <div class="site_bg"></div>
        <div class="header row center">
            <div class="logo"><a href="../index.php"><img src="../images/BC_Web_Logo.png" alt="BattleComm"></a></div>
            <div class="mobile-logo"><a href="../index.php"><img src="../images/BC_Web_Logo_mobile.png" alt="BattleComm"></a>
                <div class="mobile-buttons">
                    <div class="my-profile-button"><a href="../admin/user/profile-edit.php"><img src="../images/BC_App_MyProfile.png" alt="BattleComm"></a></div><div class="create-match-button"><a href="../match.php"><img src="../images/BC_App_CreateMatch.png" alt="BattleComm"></a></div>
                </div>
            </div>
        </div>
        
  
        <!-- Middle -->
        <div class="mids">
        	<div class="container_full_width_table no_shadow no_background no_padding">
        		<div class="full_content col" >
                    <div class="frame_u row">
                        <div class="frame_u_bar_full col">
                        	<div class="title_small"><img src="../images/Titles/Welcome.png" alt="Welcome"></div>
                        </div>
                        <div class="frame_ul_corner col"></div>
                        <div class="frame_ur_corner col"></div>
                    </div>
                    <div class="frame_content row">
                        <div class="frame_l_bar col"></div>
                        <div class="frame_r_bar col"></div>
                        <div class="frame_center col">
                        	<div class="full_width">
                            	<h1>Player: <?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></h1>
                              <!--<p><h2>Tournament Admin</h2></p>
                                  <ul>
                                    <li><a href="../tool/tournamentAdmin/tournament_insert.php">Create Tournament</a></li>
                                    <li><a href="../tool/tournamentAdmin/tournament_results.php">List My Tournaments</a></li>
                                    <li><a href="/tool/index.php">Tournament Admin Page</a></li>
                                  </ul>-->
                              <p><h2>Tournaments</h2></p>
                              <ul class="card_bullets">
                              	<li><a href="../tool/tourneyRegistration/index.php">Register for upcoming Tournaments</a></li>
                              	<li><a href="mytournaments.php">My Tournaments</a></li>
                              </ul>
                             <p><h2>Venue Admin</h2></p>
                             <ul class="card_bullets">
                             	<li><a href="../admin/venue/venue_insert.php">Create Venue</a></li>
                                <li><a href="../admin/venue/venue_results.php">List My Venues</a></li>
                             </ul>
                             <p><h2>My Settings</h2></p>
                             <ul class="card_bullets">
                             	<li><a href="user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Profile</a></li>
                                <li>Edit Icon</li>
                                <li>Edit Login</li>
                                <li>Edit Privacy</li>
                             
                             </ul>
                            
                        	</div>
                   		</div>
					</div>
                   <?php include("../includes/lowernav.php"); ?>
                </div>
            </div>
        </div>
              
        
        <!-- FOOTER -->
        <div class="footer">
            <div class="sub-footer center" id="contact">
                <div class="three_column_1 subfooter_filler">
                </div>
                <div class="three_column_1 subfooter no_margin">
                    <img src="../images/Titles/Contact_Us.png" alt=""/>
    <h4 class="left">By Phone: (909) 343-5454</h4>
                    <h4 class="left">By E-mail: Contact@Battle-Comm.com</h4>
                    <h4 class="left">Address: 555 Boutel Dr.</h4>
                    <h4 class="indent left">Someplace, CA</h4>
                </div>
                <div class="three_column_1 subfooter">
                    <img src="../images/Titles/Follow_Us.png" alt=""/>
                    <?php include '../includes/social-links.php'; ?>
                </div>
    
            </div>
            <?php include '../includes/footer.php'; ?>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
    </body>
</html>