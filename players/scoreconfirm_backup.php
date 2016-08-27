<?php require_once('../Connections/battlecomm_sqli.php'); ?>
<?php require_once('../webassist/mysqli/rsobj.php'); ?>
<?php require_once( "../webassist/security_assist/helper_php.php" ); ?>
<?php
if (!WA_Auth_RulePasses("verifiedUser")){
	WA_Auth_RestrictAccess("../loginA.php");
}

$tournament = new WA_MySQLi_RS("tournament",$battlecomm_sqli,1);
$tournament->setQuery("SELECT tournament.tournament_id, tournament.tournament_name, tournament.factions_cap, tournament.game_id, tournament.WinPointValue, tournament.DrawPointValue, tournament.LossPointValue, game_system.game_system_id, game_system.game_system_Title, game_system.noOfPlayers FROM tournament INNER JOIN game_system ON tournament.game_id = game_system.game_system_id WHERE tournament.tournament_id = ?");
$tournament->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param1
$tournament->execute();?>
<?php
$rounds = new WA_MySQLi_RS("rounds",$battlecomm_sqli,1);
$rounds->setQuery("SELECT tournament_rounds.rounds_id, tournament_rounds.tournament_id, tournament_rounds.Round_Title FROM tournament_rounds WHERE tournament_rounds.rounds_id = ?");
$rounds->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param1
$rounds->execute();?>
<?php
$Tiebreakers = new WA_MySQLi_RS("Tiebreakers",$battlecomm_sqli,0);
$Tiebreakers->setQuery("SELECT matched_tiebreakers.* FROM matched_tiebreakers WHERE matched_tiebreakers.tournament_ID = ? AND matched_tiebreakers.match_id = ?");
$Tiebreakers->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param1
$Tiebreakers->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param2
$Tiebreakers->execute();
?>
<?php
$RoundPlayers = new WA_MySQLi_RS("RoundPlayers",$battlecomm_sqli,0);
$RoundPlayers->setQuery("SELECT tournament_game_player.*, user_login.id, user_login.firstName, user_login.lastName FROM tournament_game_player INNER JOIN user_login ON tournament_game_player.player_id = user_login.id WHERE tournament_game_player.tourney_round_id = ? AND tournament_game_player.tournament_id = ? AND tournament_game_player.Game_session = ? AND tournament_game_player.table_id = ?");
$RoundPlayers->bindParam("i", "".(isset($_GET['rd'])?$_GET['rd']:"")  ."", "-1"); //WAQB_Param1
$RoundPlayers->bindParam("i", "".(isset($_GET['td'])?$_GET['td']:"")  ."", "-1"); //WAQB_Param2
$RoundPlayers->bindParam("s", "".(isset($_GET['gs'])?$_GET['gs']:"")  ."", "-1"); //WAQB_Param3
$RoundPlayers->bindParam("s", "".(isset($_GET['tbl'])?$_GET['tbl']:"")  ."", "-1"); //WAQB_Param4
$RoundPlayers->execute();
?>
<?php
$roundPlayer = new WA_MySQLi_RS("roundPlayer",$battlecomm_sqli,1);
$roundPlayer->setQuery("SELECT tournament_players.tournament_players_id, tournament_players.tournament_id, tournament_players.user_login_id, tournament_players.userHandle, tournament_players.firstName, tournament_players.lastName, tournament_players.totalScore FROM tournament_players WHERE tournament_players.user_login_id = ?");
$roundPlayer->bindParam("s", "".(isset($_SESSION['SecurityAssist_id'])?$_SESSION['SecurityAssist_id']:"")  ."", "-1"); //WAQB_Param1
$roundPlayer->execute();
?>
<?php
 require_once( "../webassist/security_assist/helper_php.php" ); ?>
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
<div class="profilenav"><a onclick="toggle_visibility('account-nav');"><img src="../uploads/player/{{LoggedInUser.data[0].id}}/{{LoggedInUser.data[0].user_icon}}" width="37" alt=""/></a>
    <div id="account-nav">
    	<div class="account_name"><?php echo $_SESSION['firstName']; ?> <?php echo $_SESSION['lastName']; ?></div>
        <ul class="accountnav no_bullets">
        	<li><a href="/players/index.php">Player Home</a></li>
            <li><a href="/players/liveProfile.php">My Profile</a></li>
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
			<h2>Confirm Round Results for <?php echo($tournament->getColumnVal("tournament_name")); ?>/ Round <?php echo($rounds->getColumnVal("Round_Title")); ?></h2>
			<p>Players: </p><?php
