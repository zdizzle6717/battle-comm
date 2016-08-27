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
<title>BattleComm: {{LoggedInUser.data[0].user_handle}}'s Dashboard</title>
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/global.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/magnificent-popup/magnificent-popup.css">
<link rel="stylesheet" type="text/css" media="screen, print" href="../Styles/user_edit.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../Scripts/jquery.magnificant-popup.js"></script>
<script type="text/javascript" src="../Scripts/mobile-toggle.js"></script>
<script type="text/javascript" src="../Scripts/backtotop.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxDataBindings.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataSet.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDataFilters.js"></script><script type="text/javascript" src="../ScriptLibrary/dmxServerAction.js"></script>
<script type="text/javascript" src="../ScriptLibrary/dmxDatabaseAction.js"></script>
<script type="text/javascript" src="../Scripts/url-input-format.js"></script>
<script type="text/javascript">
/* dmxDataSet name "logged_in_player_full" */
       jQuery.dmxDataSet(
         {"id": "logged_in_player_full", "url": "../dmxDatabaseSources/logged_in_player_full.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "logged_in_player_full" */
  /* dmxDataSet name "LoggedInUser" */
       jQuery.dmxDataSet(
         {"id": "LoggedInUser", "url": "../dmxDatabaseSources/loggedinPlayer.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "LoggedInUser" */
  /* dmxDataSet name "RoundAssignment" */
       jQuery.dmxDataSet(
         {"id": "RoundAssignment", "url": "../dmxDatabaseSources/RoundAssignment.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RoundAssignment" */
  /* dmxDataSet name "PlayerProfile" */
       jQuery.dmxDataSet(
         {"id": "PlayerProfile", "url": "../dmxDatabaseSources/PlayerProfileEdit.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "PlayerProfile" */
  /* dmxDataSet name "News" */
       jQuery.dmxDataSet(
         {"id": "News", "url": "../dmxDatabaseSources/news.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "News" */
  /* dmxDataSet name "RegisteredTournament" */
       jQuery.dmxDataSet(
         {"id": "RegisteredTournament", "url": "../dmxDatabaseSources/RegisteredTournaments.php", "data": {"limit": "25"}, "dataSourceType": "database", "dataType": "jsonp"}
       );
  /* END dmxDataSet name "RegisteredTournament" */
function dmxDataBindingsAction(action, target) { // v1.72
 var inst, evt = jQuery.event.fix(window.event || arguments.callee.caller.arguments[0]),
  args = Array.prototype.slice.call(arguments, 2);

 switch (action) {
  case 'refresh': inst = 'ds'; action = 'load'; break;
  case 'setPage': inst = 'ds'; break;
  case 'selectCurrent': inst = 'rp'; action = 'select'; break;
 }

 inst = (inst == 'ds')
  ? jQuery.dmxDataSet.dataSets[target]
  : jQuery(evt.target).closest('[data-binding-id="' + target + '"]').data('repeater')
  || jQuery.dmxDataBindings.regions[target];

 if (inst) inst[action].apply(inst, args);

 evt.preventDefault();
}
</script>
</head>
<?php include '../Templates/parts/header.php'; ?>
		<?php include '../Templates/parts/container-top.php'; ?>
        	<?php include '../Templates/includes/user-navigation.php'; ?>
                <div class="two_column_1">
                  <h2 class="no_shadow" style="text-align:center;">Player Bio</h2>
					  <script>
						$(document).ready(function(){
							$(".edit").click(function(){
								$(".editable").toggleClass("active");
							});
						});
					  </script>
                      <script>
						$(document).ready(function(){
							$(".exit").click(function(){
								$(".editable").toggleClass("active");
							});
						});
					  </script>
                  	<div class="editable" >
                    	<p class="user-bio">{{PlayerProfile.data[0].user_bio}}
                        </p>
                        <p class="user-bio" id="user-bio-default" data-binding-hide="{{PlayerProfile.data[0].user_bio}}">This is a sample bio.  New functionality to modify your profile will be added in the near future.</p>
                         <form method="post" class="edit-user-bio" id="edit-user-bio">
  <div class="element-input"><label class="title"><b>Bio</b></label><textarea name="userBio" type="text" class="large" id="userBio" value="{{PlayerProfile.data[0].user_bio}}" maxlength="280" ></textarea>
    <input name="userID" type="hidden" id="userID" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
  </div>
<div class="submit"><input type="submit" value="Submit" id="bioSave" class="exit"/></div>
						</form>
                        <div style="text-align:right;"> 
                            <a class="exit">
                              <span class="glyphicon glyphicon-remove" ></span>
                            </a>
                         </div>
                         <div style="text-align:right;"> 
                            <a class="edit">
                              <span class="glyphicon glyphicon-edit" ></span>
                            </a>
                         </div>
                     </div>
                        <!--
                        
                    	<div id="jQueryTabs1" class="jQueryTabs_container skin7">
                    	  <div class="jQueryTabs_nav">
                    	    <ul class="jQueryTabs_navUL">
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content1" class="jQueryTabs_navLink selected"> <i class="jQueryTabs_navImg fa fa-home"></i> <span class="jQueryTabs_navSpan">Home</span> </a> </li>
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content2" class="jQueryTabs_navLink"> <i class="jQueryTabs_navImg fa fa-book"></i> <span class="jQueryTabs_navSpan">Login</span> </a> </li>
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content3" class="jQueryTabs_navLink"> <i class="jQueryTabs_navImg fa fa-pencil"></i> <span class="jQueryTabs_navSpan">Edit Profile</span> </a> </li>
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content4" class="jQueryTabs_navLink"> <i class="jQueryTabs_navImg fa fa-cog"></i> <span class="jQueryTabs_navSpan">Change Icon</span> </a> </li>
                    	      <li class="jQueryTabs_navLI"> <a href="#jQueryTabs1_content5" class="jQueryTabs_navLink"> <i class="jQueryTabs_navImg fa fa-camera-retro"></i> <span class="jQueryTabs_navSpan">Upload/Edit Photos</span> </a> </li>
                  	      </ul>
                  	    </div>
                    	  <div class="jQueryTabs_content">
                    	    <div id="jQueryTabs1_content1" class="jQueryTabs_contentDivs">
                    	      <h1>Tab 1 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  	      </div>
                    	    <div id="jQueryTabs1_content2" class="jQueryTabs_contentDivs hidden">
                    	      <h1>Tab 2 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  	      </div>
                    	    <div id="jQueryTabs1_content3" class="jQueryTabs_contentDivs hidden">
                    	      <h1>Tab 3 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  	      </div>
                    	    <div id="jQueryTabs1_content4" class="jQueryTabs_contentDivs hidden">
                    	      <h1>Tab 4 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                  	      </div>
                    	    <div id="jQueryTabs1_content5" class="jQueryTabs_contentDivs hidden">
                    	      <h1>Tab 5 Content</h1>
                    	      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                              
                          
                  	      </div>
                  	    </div>
                           
                  	  </div>
                       -->
                </div>
				<div class="two_column_1">
                	<h2 class="no_shadow" style="text-align:center;">{{LoggedInUser.data[0].firstName}} {{LoggedInUser.data[0].lastName}}</h2>
                	<div class="center"><h3 style="font-size:1.8em;color:gold;text-shadow:1px 1px 5px black;">RP Stash: <span data-binding-show="{{PlayerProfile.data[0].user_points}}">{{PlayerProfile.data[0].user_points}} Points</span></h3><span data-binding-hide="{{PlayerProfile.data[0].user_points}}"><h3 style="font-size:1.8em;color:gold;text-shadow:1px 1px 5px black;">No Points Available</h3></span><br/><img src="/uploads/player/<?php echo $_SESSION['SecurityAssist_id']; ?>/{{logged_in_player_full.data[0].user_icon}}" alt="" class="shadow" width="220px"/></div>
                    <h1 class="center" style="text-transform: initial;"><a href="/players/liveProfile.php" style="color:black;text-decoration:none;"><span class="glyphicon glyphicon-user" style="font-size:.7em"></span> {{LoggedInUser.data[0].user_handle}}</a></h1>
        			<div class="center">
                        <ul class="inline">
                            <li class="item">
          						<span class="glyphicon glyphicon-envelope" style="font-size:2em;"></span>
                            <!--<li><a href="#">Create Match</a></li>-->
                            <li><a href="#">View Your Friends List</a></li>
                            <li><a href="/players/user_login_update.php?id=<?php echo $_SESSION['SecurityAssist_id']; ?>">Account Settings</a></li>
                        </ul>
                    </div>
                </div> 
                <div class="full_width">
                <h2>Player Dashboard</h2>
				<h4>*Active Events</h4>
                    <!--
                    <table width="95%" border="1">
                      <tbody>
                        <tr>
                          <td>Tournament Name</td>
                          <td>Round</td>
                          <td>Match/Table</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr data-binding-repeat="{{RoundAssignment.data}}" data-binding-id="repeat1">
                          <td>{{tournament_name}}</td>
                          <td>{{tourney_round_title}}</td>
                          <td>Match {{Game_session}}/ Table {{table_id}}</td>
                          <td><a href="FactionAssignment.php?td={{tournament_id}}&rd={{tourney_round_id}}&gsi={{game_id}}&gs={{Game_session}}">Choose<br>
                            Factions</a></td>
                          <td><p><a href="roundDetail.php?td={{tournament_id}}&rd={{tourney_round_id}}">View Details</a></p></td>
                          <td><p><a href="submitscore.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">Submit Results</a></p>
                            
                            <p>&nbsp;</p></td>
                          <td><a href="scoreview.php?td={{tournament_id}}&rd={{tourney_round_id}}&gs={{Game_session}}&tbl={{table_id}}">View Results</a></td>
                        </tr>
                      </tbody>
                    </table>
                    -->
                <h3> My Current Tournament Registrations</h3>
                <div title="{{tournament_name}}" data-binding-id="repeat2" data-binding-repeat="RegisteredTournament.data">
                	<li style="padding:0 1% 0 1%;">{{tournament_name}} {{tournament_startDate.formatDate( "MM/dd/yy" )}} - {{Tournament_endDate.formatDate( "MM/dd/yy" )}}</li>
                </div>  
            </div>
            <div class="full_width">
                	<div class="two_column_1">
                    	   <h2 style="text-align:center;">Info (demo content)</h2>
                                <ul class="list">
                                  <li class="">Available to Play: <b>&nbsp;Yes</b></li>
                                  <li class="">Local to you: <b>&nbsp;Yes</b> (Approx. 10 mi)</li>
                                  <li class="">Local Store: <a href="#" target="_self" class="anchor3">DryRox Games and Artisinal Cheeses</a></li>
                                  <li class="">Games: &nbsp;Chess, Warhammer 40K, Magic.</li>
                                </ul>    	
                    </div>
                    <div class="two_column_1">
                          <h2 style="text-align:center;">Recent Activity (demo content)</h2>
                              <ul>
                                <li> <a href="#">Played [Game] with [Username] and [Username]</a>
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
            <div class="full_width">
                	<div class="two_column_1">
                    	   <h2 style="text-align:center;">Social Links</h2>
                           <script>
							$(document).ready(function(){
								$(".edit2").click(function(){
									$(".editable2").toggleClass("active");
								});
							});
						  </script>
						  <script>
							$(document).ready(function(){
								$(".exit2").click(function(){
									$(".editable2").toggleClass("active");
								});
							});
						  </script>
                           <div class="editable2">
                                <ul class="list user-social">
                                  <li class="">Facebook: <a href="{{PlayerProfile.data[0].user_facebook}}" target="_blank" style="display:inline;text-decoration:initial;">{{PlayerProfile.data[0].user_facebook}}</a></li>
                                  <li class="">Twitter:<a href="{{PlayerProfile.data[0].user_twitter}}" target="_blank" style="display:inline;text-decoration:initial;"> {{PlayerProfile.data[0].user_twitter}}</a></li>
                                  <li class="">Instagram: <a href="{{PlayerProfile.data[0].user_instagram}}" target="_blank" style="display:inline;text-decoration:initial;">{{PlayerProfile.data[0].user_instagram}}</a></li>
                                  <li class="">Google+: <a href="{{PlayerProfile.data[0].user_google_plus}}" target="_blank" style="display:inline;text-decoration:initial;">{{PlayerProfile.data[0].user_google_plus}}</a></li>
                                  <li class="">YouTube: <a href="{{PlayerProfile.data[0].user_youtube}}" target="_blank" style="display:inline;text-decoration:initial;">{{PlayerProfile.data[0].user_youtube}}</a></li>
                                  <li class="">Twitch: <a href="{{PlayerProfile.data[0].user_twitch}}" target="_blank" style="display:inline;text-decoration:initial;">{{PlayerProfile.data[0].user_twitch}}</a></li>
                                  <li class="">Custom Url: <a href="{{PlayerProfile.data[0].user_website}}" target="_blank" style="display:inline;text-decoration:initial;">{{PlayerProfile.data[0].user_website}}</a></li>
                                </ul> 
                                <form method="post" class="edit-user-social" id="edit-user-social" name="edit-user-social">
                                <li> <label for="user_facebook" class="sublabel" > <b>Facebook:</b></label>
                                  <input id="user_facebook" name="user_facebook" type="text" value="{{PlayerProfile.data[0].user_facebook}}" class="formTextfield_Medium" tabindex="15" title="Please enter a value." placeholder="http://">
                                    </li> 
                                    <li> <label for="user_twitter" class="sublabel" > <b>Twitter:</b></label>
                                  <input id="user_twitter" name="user_twitter" type="text" value="{{PlayerProfile.data[0].user_twitter}}" class="formTextfield_Medium" tabindex="15" title="Please enter a value." placeholder="http://">
                                    </li> 
                                    <li> <label for="user_instagram" class="sublabel" > <b>Instagram:</b></label>
                                  <input id="user_instagram" name="user_instagram" type="text" value="{{PlayerProfile.data[0].user_instagram}}" class="formTextfield_Medium" tabindex="16" title="Please enter a value." placeholder="http://">
                                    </li> 
                                    <li> <label for="user_google_plus" class="sublabel" > <b>Google+:</b></label>
                                  <input id="user_google_plus" name="user_google_plus" type="text" value="{{PlayerProfile.data[0].user_google_plus}}" class="formTextfield_Medium" tabindex="17" title="Please enter a value." placeholder="http://">
                                    </li> 
                                    <li> <label for="user_youtube" class="sublabel" > <b>YouTube:</b></label>
                                  <input id="user_youtube" name="user_youtube" type="text" value="{{PlayerProfile.data[0].user_youtube}}" class="formTextfield_Medium" tabindex="18" title="Please enter a value." placeholder="http://">
                                    </li> 
                                    <li> <label for="user_twitch" class="sublabel" > <b>Twitch:</b></label>
                                  <input id="user_twitch" name="user_twitch" type="text" value="{{PlayerProfile.data[0].user_twitch}}" class="formTextfield_Medium" tabindex="19" title="Please enter a value." placeholder="http://">
                                    </li> 
                                    <li> <label for="user_website" class="sublabel" > <b>Personal Website:</b></label>
                                  <input id="user_website" name="user_website" type="text" value="{{PlayerProfile.data[0].user_website}}" class="formTextfield_Medium" tabindex="20" title="Please enter a value." placeholder="http://">
                                <input name="socialuserid" type="hidden" id="socialuserid" form="edit-user-social" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
                                    </li> 
                                  <div class="submit"><input name="socialSave" type="submit" class="exit2" id="socialSave" form="edit-user-social" formmethod="POST" value="Submit"/></div>
                                </form>
                                <div style="text-align:right;"> 
                                    <a class="exit2">
                                      <span class="glyphicon glyphicon-remove" ></span>
                                    </a>
                                 </div>
                                 <div style="text-align:right;"> 
                                    <a class="edit2">
                                      <span class="glyphicon glyphicon-edit" ></span>
                                    </a>
                                 </div>
                            </div>          	
                    </div>
                    <div class="two_column_1">
                          <h2 style="text-align:center;">Contact (hidden from public profile)</h2>
                          <script>
							$(document).ready(function(){
								$(".edit3").click(function(){
									$(".editable3").toggleClass("active");
								});
							});
						  </script>
						  <script>
							$(document).ready(function(){
								$(".exit3").click(function(){
									$(".editable3").toggleClass("active");
								});
							});
						  </script>
                          <div class="editable3">
                              <div class="user-contact">
                                  <ul>
                                    <li>E-mail: {{PlayerProfile.data[0].email}}</li>
                                    <li>Phone: {{PlayerProfile.data[0].user_main_phone}}</li>
                                    <li>Address: {{PlayerProfile.data[0].user_street_address}}</li>
                                    <li>City: {{PlayerProfile.data[0].user_city}}</li>
                                    <li>State: {{PlayerProfile.data[0].user_state}}</li>
                                    <li>Zip: {{PlayerProfile.data[0].user_zip}}</li>
                                  </ul>
                              </div>
                             <form method="post" class="edit-user-contact" name="edit-user-contact" id="edit-user-contact">
      							<div class="element-input"><label class="title"><b>Email</b></label><input name="email" type="text" class="large" id="email" value="{{PlayerProfile.data[0].email}}" /></div>
                                <div class="element-input"><label class="title"><b>Phone</b></label><input name="user_main_phone" type="text" class="large" id="user_main_phone" value="{{PlayerProfile.data[0].user_main_phone}}" /></div>
                                <div class="element-input"><label class="title"><b>Address</b></label><input name="user_street_address" type="text" class="large" id="user_street_address" value="{{PlayerProfile.data[0].user_street_address}}" /></div>
                                <div class="element-input"><label class="title"><b>City</b></label><input name="user_city" type="text" class="large" id="user_city" value="{{PlayerProfile.data[0].user_city}}" /></div>
                                <div class="element-input"><label class="title"><b>State</b></label><input name="user_state" type="text" class="large" id="user_state" value="{{PlayerProfile.data[0].user_state}}" /></div>
                                <div class="element-input"><label class="title"><b>Zip</b></label><input name="user_zip" type="text" class="large" id="user_zip" value="{{PlayerProfile.data[0].user_zip}}" /></div>
                                <input name="contact_user_id" type="hidden" id="contact_user_id" value="<?php echo $_SESSION['SecurityAssist_id']; ?>">
   							   <div class="submit"><input name="contactSave" type="submit" class="exit3" id="contactSave" form="edit-user-contact" formmethod="POST" value="Submit"/></div>
                            </form>
                            <div style="text-align:right;"> 
                                <a class="exit3">
                                  <span class="glyphicon glyphicon-remove" ></span>
                                </a>
                             </div>
                             <div style="text-align:right;"> 
                                <a class="edit3">
                                  <span class="glyphicon glyphicon-edit" ></span>
                                </a>
                             </div>
                          </div>
                    </div>
                </div>
                <div class="full_width">
                	<h2>Photostream
                        <a href="#">
                          <span class="glyphicon glyphicon-upload" style="float:right;"></span>
                        </a>
                    </h2>
                	<div class="center thumbnail">
                    	<img src="../media/filler/dice.png" alt="" />
                    	<img src="../media/filler/game1.jpeg" alt=""/> 
                        <img src="../media/filler/game3.jpg" alt=""/>
                    	<img src="../media/filler/game2.jpg" alt=""/> 
                    </div>
                </div>       
    
                      </div>
                </div>
                <div class="frame_b row">{{tournament_startDate.formatDate( "W, M dd y" )}}
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
/* dmxServerAction name "BioUpdate" */
       jQuery.dmxServerAction(
         {"id": "BioUpdate", "url": "../dmxConnect/api/updateBio.php", "form": "#edit-user-bio", "data": {}, "onSuccess": "dmxDataBindingsAction('refresh','PlayerProfile',{});"}
       );
  /* END dmxServerAction name "BioUpdate" */
  /* dmxServerAction name "socialUpdate" */
       jQuery.dmxServerAction(
         {"id": "socialUpdate", "url": "../dmxConnect/api/updateSocialLinks.php", "form": "#edit-user-social", "data": {}, "onSuccess": "dmxDataBindingsAction('refresh','PlayerProfile',{'data':{\"limit\": \"1\"}});"}
       );
  /* END dmxServerAction name "socialUpdate" */
  /* dmxServerAction name "updateContact" */
       jQuery.dmxServerAction(
         {"id": "updateContact", "url": "../dmxConnect/api/updateContacts.php", "form": "#edit-user-contact", "data": {}, "onSuccess": "dmxDataBindingsAction('refresh','PlayerProfile',{});"}
       );
  /* END dmxServerAction name "updateContact" */
    </script>
</body>
	<script><?php include ($pathToFile. "/Scripts/prefixfree.min.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/mobile-toggle.js"); ?></script>
    <script><?php include ($pathToFile. "/Scripts/backtotop.js"); ?></script>
</html>