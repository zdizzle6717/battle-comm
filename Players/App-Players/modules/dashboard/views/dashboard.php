<div class="two_column_1">
  <h2 class="no_shadow" style="text-align:center;">Player Bio</h2>
	<div class="editable" >
		<p class="user-bio">{{Dashboard.currentUser.user_bio}}
		</p>
		<p class="user-bio" id="user-bio-default" data-binding-hide="{{Dashboard.currentUser.user_bio}}">This is a sample bio.  New functionality to modify your profile will be added in the near future.</p>
		 <form method="post" class="edit-user-bio" id="edit-user-bio">
<div class="element-input"><label class="title"><b>Bio</b></label><textarea name="userBio" type="text" class="large" id="userBio" value="{{Dashboard.currentUser.user_bio}}" maxlength="280" ></textarea>
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
</div>
<div class="two_column_1">
	<h2 class="no_shadow" style="text-align:center;">{{Dashboard.currentUser.firstName}} {{Dashboard.currentUser.lastName}}</h2>
	<div class="center"><h3 style="font-size:1.8em;color:gold;text-shadow:1px 1px 5px black;">RP Stash: <span data-binding-show="{{Dashboard.currentUser.user_points}}">{{Dashboard.currentUser.user_points || 0}} Points</span></h3><span data-binding-hide="{{Dashboard.currentUser.user_points}}"><h3 style="font-size:1.8em;color:gold;text-shadow:1px 1px 5px black;">No Points Available</h3></span><br/><img ng-src="/uploads/players/{{Dashboard.currentUser.user_icon}}" alt="" class="shadow" width="220px"/></div>
	<h1 class="center" style="text-transform: initial;"><a ui-sref="profile" style="color:black;text-decoration:none;"><span class="glyphicon glyphicon-user" style="font-size:.7em"></span> {{Dashboard.currentUser.user_handle}}</a></h1>
	<div class="center">
		<ul class="inline">
			<li class="item">
				<span class="glyphicon glyphicon-envelope" style="font-size:2em;"></span>
			<!--<li><aui-sref="dashboard"">Create Match</a></li>-->
			<li><aui-sref="dashboard"">View Your Friends List</a></li>
			<li><a ui-sref="dashboard">Account Settings</a></li>
		</ul>
	</div>
</div>
<div class="full_width">
<h2>Player Dashboard</h2>
<h4>*Active Events</h4>
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
				  <li class="">Local Store: <aui-sref="dashboard"" target="_self" class="anchor3">DryRox Games and Artisinal Cheeses</a></li>
				  <li class="">Games: &nbsp;Chess, Warhammer 40K, Magic.</li>
				</ul>
	</div>
	<div class="two_column_1">
		  <h2 style="text-align:center;">Recent Activity (demo content)</h2>
			  <ul>
				<li> <a ui-sref="dashboard">Played [Game] with [Username] and [Username]</a>
				  <div class="separator"></div>
				</li>
				<li> <aui-sref="dashboard"">Signed up for [Tournament]</a>
				  <div class="separator"></div>
				</li>
				<li> <aui-sref="dashboard"">Attended [Event] at [FLGS]</a>
				  <div class="separator"></div>
				</li>
			  </ul>
	</div>