while(!$RoundPlayers->atEnd()) {
?>
			<?php echo($RoundPlayers->getColumnVal("firstName")); ?> $RoundPlayers->getColumnVal("lastName")
			<?php
  $RoundPlayers->moveNext();
}
$RoundPlayers->moveFirst(); //return RS to first record
?>
            <p>Submitting Score as <?php echo($roundPlayer->getColumnVal("firstName")); ?> <?php echo($roundPlayer->getColumnVal("lastName")); ?></p>
            
           <p> 
           <p> <form action="submitscore.php" method="post" name="player_results_submit" id="player_results_submit">
           
           <table width="200" border="1">
  <tbody>
    <tr>
      <th scope="col">Outcome</th>
      <th scope="col">Points</th>
      <th scope="col">Select</th>
    </tr>
    <tr>
      <td>Win</td>
      <td><?php echo($tournament->getColumnVal("WinPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="win"></td>
    </tr>
    <tr>
      <td>Draw</td>
      <td><?php echo($tournament->getColumnVal("DrawPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="draw"></td>
    </tr>
    <tr>
      <td>Loss</td>
      <td><?php echo($tournament->getColumnVal("LossPointValue")); ?></td>
      <td align="center"><input type="radio" name="game_outcome" id="radio" value="loss"></td>
    </tr>
  </tbody>
</table>
<!--Begin Outcome Score capture/Calculation-->
<?php 
		$point_win= $tournament->getColumnVal("WinPointValue"); 
		$point_draw=$tournament->getColumnVal("DrawPointValue");
		$point_loss= $tournament->getColumnVal("LossPointValue");
		$win_count=0;
		$draw_count=0;
		$loss_count=0;
	
if(isset($_POST['submit']) && ($_POST['game_outcome']))
{
   $outcome=$_POST['game_outcome'];
}
?>
  <?php if ($outcome=='win'){
	$out_points=$tournament->getColumnVal("WinPointValue");
	$win_count = 1;}
	elseif ($outcome=='draw'){
		$out_points=$tournament->getColumnVal("DrawPointValue");
		$draw_count =1;}
	else {
		$out_points=$tournament->getColumnVal("LossPointValue");
		$loss_count=1;} 
       ?>
       <!--End Outcome Score calculation -->
	<?php
		$gamePointsTotal=$out_points;
		?>

</p>
            <p>
              <input name="Total Game Points" type="text" id="Total Game Points" value="<? echo $gamePointsTotal; ?>">
            <table width="500" border="1">
  <tbody>
    <tr>
      <th scope="col">Mission</th>
      <th scope="col">Points</th>
      <th scope="col">Select</th>
    </tr>
    
    <?php
while(!$Tiebreakers->atEnd()) {
?>
    <tr>
      <td><?php echo($Tiebreakers->getColumnVal("match_name")); ?></td>
      <td><?php echo($Tiebreakers->getColumnVal("tiebreaker_points")); ?></td>
      <td style="text-align: center"><input name="tiebreaker[]" type="checkbox" id="tiebreaker[]" value="<?php echo($Tiebreakers->getColumnVal("tiebreaker_points")); ?>"></td>
    </tr>
    <?php
  $Tiebreakers->moveNext();
}
$Tiebreakers->moveFirst(); //return RS to first record
?>
    <tr>
      <td><input name="tourneyPlayersID" type="hidden" id="tourneyPlayersID" value="<?php echo($roundPlayer->getColumnVal("tournament_players_id")); ?>"></td>
      <td>Total Points</td>
      <td><?php
	$tiebreakerTotal = 0;
	$tiepoints=0;
	if(isset($_POST['submit'])){
		if(!empty($_POST['tiebreaker'])){
			foreach($_POST['tiebreaker'] as $tiepoints){
				$tiebreakerTotal += $tiepoints;}	
			
		}
		
		
	}
		echo $tiebreakerTotal;
?></td>
  </tr>
  </tbody>
</table></p>
            
           <p> <p>Outcome: <input name="OutCome" type="text" id="OutCome" value="<? echo $outcome; ?>"></p>
       <!-- <p>Choice: <? echo $_POST['game_outcome']; ?>-->
        <p>Game Points:<input name="GamePoints" type="text" id="GamePoints" value="<? echo $gamePointsTotal; ?>"> </p>
        <p>Mission Points: 
          <input name="missionPoints" type="text" id="missionPoints" value="<? echo $tiebreakerTotal; ?>">
          </p>
        <? $round_total = $gamePointsTotal + $tiebreakerTotal; ?>
        <p>Total Points for Round: 
          <input name="totalRound" type="text" id="totalRound" value="<? echo $round_total; ?>">
           </p>
        <p><? $tournament_totalPoints= $roundPlayer->getColumnVal("totalScore");
				$tournament_totalPoints= $round_total + $tournament_totalPoints;
				?>
        
        
        Total Points for Tournament: <?echo $tournament_totalPoints; ?>
        
  <p><input name="submit" type="submit" id="submit" form="player_results_submit" formaction="#" formmethod="POST" value="Generate Results">
		</p></p>
            </p></p></form></p>
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