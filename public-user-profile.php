<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BattleComm: User Profile</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/profile.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/magnificent-popup/magnificent-popup.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="Scripts/jquery.magnificant-popup.js"></script>
	<script type="text/javascript" src="Scripts/mobile-toggle.js"></script>
    <script type="text/javascript" src="Scripts/backtotop.js"></script>
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
            <div class="logo"><a href="index.php"><img src="images/BC_Web_Logo.png" alt="BattleComm"></a></div>
            <div class="mobile-logo"><a href="index.php"><img src="images/BC_Web_Logo_mobile.png" alt="BattleComm"></a>
                <div class="mobile-buttons">
                    <div class="my-profile-button"><a href="admin/user/profile-edit.php"><img src="images/BC_App_MyProfile.png" alt="BattleComm"></a></div><div class="create-match-button"><a href="match.php"><img src="images/BC_App_CreateMatch.png" alt="BattleComm"></a></div>
                </div>
            </div>
        </div>
        
        
        
        <!-- Middle -->
        <div class="mids">
        	<div class="container_full_width_table">
                <div class="two_column_1">
                	<h2 class="center no_shadow">BIO</h2>
                    	<p class="user-bio">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>               		
                    <h3 class="center">Connect With [USERNAME]</h3>
                		<div class="center"><?php include 'includes/profile-social-links.php'; ?></div>
                </div>
                <div class="two_column_1">
                	<div class="center"><br/><img src="images/profile_image_default.png" alt="" class="shadow"/></div>
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
                    	<img src="media/filler/dice.png" alt="" />
                    	<img src="media/filler/game1.jpeg" alt=""/> 
                        <img src="media/filler/game3.jpg" alt=""/>
                    	<img src="media/filler/game2.jpg" alt=""/> 
                    </div>
            </div>  
        </div>
        
        
        
        <!-- FOOTER -->
        <div class="footer">
            <div class="sub-footer center" id="contact">
                <div class="three_column_1 subfooter_filler">
                </div>
                <div class="three_column_1 subfooter no_margin">
                    <img src="images/Titles/Contact_Us.png" alt=""/>
    <h4 class="left">By Phone: (909) 343-5454</h4>
                    <h4 class="left">By E-mail: Contact@Battle-Comm.com</h4>
                    <h4 class="left">Address: 555 Boutel Dr.</h4>
                    <h4 class="indent left">Someplace, CA</h4>
                </div>
                <div class="three_column_1 subfooter">
                    <img src="images/Titles/Follow_Us.png" alt=""/>
                    <?php include 'includes/social-links.php'; ?>
                </div>
    
            </div>
            <?php include 'includes/footer.php'; ?>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
    </body>
</html>