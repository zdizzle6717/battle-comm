<?php require_once( "../../webassist/security_assist/helper_php.php" ); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>BattleComm: Home</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../../Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../../Styles/magnificent-popup/magnificent-popup.css">
<link href="../../Styles/form-blue.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../../ScriptLibrary/jquery-latest.pack.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */

  /* dmxDataSet name "states" */
       jQuery.dmxDataSet(
         {"id": "states", "url": "../../dmxDatabaseSources/state.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "states" */

  /* dmxDataSet name "GameStore" */
       jQuery.dmxDataSet(
         {"id": "GameStore", "url": "../../dmxDatabaseSources/FLGS_DropDown.php", "data": {"limit": "1000"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "GameStore" */
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
          <?php if(WA_Auth_RulePasses("verifiedUser")){ // Begin Show Region ?>
          <div class="profilenav"><a onclick="toggle_visibility('account-nav');"><img src="../../uploads/player/{{LoggedInUser.data[0].id}}/{{LoggedInUser.data[0].user_icon}}" width="37" alt=""/></a>
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
          <?php } // End Show Region ?>
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
                        <!-- Begin User Level Navigation -->
        	<div id="PlayerNav">
                <a href="/players/index.php">Player Home</a> | <a href="/players/mydashboard.php">My Dashboard</a> | 
                <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                <a href="../../tool/index.php">Tournament Admin</a> |
                  <?php } // End Show Region ?>
                <a href="../../players/user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Account</a> |
                
                <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                  <a href="../index.php"> System Administrator</a>
                  <?php } // End Show Region ?>
                 | 
                <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
                <a href="../../clubsAdmin/index.php">Club Admin</a>
                <?php } // End Show Region ?>
            </div>
<!-- End User Level Navigation -->
            <form enctype="multipart/form-data" class="formoid-default-skyblue" style="background-color:#FFFFFF;font-size:14px;font-family:Verdana,Geneva,sans-serif;color:#666666;max-width:700px;min-width:150px" method="post"><div class="title"><h2>Add New Club</h2></div>
	<div class="element-input"><label class="title">Club Name</label><input name="clubName" type="text" class="large" id="clubName" /></div>
	<div class="element-textarea"><label class="title">Club Description</label><textarea name="clubDescription" cols="20" rows="5" class="medium" id="clubDescription" ></textarea></div>
	<div class="element-select"><label class="title">FLGS Affiliation</label><div class="large"><span><select name="flgsChoice" id="flgsChoice" data-binding-repeat-children="{{GameStore.data}}" data-binding-id="flgsChoice" >

		
		<option value="{{venue_id}}">{{venue_Name}} </option>
		</select><i></i></span></div></div>
	<div class="element-input"><label class="title">Street Address</label><input name="streetAddress" type="text" class="large" id="streetAddress" /></div>
	<div class="element-input"><label class="title">City</label><input name="city" type="text" class="medium" id="city" /></div>
	<div class="element-select"><label class="title">State</label><div class="small"><span><select name="state" id="state" data-binding-repeat-children="{{states.data}}" data-binding-id="state" >

		
		<option>{{state_name}} </option>
		</select><i></i></span></div></div>
	<div class="element-input"><label class="title">Zip Code</label><input name="zip" type="text" class="small" id="zip" /></div>
	<div class="element-input"><label class="title">Contact Email</label><input name="contactEmail" type="text" class="medium" id="contactEmail" /></div>
	<div class="element-input"><label class="title">Administrator Title</label><input name="adminTitle" type="text" class="large" id="adminTitle" /></div>
	<div class="element-input"><label class="title">Editor Title</label><input name="editorTitle" type="text" class="large" id="editorTitle" /></div>
	<div class="element-input"><label class="title">Moderator Title</label><input name="modTitle" type="text" class="large" id="modTitle" /></div>
	<div class="element-input"><label class="title">Member Title</label><input name="memberTitle" type="text" class="large" id="memberTitle" /></div>
	<div class="element-input"><label class="title">Facebook Page</label><input name="facebookPage" type="text" class="large" id="facebookPage" /></div>
	<div class="element-input"><label class="title">Twitter Feed</label><input class="large" type="text" name="input10" /></div>
	<div class="element-input"><label class="title">Club Website</label><input class="large" type="text" name="input11" /></div>
	<div class="element-input"><label class="title">Club Owner/Manager</label><input class="large" type="text" name="input12" /></div>
	<div class="element-select"><label class="title">Game System</label><div class="large"><span><select name="select2" >

		<option value="option 1">option 1</option>
		<option value="option 2">option 2</option>
		<option value="option 3">option 3</option></select><i></i></span></div></div>
	<div class="element-file"><label class="title">Club Logo</label><label class="large" ><div class="button">Choose File</div><input type="file" class="file_input" name="file" /><div class="file_text">No file selected</div></label></div>
	<div class="element-checkbox"><label class="title">Display Members on Public Pages</label>		<div class="column column2"><label><input type="checkbox" name="checkbox[]" value="Yes"/ ><span>Yes</span></label></div><span class="clearfix"></span>
		<div class="column column2"><label><input type="checkbox" name="checkbox[]" value="No	"/ ><span>No	</span></label></div><span class="clearfix"></span>
</div>
<div class="submit"><input type="submit" value="Add Club"/></div></form>
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