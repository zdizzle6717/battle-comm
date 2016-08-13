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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="/Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="/Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="/Scripts/backtotop.js"></script>
<link rel="stylesheet" type="text/css" media="screen, print" href="/Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="/Styles/magnificent-popup/magnificent-popup.css">
<link href="css/customPlayer.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script src="../ScriptLibrary/jQueryAssets/jquery-1.11.1.min.js" type="text/javascript"></script>
<script src="../ScriptLibrary/jQueryAssets/jquery.ui-1.10.4.accordion.min.js" type="text/javascript"></script>
<script type="text/javascript">
  /* dmxDataSet name "loggedInPlayer" */
       jQuery.dmxDataSet(
         {"id": "loggedInPlayer", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "loggedInPlayer" */
  </script>
<script type="text/javascript">
  /* dmxDataSet name "RoundAssignment" */
       jQuery.dmxDataSet(
         {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundAssignment" */
  </script>
<script type="text/javascript">

  /* dmxDataSet name "Tournaments" */
       jQuery.dmxDataSet(
         {"id": "Tournaments", "url": "../dmxDatabaseSources/tournamentFullList.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "Tournaments" */
  </script>
<link rel="stylesheet" type="text/css" href="../Styles/dmxAccordion.css" />
<link rel="stylesheet" type="text/css" href="../Styles/jqueryui/black-tie/jquery-ui.css" />
<link href="../ScriptLibrary/jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="../ScriptLibrary/jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="../ScriptLibrary/jQueryAssets/jquery.ui.accordion.min.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../ScriptLibrary/jquery-ui-core.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/jquery-ui-effects.min.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxAccordion.js"></script>
</head>
<body>
    	<!-- HEADER -->
        <div class="nav placeholder center" id="returnhome"></div>
        <div class="nav row center">
        	<script type="text/javascript">
<!--
	function toggle_visibility(id) {
	   var e = document.getElementById("profile");
	   if(e.style.display == 'block')
		  e.style.display = 'none';
	   else
		  e.style.display = 'block';
	}
//-->
</script>
<div class="profilenav" id="profile"><a onclick="toggle_visibility('account-nav');"><img src="../uploads/player/{{loggedInPlayer.data[0].id}}/{{loggedInPlayer.data[0].user_icon}}" alt=""/></a>
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
<!-- Begin User Level Navigation -->
        	<div id="PlayerNav">
                <a href="/players/index.php">Player Home</a> | <a href="/players/mydashboard.php">My Dashboard</a> | 
                <?php if(WA_Auth_RulePasses("tourneyAdmin")){ // Begin Show Region ?>
                <a href="../tool/index.php">Tournament Admin</a> |
                  <?php } // End Show Region ?>
                <a href="user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Account</a> |
                <a href="editProfileA.php">Edit Profile (A)</a> |
                <?php if(WA_Auth_RulePasses("systemAdmin")){ // Begin Show Region ?>
                  <a href="../admin/index.php"> System Administrator</a>
                  <?php } // End Show Region ?>
                 | 
                <?php if(WA_Auth_RulePasses("ClubAdmin")){ // Begin Show Region ?>
                <a href="../clubsAdmin/index.php">Club Admin</a>
                <?php } // End Show Region ?>
            </div>
<!-- End User Level Navigation -->
            <div class="customizedPageTitle">
            	<h2>Welcome, {{loggedInPlayer.data[0].lastName}}{{loggedInPlayer.data[0].firstName}} - {{loggedInPlayer.data[0].user_handle}}            	</h2>
</div></p>
            
           
<h2>Tournaments <?php echo $_SESSION['SecurityAssist_id']; ?></h2>
<a href="../tool/tourneyRegistration/index.php">Register for upcoming Tournaments</a>

           <h3>My Active Events</h3>
           <p>
           <table width="90%" border="1" align="left">
  <tbody>
    <tr>
      <th scope="col">Tournament</th>
      <th scope="col">Round</th>
      <th scope="col">Match/Table</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr data-binding-repeat="{{RoundAssignment.data}}" data-binding-id="repeat1">
      <td>{{tournament_name}}</td>
      <td>{{tourney_round_title}}</td>
      <td>{{Game_session}}/ {{table_id}}</td>
      <td><a href="FactionAssignment.php?td={{tournament_id}}&rd={{tourney_round_id}}&gsi={{game_id}}&gs={{Game_session}}">Choose<br>
        Factions</a></td>
      <td><p><a href="roundDetail.php?td={{tournament_id}}&rd={{tourney_round_id}}">View Details</a></p></td>
      <td><a href="submitscore.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">Submit Results</a>
        
        </td>
      <td><a href="scoreview.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">View Results</a></td>
      <td><a href="tournamentResultDetails.php?td={{tournament_id}}">Tournament Details</a></td>
    </tr>
  </tbody>
</table>
          </p> 
          <p>
          <h2>My Active Events Alternative Display</h2>
          
          
          
          </p>
                     
                <div class="dmxAccordion" id="dmxAccordion1" style="width:600pxpx" data-binding-repeat-children="{{RoundAssignment.data}}" data-binding-id="dmxAccordion1">
                  <h3>{{tournament_name}}</h3>
                  <div>
                    <p>{{tourney_round_title}} -{{Game_session}}/{{table_id}}</p>
                    <p><a href="FactionAssignment.php?td={{tournament_id}}&rd={{tourney_round_id}}&gsi={{game_id}}&gs={{Game_session}}">Choose 
        Factions</a> | <a href="roundDetail.php?td={{tournament_id}}&rd={{tourney_round_id}}">View Round Details</a></p><p><a href="submitscore.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}"><strong>Submit Results</strong></a> -- <a href="scoreview.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}"><strong>View Round Results</strong></a> -- <a href="tournamentResultDetails.php?td={{tournament_id}}"><strong>View Tournament ResultDetails</strong></a></p>
                    </div>
                  
                </div>
                <script type="text/javascript">
  // <![CDATA[
 jQuery(document).ready(
   function()
     {
       jQuery("#dmxAccordion1").dmxAccordion(
         {"collapsible": true}
       );
     }
 );
  // ]]>
                </script>
                <div id="Accordion1">
                  <h3><a href="#">Section 1</a></h3>
                  <div style="display:inline">
                    <p>Content 1</p>
                  </div>
                  <h3><a href="#">Section 2</a></h3>
                   <div style="display:inline">
                    <p>Content 2</p>
                  </div>
                  <h3><a href="#">Section 3</a></h3>
                   <div style="display:inline">
                    <p>Content 3</p>
                  </div>
                </div>
                <p></p>
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
	$( "#Accordion1" ).accordion(); 
});
        </script>
</body>
</html>