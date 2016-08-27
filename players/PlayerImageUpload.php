<?php require_once( "../webassist/security_assist/helper_php.php" ); 
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<!--Image Edit Jquery Scripts-->
<link rel="stylesheet" type="text/css" href="../js/picEdit-master/dist/css/picedit.min.css" />
<script type="text/javascript" src="../js/picEdit-master/dist/js/picedit.min.js"></script>
<!-- End Image Edit Jquery Scripts -->
<script type="text/javascript" src="../ScriptLibrary/dmxServerAction.js"></script>
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
			<h2>Upload/Modify Player Icon (v2.0)</h2>
            <p>Session Variable Test</p>
            <p>UserID: <?php echo $_SESSION['SecurityAssist_id']; ?></p>
            
           <p><form enctype="multipart/form-data" id="iconUpload" title="iconUpload">&nbsp;
           
           
           
             <p>
               <input name="playerID" type="hidden" id="playerID" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
               <input name="uploadIcon" type="file" id="uploadIcon" title="uploadIcon">
             </p>
             <p>
               <input name="submit" type="submit" id="submit" form="iconUpload" formmethod="POST" value="Upload">
             </p>
           </form></p>
           <p>
           User Handle: {{LoggedInUser.data[0].user_handle}}<br>
UserID:{{LoggedInUser.data[0].id}}<br>
<p>Current Picture<br>
             <img src="../uploads/player/<?php echo $_SESSION['SecurityAssist_id']; ?>/{{LoggedInUser.data[0].user_icon}}" alt="" width="150"/>           </p>
             <p>Current Image File Name: {{LoggedInUser.data[0].user_icon}}</p>
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
         <script type="text/javascript">
$(function() {
		$('#uploadIcon').picEdit();
	});
/* dmxServerAction name "uploadPlayerIcon" */
       jQuery.dmxServerAction(
         {"id": "uploadPlayerIcon", "url": "../dmxConnect/api/uploadPlayerIcon.php", "form": "#iconUpload", "data": {"userID": "{{$FORM.playerID}}"}}
       );
  /* END dmxServerAction name "uploadPlayerIcon" */
         </script>
    </body>
	<script><?php include ($pathToFile. "/Scripts/prefixfree.min.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/mobile-toggle.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/backtotop.js"); ?></script>
</html>