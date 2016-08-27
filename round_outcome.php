<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>BattleComm: Home</title>
    <link rel="stylesheet" type="text/css" media="screen, print" href="/Styles/global.css">
    <link rel="stylesheet" type="text/css" media="screen, print" href="/Styles/magnificent-popup/magnificent-popup.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script type="text/javascript" src="/Scripts/jquery.magnificant-popup.js"></script>
    <script type="text/javascript" src="ScriptLibrary/dmxDataBindings.js"></script>
    <script type="text/javascript" src="ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript">
  /* dmxDataSet name "RoundOutcome" */
       jQuery.dmxDataSet(
         {"id": "RoundOutcome", "url": "../dmxDatabaseSources/tournamentGamePlayers_byRound.php", "data": {"rd": "{{$URL.rd}}", "tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundOutcome" */

  /* dmxDataSet name "tournament" */
       jQuery.dmxDataSet(
         {"id": "tournament", "url": "../dmxDatabaseSources/tournaments_filtered.php", "data": {"tourney": "{{$URL.tourney}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "tournament" */

  /* dmxDataSet name "round" */
       jQuery.dmxDataSet(
         {"id": "round", "url": "../dmxDatabaseSources/roundsFiltered.php", "data": {"tourney": "{{$URL.tourney}}", "rd": "{{$URL.rd}}", "limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "round" */
</script>
</head>
   <body>
    	<!-- HEADER -->
        <div class="nav placeholder center" id="returnhome">
        </div>
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
<div class="profilenav"><a onclick="toggle_visibility('account-nav');"><img src="images/profile_image_small.png" alt=""/></a>
    <div id="account-nav">
    	<div class="account_name">[Username]</div>
        <ul class="accountnav no_bullets">
            <li>
                <a href="players/user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Edit Profile</a>
            </li>
            <li><a href="players/">Admin</a></li>
            <li><a href="index.php">Logout</a></li>
        </ul>
    </div>
</div>
            <div class="mobilenav">
                <a href="#menu" class="menu-link">[+] Main Menu [+]</a>
<nav class="topnav top-menu" role="navigation">
    <ul>
        <li class="home"><a href="index.php" ></a></li>
        <li class="news"><a href="/News/" ></a></li>
        <li class="events"><a href="events.php" ></a></li>
        <li class="logintab"><a href="../loginA.php" class="scrollDown"></a></li>
        <li class="registertab"><a href="../registrationA.php" class="scrollDown"></a></li>  
    </ul>
</nav>
            </div>
            <div class="uppernav">
               <a href="#menu" class="menu-link">[+] Main Menu [+]</a>
<nav class="topnav top-menu" role="navigation">
    <ul>
        <li class="home"><a href="index.php" ></a></li>
        <li class="news"><a href="/News/" ></a></li>
        <li class="events"><a href="events.php" ></a></li>
        <li class="logintab"><a href="../loginA.php" class="scrollDown"></a></li>
        <li class="registertab"><a href="../registrationA.php" class="scrollDown"></a></li>  
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
                    <div class="my-profile-button"><a href="../../admin/user/profile-edit.php"><img src="/images/BC_App_MyProfile.png" alt="BattleComm"></a></div><div class="create-match-button"><a href="../../match.php"><img src="/images/BC_App_CreateMatch.png" alt="BattleComm"></a></div>
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
			<h2>Outcome for {{tournament.data[0].tournament_name}}/{{round.data[0].Round_Title}}</h2>
            <table width="90%" border="0">
  <tbody>
    <tr>
      <th scope="col">Match</th>
      <th scope="col">Table</th>
      <th scope="col">Player</th>
      <th scope="col">Outcome</th>
      <th scope="col">Round Points</th>
      <th scope="col">Mission Points</th>
      <th scope="col">Total Points</th>
      <th scope="col">Approve</th>
    </tr>
    <tr data-binding-repeat="{{RoundOutcome.data}}" data-binding-id="repeat1">
      <td>{{Game_session}}</td>
      <td>{{table_id}}</td>
      <td>{{player_handle}}</td>
      <td>{{game_result}}</td>
      <td>{{game_points}}</td>
      <td>{{mission_points}}</td>
      <td>{{total_points}}</td>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<p>You can resubmit your results [here]</p>

            
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
        	<?php include 'includes/copyright-statement.php'; ?>
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