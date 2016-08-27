<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BattleComm: Home</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="Styles/global.css">
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
            	<div class="full_width">
                    <img src="media/banner.png" class="center" alt=""/>                
                    </div>
                <div class="full_width image_constraint">
                	<h2>Now supporting...</h2>
                    <div class="four_column_1">
                        <img src="media/DZC_Logo_white_web_grande.jpg" class="shadow" alt=""/> 
                    </div>
                    <div class="four_column_1">
                    	<img src="media/fantasy_flight-SWX01.png" alt=""/> 
                    </div>
                    <div class="four_column_1">
                    	<img src="media/MTGlogo.jpg" class="shadow" alt=""/> 
                    </div>
                    <div class="four_column_1">
                    	<img src="media/LandingPageLogo_40k.png" alt=""/> 
                    </div>
            	</div>
                <div class="full_width right">
                	<h2><a href="#test-popup" class="open-popup-link">And many, many more... --></a></h2>
                    <div id="test-popup" class="game-list-popup mfp-hide">
                      <?php include 'includes/full-game-list.php'; ?>
                    </div>
                    <script>
						$('.open-popup-link').magnificPopup({
						  type:'inline',
						  midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
						});
					</script>
                </div>
                <div class="two_column_1">
               		<h2>How Can BattleComm Help My Store?</h2>
       				<h3><span style="font-size: 13px; font-weight: normal; line-height: 20px; ">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</span></h3>
        			<a class="article_one1_btn" href="#">>read more</a>
                </div>
                <div class="two_column_1">
                	<h2>How Can BattleComm Help My Tournament or Other Event?</h2>
        			<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
        			<a class="article_one2_btn" href="#">read more</a>
                </div>
                <br/>
                <br/>
                <div class="full_width">
                	<h2>Recent at Battle Comm</h2>
                </div>
                <div class="four_column_1">
                	<?php include 'includes/twitter-stream.php'; ?>
                </div>
                <div class="four_column_3">
                	<div class="vid">
                        <a class="popup-vimeo" href="https://vimeo.com/22439234"><img src="images/videofill.png"></a>
                        <script>
                            $(document).ready(function() {
                              $('.popup-vimeo').magnificPopup({type:'iframe'});
                            });
                        </script>
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