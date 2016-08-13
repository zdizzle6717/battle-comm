<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BattleComm: FLGS Profile</title>
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
                	<h2 class="center no_shadow">Store Description & Info</h2>
                    	<p class="user-bio">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>  
                        <h3>Hours</h3>
                        <p>Mon-Fri</p>
                        <p>9:00am-8:00pm</p>             		
                </div>
                <div class="two_column_1">
                	<h1 class="center">[FLGS NAME]</h1>
                	<div class="center"><br/><img src="media/flgs_example.png" alt="" class="shadow"/></div>
        			<div class="center">
                        <h3 class="center">Follow [FLGS NAME]</h3>
                		<div class="center"><?php include 'includes/profile-social-links.php'; ?></div>
                    </div>
                </div>
                <div class="full_width">
                	<div class="two_column_1">
                    	   <h2 class="center">Photo Gallery</h2>      	
                    </div>
                    <div class="two_column_1">
                    	<div class="recent_articles">
                          <h2>Contact</h2>
                          <h3>PHONE: 555-555-5555</h3>
                          <p>E-MAIL: info@store.com</p>
                          <p>ADDRESS: 555 West 5th Street</p>
                        </div>
                    </div>
                </div>
                <br/>
                <br/>
                <div class="full_width">
                	<h2>Current Schedule</h2>
                	<table width="70%" align="center" cellpadding="5" cellspacing="5" class="table">
                        <thead>
                          <tr bgcolor="#FFFFFF">
                            <th> Table </th>
                            <th> Game</th>
                            <th> Date</th>
                            <th> # Players</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr bgcolor="#88EAFF">
                            <td> 1 </td>
                            <td> Warhammer </td>
                            <td> 01/04/2012 </td>
                            <td> 12 </td>
                          </tr>
                          <tr class="success">
                            <td> 1 </td>
                            <td>Warhammer </td>
                            <td> 01/04/2012 </td>
                            <td> 12 </td>
                          </tr>
                          <tr class="danger">
                            <td> 2 </td>
                            <td>Warhammer </td>
                            <td> 02/04/2012 </td>
                            <td>12</td>
                          </tr>
                          <tr class="warning">
                            <td> 3 </td>
                            <td>Warhammer </td>
                            <td> 03/04/2012 </td>
                            <td> 12 </td>
                          </tr>
                          <tr class="info">
                            <td> 4 </td>
                            <td>Magic</td>
                            <td> 04/04/2012 </td>
                            <td> 8</td>
                          </tr>
                        </tbody>
                      </table>
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