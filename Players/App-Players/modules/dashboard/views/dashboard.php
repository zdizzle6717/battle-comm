<div class="two_column_1">
	<h2 class="no_shadow" style="text-align:center;">Player Bio</h2>
	<div class="editable">
		<div ng-if="Dashboard.readOnly.bio">
			<label class="title">Bio:</label>
			<p class="user-bio" ng-show="Dashboard.readOnly.bio">{{Dashboard.currentUser.user_bio}}
			</p>
		</div>
		<form name="bioForm" ng-show="!Dashboard.readOnly.bio" novalidate>
			<div class="form-group inline">
				<label class="title bold">Bio:</label>
				<textarea name="user_bio" type="text" id="user_bio" ng-model="Dashboard.currentUser.user_bio" maxlength="500"></textarea>
			</div>
		</form>
		<div style="text-align:right;">
			<button class="exit" ng-click="Dashboard.savePlayer('bio')" ng-show="!Dashboard.readOnly.bio" ng-disabled="bioForm.$invalid">
				<span class="fa fa-check-square-o"></span>
			</button>
		</div>
		<div style="text-align:right;" ng-show="Dashboard.readOnly.bio">
			<button class="edit" ng-click="Dashboard.toggleEdit('bio')">
				<span class="fa fa-edit"></span>
			</button>
		</div>
	</div>
</div>
<div class="two_column_1">
	<h2 class="no_shadow" style="text-align:center;">{{Dashboard.currentUser.firstName}} {{Dashboard.currentUser.lastName}}</h2>
	<div class="text-center">
		<h3 class="gold-label">RP Stash: <span><strong>{{Dashboard.currentUser.user_points || 0}}</strong> Points</span></h3>
		<div class="flex-row-center push-top">
			<div class="profile-picture">
				<img ng-src="/uploads/players/{{Dashboard.currentUser.user_icon}}" alt="{{Dashboard.currentUser.user_handle}}" class="shadow"/>
				<div class="upload-overlay" file-upload ratio="1:1" model="Dashboard.currentUser.user_icon" save="Dashboard.savePlayer()" param="'players'"></div>
			</div>
		</div>
	</div>
	<h1 class="center push-top" style="text-transform: initial;"><a ui-sref="profile" style="color:black;text-decoration:none;">{{Dashboard.currentUser.user_handle}}</a></h1>
	<div class="center">
		<ul class="inline">
			<li class="item">
				<span class="fa fa-envelope" style="font-size:2em;"></span>
				<!--<li><aui-sref="dashboard"">Create Match</a></li>-->
				<li>
					<a ui-sref="dashboard">View Your Friends List</a></li>
			<li><a ui-sref="dashboard ">Account Settings</a></li>
		</ul>
	</div>
</div>
<div class="full_width ">
<h2>Player Dashboard</h2>
<h4>*Active Events</h4>
<h3> My Current Tournament Registrations</h3>
<div title="{{tournament_name" data-binding-id="repeat2" data-binding-repeat="RegisteredTournament.data">
	<li style="padding:0 1% 0 1%; ">{{tournament_name}} {{tournament_startDate.formatDate( "MM/dd/yy " )}} - {{Tournament_endDate.formatDate( "MM/dd/yy " )}}</li>
</div>
</div>
<div class="full_width ">
	<div class="two_column_1 ">
		   <h2 style="text-align:center; ">Info (demo content)</h2>
				<ul class="list ">
				  <li class=" ">Available to Play: &nbsp;Yes</li>
				  <li class=" ">Local to you: &nbsp;Yes (Approx. 10 mi)</li>
				  <li class=" ">Local Store: <aui-sref="dashboard "" target="_self" class="anchor3">DryRox Games and Artisinal Cheeses</a>
				</li>
				<li class="">Games: &nbsp;Chess, Warhammer 40K, Magic.</li>
		</ul>
	</div>
	<div class="two_column_1">
		<h2 style="text-align:center;">Recent Activity (demo content)</h2>
		<ul>
			<li> <a ui-sref="dashboard">Played [Game] with [Username] and [Username]</a>
				<div class="separator"></div>
			</li>
			<li>
				<aui-sref="dashboard" ">Signed up for [Tournament]</a>
				  <div class="separator "></div>
				</li>
				<li> <aui-sref="dashboard "">Attended [Event] at [FLGS]</a>
					<div class="separator"></div>
			</li>
		</ul>
	</div>
