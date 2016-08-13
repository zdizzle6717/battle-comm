<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
</script>
</head>
 <?php $pathToFile = $_SERVER['DOCUMENT_ROOT']; require_once($pathToFile. "/webassist/security_assist/helper_php.php" ); ?>
<body>
    <!-- HEADER -->
    <div class="nav placeholder center" id="returnhome"></div>
    <div class="nav row center">
        <?php if(WA_Auth_RulePasses("verifiedUser")){ // Begin Show Region ?>
            <?php include ($pathToFile. "/Templates/includes/account-nav.php"); ?>
        <?php } // End Show Region ?>
        <div class="mobilenav">
            <?php include ($pathToFile. "/Templates/includes/top-navigation-mobile.php"); ?>
        </div>
        <div class="uppernav">
            <?php include ($pathToFile. "/Templates/includes/top-navigation.php"); ?>
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
            <?php if(WA_Auth_RulePasses("verifiedUser")){ // Begin Show Region ?>
                <?php include ($pathToFile. "/Templates/includes/mobile-buttons.php"); ?>
            <?php } // End Show Region ?>
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
				<!-- Begin User Level Navigation -->
        	<div id="PlayerNav">
                <a href="/players/index.php">Player Home</a> | <a href="/players/mydashboard.php">My Dashboard</a> | 
                <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                <a href="/tool/index.php">Tournament Admin</a> |
                  <?php } // End Show Region ?>
                <a href="/players/editProfileA.php">Edit Profile</a> |
                <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                  <a href="/admin/index.php"> System Administrator</a>
                  <?php } // End Show Region ?>
                 | 
                <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
                <a href="/clubsAdmin/index.php">Club Admin</a>
                <?php } // End Show Region ?>
            </div>
<!-- End User Level Navigation -->
			<h2>Title Here</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin orci tortor, facilisis fringilla quam eu, facilisis posuere purus. Suspendisse quam ante, dignissim eu purus a, tempus bibendum magna. Ut fringilla pharetra metus sed lacinia. Sed condimentum, nulla ut fermentum dignissim, nisl mauris efficitur justo, eleifend porta massa velit sed arcu. Curabitur a dui vel enim dignissim sagittis quis vitae turpis. Quisque et leo nec tortor volutpat faucibus sit amet eu metus. Sed risus risus, placerat vel neque sed, posuere condimentum magna. Pellentesque rutrum dui vel turpis lacinia elementum.</p>
            
           <p> Sed orci purus, tempor nec commodo ut, tincidunt a sem. In nec imperdiet leo. Sed aliquet ut purus a commodo. Nunc facilisis quam sagittis ex cursus, consequat sodales quam accumsan. Maecenas pulvinar neque facilisis consequat maximus. Pellentesque tempor venenatis vehicula. Fusce est elit, consectetur id magna at, viverra ullamcorper nisl. Proin posuere ut ligula id aliquam. Vivamus ac tristique justo, non imperdiet neque. In vitae nisl nec lorem cursus tempus.</p>
            <p>
            Vivamus sed egestas urna. Nunc odio purus, laoreet quis sagittis vitae, imperdiet ut urna. Cras tortor ligula, ultrices non vehicula id, finibus at lacus. Etiam venenatis, felis ut elementum tincidunt, nulla lorem vulputate ante, sed volutpat quam odio quis metus. Donec mollis blandit risus vitae tincidunt. Duis sit amet congue mauris. Phasellus egestas ligula at lacus suscipit tristique.</p>
            
           <p> Integer at nisl sollicitudin, iaculis quam non, iaculis dui. Cras quis erat vel elit tempor faucibus. Quisque malesuada aliquam dui in cursus. Praesent eu egestas est, a pretium lorem. Proin sem diam, dapibus eu fermentum vitae, tincidunt a felis. Donec sollicitudin et augue id luctus. Etiam maximus vitae orci a efficitur. Suspendisse nec imperdiet lacus. Pellentesque vulputate erat ac ornare mattis. Aenean ligula ex, congue non ligula id, molestie mollis felis. Aliquam sem eros, mollis quis enim id, pretium lacinia leo. Etiam hendrerit eros eget sapien gravida, et molestie erat maximus. Vivamus malesuada a magna non vehicula. Maecenas maximus justo leo, in vulputate arcu volutpat ut. Maecenas et tempor dui. Cras id suscipit arcu, sed gravida enim.</p>
            
           <p> Sed quis dolor et dolor sodales placerat. Pellentesque ut consectetur neque. Etiam interdum massa nec nisl semper, et commodo quam placerat. Sed eu magna massa. Nullam dignissim pulvinar purus sed sodales. Interdum et malesuada fames ac ante ipsum primis in faucibus. Suspendisse lobortis nec erat id varius. Aenean et dictum nulla, ac fringilla quam. Donec gravida metus orci, semper suscipit lacus fringilla fringilla. Nulla et congue dolor. Duis nec mi ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi rhoncus mauris sit amet velit semper, ut vestibulum ligula sollicitudin.</p>
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
                    <?php $pathToFile = $_SERVER['DOCUMENT_ROOT'];
					include ($pathToFile. "/Templates/includes/social-links.php"); ?>
                </div>
            </div>
            <?php include ($pathToFile. "/Templates/includes/footer.php"); ?>
            <a href="#" id="backtotop" style="display: block;">
                <span class="fa fa-angle-up"></span>
                <span class="back-to-top">Top</span>
            </a>
        </div>
    </body>
	<script><?php include ($pathToFile. "/Scripts/prefixfree.min.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/mobile-toggle.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/backtotop.js"); ?></script>
</html>