</div>
<div class="full_width">
	<div class="two_column_1">
		   <h2 style="text-align:center;">Social Links</h2>
		   <div class="editable2">
				<ul class="list user-social">
				  <li class="">Facebook: <a href="{{Dashboard.currentUser.user_facebook}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_facebook}}</a></li>
				  <li class="">Twitter:<a href="{{Dashboard.currentUser.user_twitter}}" target="_blank" style="display:inline;text-decoration:initial;"> {{Dashboard.currentUser.user_twitter}}</a></li>
				  <li class="">Instagram: <a href="{{Dashboard.currentUser.user_instagram}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_instagram}}</a></li>
				  <li class="">Google+: <a href="{{Dashboard.currentUser.user_google_plus}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_google_plus}}</a></li>
				  <li class="">YouTube: <a href="{{Dashboard.currentUser.user_youtube}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_youtube}}</a></li>
				  <li class="">Twitch: <a href="{{Dashboard.currentUser.user_twitch}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_twitch}}</a></li>
				  <li class="">Custom Url: <a href="{{Dashboard.currentUser.user_website}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_website}}</a></li>
				</ul>
				<form method="post" class="edit-user-social" id="edit-user-social" name="edit-user-social">
				<li> <label for="user_facebook" class="sublabel" > <b>Facebook:</b></label>
				  <input id="user_facebook" name="user_facebook" type="text" value="{{Dashboard.currentUser.user_facebook}}" class="formTextfield_Medium" tabindex="15" title="Please enter a value." placeholder="http://">
					</li>
					<li> <label for="user_twitter" class="sublabel" > <b>Twitter:</b></label>
				  <input id="user_twitter" name="user_twitter" type="text" value="{{Dashboard.currentUser.user_twitter}}" class="formTextfield_Medium" tabindex="15" title="Please enter a value." placeholder="http://">
					</li>
					<li> <label for="user_instagram" class="sublabel" > <b>Instagram:</b></label>
				  <input id="user_instagram" name="user_instagram" type="text" value="{{Dashboard.currentUser.user_instagram}}" class="formTextfield_Medium" tabindex="16" title="Please enter a value." placeholder="http://">
					</li>
					<li> <label for="user_google_plus" class="sublabel" > <b>Google+:</b></label>
				  <input id="user_google_plus" name="user_google_plus" type="text" value="{{Dashboard.currentUser.user_google_plus}}" class="formTextfield_Medium" tabindex="17" title="Please enter a value." placeholder="http://">
					</li>
					<li> <label for="user_youtube" class="sublabel" > <b>YouTube:</b></label>
				  <input id="user_youtube" name="user_youtube" type="text" value="{{Dashboard.currentUser.user_youtube}}" class="formTextfield_Medium" tabindex="18" title="Please enter a value." placeholder="http://">
					</li>
					<li> <label for="user_twitch" class="sublabel" > <b>Twitch:</b></label>
				  <input id="user_twitch" name="user_twitch" type="text" value="{{Dashboard.currentUser.user_twitch}}" class="formTextfield_Medium" tabindex="19" title="Please enter a value." placeholder="http://">
					</li>
					<li> <label for="user_website" class="sublabel" > <b>Personal Website:</b></label>
				  <input id="user_website" name="user_website" type="text" value="{{Dashboard.currentUser.user_website}}" class="formTextfield_Medium" tabindex="20" title="Please enter a value." placeholder="http://">
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
		  <div class="editable3">
			  <div class="user-contact">
				  <ul>
					<li>E-mail: {{Dashboard.currentUser.email}}</li>
					<li>Phone: {{Dashboard.currentUser.user_main_phone}}</li>
					<li>Address: {{Dashboard.currentUser.user_street_address}}</li>
					<li>City: {{Dashboard.currentUser.user_city}}</li>
					<li>State: {{Dashboard.currentUser.user_state}}</li>
					<li>Zip: {{Dashboard.currentUser.user_zip}}</li>
				  </ul>
			  </div>
			 <form method="post" class="edit-user-contact" name="edit-user-contact" id="edit-user-contact">
				<div class="element-input"><label class="title"><b>Email</b></label><input name="email" type="text" class="large" id="email" value="{{Dashboard.currentUser.email}}" /></div>
				<div class="element-input"><label class="title"><b>Phone</b></label><input name="user_main_phone" type="text" class="large" id="user_main_phone" value="{{Dashboard.currentUser.user_main_phone}}" /></div>
				<div class="element-input"><label class="title"><b>Address</b></label><input name="user_street_address" type="text" class="large" id="user_street_address" value="{{Dashboard.currentUser.user_street_address}}" /></div>
				<div class="element-input"><label class="title"><b>City</b></label><input name="user_city" type="text" class="large" id="user_city" value="{{Dashboard.currentUser.user_city}}" /></div>
				<div class="element-input"><label class="title"><b>State</b></label><input name="user_state" type="text" class="large" id="user_state" value="{{Dashboard.currentUser.user_state}}" /></div>
				<div class="element-input"><label class="title"><b>Zip</b></label><input name="user_zip" type="text" class="large" id="user_zip" value="{{Dashboard.currentUser.user_zip}}" /></div>
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
		<aui-sref="dashboard"">
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
