<?php require_once( "webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="Styles/magnificent-popup/magnificent-popup.css">
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
</script>

</head>
    <body>
    	<!-- HEADER -->
        <div class="nav placeholder center" id="returnhome"></div>
        <div class="nav row center">
			<script type="text/javascript">
<!--
	function toggle_visibility(id) {
	   var e = document.getElementById(id);
	   if(e.style.display == 'block')
		  e.style.display = 'none';
	   else
		  e.style.display = 'block';
	}
//-->
</script>
<div class="profilenav"><a onclick="toggle_visibility('account-nav');"><img src="../uploads/player/<?php echo $_SESSION['SecurityAssist_id']; ?>/{{logged_in_player_full.data[0].user_icon}}" width="37" alt=""/></a>
    <div id="account-nav">
    	<div class="account_name"><?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></div>
        <ul class="accountnav no_bullets">
        	<li><a href="/players/index.php">Player Home</a></li>
            <li><a href="/players/editProfileA.php">My Profile</a></li>
            <li><a href="/players/#">Messages</a></li>
            <li><a href="/logout.php">Logout</a></li>
        </ul>
    </div>
</div>
            <div class="mobilenav">
				<a href="#menu" class="menu-link">[+] Main Menu [+]</a>
<nav class="topnav top-menu" role="navigation">
    <ul>
        <li class="home"><a href="/index.php" ></a></li>
        <li class="news"><a href="/News/" ></a></li>
        <li class="events"><a href="/events.php" ></a></li>
        <li class="logintab"><a href="/loginA.php" class="scrollDown"></a></li>
        <li class="registertab"><a href="/registrationA.php" class="scrollDown"></a></li>  
    </ul>
</nav>
            </div>
            <div class="uppernav">
				<a href="#menu" class="menu-link">[+] Main Menu [+]</a>
<nav class="topnav top-menu" role="navigation">
    <ul>
        <li class="home"><a href="/index.php" ></a></li>
        <li class="news"><a href="/News/" ></a></li>
        <li class="events"><a href="/events.php" ></a></li>
        <li class="logintab"><a href="/loginA.php" class="scrollDown"></a></li>
        <li class="registertab"><a href="/registrationA.php" class="scrollDown"></a></li>  
    </ul>
</nav>
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
            <div class="logo"><a href="/index.php"><img src="/images/BC_Web_Logo.png" alt="BattleComm"></a></div>
            <div class="mobile-logo"><a href="/index.php"><img src="/images/BC_Web_Logo_mobile.png" alt="BattleComm"></a>
                <div class="mobile-buttons">
                    <div class="my-profile-button"><a href="/players/liveProfile.php"><img src="/images/BC_App_MyProfile.png" alt="BattleComm"></a></div><div class="create-match-button"><a href="/match.php"><img src="/images/BC_App_CreateMatch.png" alt="BattleComm"></a></div>
                </div>
            </div>
        </div>
        <!-- Middle -->
        <div class="mids">
        	<div class="container_full_width_frames no_shadow no_background no_padding">
            	<div class="full_content col" >
                    <div class="frame_u row">
                        <div class="frame_u_bar_full col"></div>
                        <div class="frame_ul_corner col"></div>
                        <div class="frame_ur_corner col"></div>
                    </div>
                    <div class="frame_content row">
                        <div class="frame_l_bar col"></div>
                        <div class="frame_r_bar col"></div>
                        <div class="frame_center col">
                        <!-- Begin User Level Navigation --><!-- End User Level Navigation -->
			<span style="text-align: center"><h2>ACCESS DENIED</h2></span></p>
            <p>
            You have attempted access  content that you do not currently have permissions to.</p>
            <p>&nbsp;</p>
            <p>If you feel this was in error, please contact us at help[at]battlecomm.com and let us know what you were trying to access at the time you got this message.</p>
            <p> If you are follwing a link from outside battlecomm.com and you got this message you can attempt to<a href="loginA.php"> login</a> to access the content (if your Battlecomm account has the applicable permissions).</p>
		</div>
                </div>
                <div class="frame_b row">
                    <div class="frame_b_bar_full col"></div>
                    <div class="frame_bl_corner col"></div>
                    <div class="frame_br_corner col"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FOOTER -->
        <div class="footer">
            <div class="sub-footer center" id="contact">
                <div class="three_column_1 subfooter_filler">
                </div>
                <div class="three_column_1 subfooter no_margin">
                    <img src="/images/Titles/Contact_Us.png" alt=""/>
    <h4 class="left">By Phone: (909) 343-5454</h4>
                    <h4 class="left">By E-mail: Contact@Battle-Comm.com</h4>
                    <h4 class="left">Address: 555 Boutel Dr.</h4>
                    <h4 class="indent left">Someplace, CA</h4>
                </div>
                <div class="three_column_1 subfooter">
                    <img src="/images/Titles/Follow_Us.png" alt=""/>
                   <div class="sociallinks">
<a href="https://www.facebook.com/battlecomm"><span class="symbol face" style="font-size: 38px;">&#xe427;</span></a><a href="https://twitter.com/Battle_Comm"><span class="symbol twit" style="font-size: 38px;">&#xe286;</span></a><a href="https://instagram.com/Battle_Comm"><span class="symbol twit" style="font-size: 38px;">&#xe500;</span></a>
</div>
                </div>
            </div>
            <div class="site-footer center">
<div class="copyright">© 2015 Battle-Comm.com. All Rights Reserved.
        <!--<a class="privacy_policy">Privacy Policy.</a>-->
        <br/>
        <div class="privacy-policy" ><a href="#">Privacy Policy</a> ~ </div> 
        <div class="copyright-statement" ><a href="#copyright-statement" class="open-popup-link" >Copyright Statement</a></div>
        <div id="copyright-statement" class="copyright-statement-popup mfp-hide">
			<div class="col-lg-6">
  <h2>Battle-Comm Official Copyright Statement</h2>
  <h4>All copyrights belong to their respective owners. Images and text owned by other copyright holders are used here under the guidelines of the Fair Use provisions of United States Copyright Law.</h4>
</div>
        </div>
        <script>
			$('.open-popup-link').magnificPopup({
			  type:'inline',
			  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
			});
		</script>
</div>
</div>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
    </body>
</html>