</div>
<div class="full_width">
	<div class="two_column_1">
		<h2 style="text-align:center;">Social Links</h2>
		<div class="editable">
			<ul class="list user-social" ng-if="Dashboard.readOnly.links">
				<li class="">Facebook: <a href="{{Dashboard.currentUser.user_facebook}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_facebook}}</a></li>
				<li class="">Twitter:<a href="{{Dashboard.currentUser.user_twitter}}" target="_blank" style="display:inline;text-decoration:initial;"> {{Dashboard.currentUser.user_twitter}}</a></li>
				<li class="">Instagram: <a href="{{Dashboard.currentUser.user_instagram}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_instagram}}</a></li>
				<li class="">Twitch: <a href="{{Dashboard.currentUser.user_twitch}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_twitch}}</a></li>
				<li class="">Custom Url: <a href="{{Dashboard.currentUser.user_website}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.user_website}}</a></li>
			</ul>
			<form name="linksForm" ng-show="!Dashboard.readOnly.links" novalidate>
				<div class="form-group inline">
					<label class="title bold">Facebook:</label>
					<input name="user_facebook" type="url" id="user_facebook" placeholder="http://..." ng-model="Dashboard.currentUser.user_facebook" />
				</div>
				<div class="form-group inline">
					<label class="title bold">Twitter:</label>
					<input name="user_twitter" type="url" id="user_twitter" placeholder="http://..." ng-model="Dashboard.currentUser.user_twitter" />
				</div>
				<div class="form-group inline">
					<label class="title bold">Instagram:</label>
					<input name="user_instagram" type="url" id="user_instagram" placeholder="http://..." ng-model="Dashboard.currentUser.user_instagram" />
				</div>
				<div class="form-group inline">
					<label class="title bold">Twitch:</label>
					<input name="user_twitch" type="url" id="user_twitch" placeholder="http://..." ng-model="Dashboard.currentUser.user_twitch" />
				</div>
				<div class="form-group inline">
					<label class="title bold">Website:</label>
					<input name="user_website" type="url" id="user_website" placeholder="http://..." ng-model="Dashboard.currentUser.user_website" />
				</div>
			</form>
			<div style="text-align:right;">
				<button class="exit" ng-click="Dashboard.savePlayer('links')" ng-show="!Dashboard.readOnly.links" ng-disabled="linksForm.$invalid">
					<span class="fa fa-check-square-o"></span>
				</button>
			</div>
			<div style="text-align:right;" ng-show="Dashboard.readOnly.links">
				<button class="edit" ng-click="Dashboard.toggleEdit('links')">
					<span class="fa fa-edit"></span>
				</button>
			</div>
		</div>
	</div>
	<div class="two_column_1">
		<h2 style="text-align:center;">Contact (hidden from public profile)</h2>
		<div class="editable">
			<div class="user-contact" ng-if="Dashboard.readOnly.contact">
				<ul>
					<li>E-mail: {{Dashboard.currentUser.email}}</li>
					<li>Phone: {{Dashboard.currentUser.user_main_phone}}</li>
					<li>Address: {{Dashboard.currentUser.user_street_address}}</li>
					<li>Apt/Suite: {{Dashboard.currentUser.user_apt_suite}}
					<li>City: {{Dashboard.currentUser.user_city}}</li>
					<li>State: {{Dashboard.currentUser.user_state}}</li>
					<li>Zip: {{Dashboard.currentUser.user_zip}}</li>
				</ul>
			</div>

			<form name="contactForm" ng-show="!Dashboard.readOnly.contact" novalidate>
				<div class="form-group inline">
					<label class="title bold">E-mail:</label>
					<input name="email" type="email" id="email" ng-model="Dashboard.currentUser.email" disabled/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Phone:</label>
					<input name="user_main_phone" type="text" id="user_main_phone" ng-model="Dashboard.currentUser.user_main_phone" ui-mask="(999) 999-9999" />
				</div>
				<div class="form-group inline">
					<label class="title bold">Address:</label>
					<input name="user_street_address" type="text" id="user_street_address" ng-model="Dashboard.currentUser.user_street_address" maxlength="50"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Apt/Suite:</label>
					<input name="user_apt_suite" type="text" id="user_apt_suite" ng-model="Dashboard.currentUser.user_apt_suite" maxlength="10"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">City:</label>
					<input name="user_city" type="text" id="user_city" ng-model="Dashboard.currentUser.user_city" maxlength="50"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">State:</label>
					<input name="user_state" type="text" id="user_state" ng-model="Dashboard.currentUser.user_state" maxlength="50"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Zip:</label>
					<input name="user_zip" type="text" id="user_zip" ng-model="Dashboard.currentUser.user_zip" minlength="5" maxlength="12"/>
				</div>
			</form>
			<div style="text-align:right;">
				<button class="exit" ng-click="Dashboard.savePlayer('contact')" ng-show="!Dashboard.readOnly.contact" ng-disabled="contactForm.$invalid">
					<span class="fa fa-check-square-o"></span>
				</button>
			</div>
			<div style="text-align:right;" ng-show="Dashboard.readOnly.contact">
				<button class="edit" ng-click="Dashboard.toggleEdit('contact')">
					<span class="fa fa-edit"></span>
				</button>
			</div>
		</div>
	</div>
</div>
<div class="full_width">
	<h2>Photostream
		<aui-sref="dashboard"">
		  <span class="fa fa-upload" style="float:right;"></span>
		</a>
	</h2>
	<div class="center thumbnail">
		<img src="../media/filler/dice.png" alt="" />
		<img src="../media/filler/game1.jpeg" alt="" />
		<img src="../media/filler/game3.jpg" alt="" />
		<img src="../media/filler/game2.jpg" alt="" />
	</div>
</div>
