<div class="full_width ">
	<h2>Player Dashboard</h2>
</div>
<div class="two_column_1">
	<h2 class="no_shadow text-center">Player Bio</h2>
	<a ng-click="Dashboard.logout()">Logout?</a>
	<div class="editable">
		<div ng-if="Dashboard.readOnly.bio">
			<label class="title">Bio:</label>
			<p class="user-bio" ng-show="Dashboard.readOnly.bio">{{Dashboard.currentUser.bio}}
			</p>
		</div>
		<form name="bioForm" ng-show="!Dashboard.readOnly.bio" novalidate>
			<div class="form-group inline">
				<label class="title bold">Bio:</label>
				<textarea name="bio" type="text" id="bio" ng-model="Dashboard.currentUser.bio" maxlength="500"></textarea>
			</div>
		</form>
		<div class="text-right">
			<button class="exit" ng-click="Dashboard.savePlayer('bio')" ng-show="!Dashboard.readOnly.bio" ng-disabled="bioForm.$invalid">
				<span class="fa fa-check-square-o"></span>
			</button>
		</div>
		<div class="text-right" ng-show="Dashboard.readOnly.bio">
			<button class="edit" ng-click="Dashboard.toggleEdit('bio')">
				<span class="fa fa-edit"></span>
			</button>
		</div>
	</div>
	<h2 class="push-top-2x text-center">Social Links</h2>
	<div class="editable">
		<ul class="list user-social" ng-if="Dashboard.readOnly.links">
			<li class="">Facebook: <a href="{{Dashboard.currentUser.facebook}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.facebook}}</a></li>
			<li class="">Twitter:<a href="{{Dashboard.currentUser.twitter}}" target="_blank" style="display:inline;text-decoration:initial;"> {{Dashboard.currentUser.twitter}}</a></li>
			<li class="">Instagram: <a href="{{Dashboard.currentUser.instagram}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.instagram}}</a></li>
			<li class="">Twitch: <a href="{{Dashboard.currentUser.twitch}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.twitch}}</a></li>
			<li class="">Custom Url: <a href="{{Dashboard.currentUser.website}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.website}}</a></li>
		</ul>
		<form name="linksForm" ng-show="!Dashboard.readOnly.links" novalidate>
			<div class="form-group inline">
				<label class="title bold">Facebook:</label>
				<input name="facebook" type="url" id="facebook" placeholder="http://..." ng-model="Dashboard.currentUser.facebook" />
			</div>
			<div class="form-group inline">
				<label class="title bold">Twitter:</label>
				<input name="twitter" type="url" id="twitter" placeholder="http://..." ng-model="Dashboard.currentUser.twitter" />
			</div>
			<div class="form-group inline">
				<label class="title bold">Instagram:</label>
				<input name="instagram" type="url" id="instagram" placeholder="http://..." ng-model="Dashboard.currentUser.instagram" />
			</div>
			<div class="form-group inline">
				<label class="title bold">Twitch:</label>
				<input name="twitch" type="url" id="twitch" placeholder="http://..." ng-model="Dashboard.currentUser.twitch" />
			</div>
			<div class="form-group inline">
				<label class="title bold">Website:</label>
				<input name="website" type="url" id="website" placeholder="http://..." ng-model="Dashboard.currentUser.website" />
			</div>
		</form>
		<div class="text-right">
			<button class="exit" ng-click="Dashboard.savePlayer('links')" ng-show="!Dashboard.readOnly.links" ng-disabled="linksForm.$invalid">
				<span class="fa fa-check-square-o"></span>
			</button>
		</div>
		<div class="text-right" ng-show="Dashboard.readOnly.links">
			<button class="edit" ng-click="Dashboard.toggleEdit('links')">
				<span class="fa fa-edit"></span>
			</button>
		</div>
	</div>
</div>
<div class="two_column_1">
	<h2 class="no_shadow text-center" ng-if="!Dashboard.currentUser.firstName">Anonymous</h2>
	<h2 class="no_shadow text-center" ng-if="Dashboard.currentUser.firstName">{{Dashboard.currentUser.firstName}} {{Dashboard.currentUser.lastName}}</h2>
	<div class="text-center">
		<h3 class="gold-label">RP Stash: <span><strong>{{Dashboard.currentUser.points || 0}}</strong> Points</span></h3>
		<div class="flex-row-center push-top">
			<div class="profile-picture">
				<img ng-src="/uploads/players/{{Dashboard.currentUser.icon}}" alt="{{Dashboard.currentUser.username}}" class="shadow"/>
				<div class="upload-overlay" file-upload ratio="1:1" model="Dashboard.currentUser.icon" save="Dashboard.savePlayer()" param="'players'"></div>
			</div>
		</div>
	</div>
	<h1 class="center push-top" style="text-transform: initial;"><a ui-sref="profile({playerId: Dashboard.currentUser.id})" style="color:black;text-decoration:none;">{{Dashboard.currentUser.username}}</a></h1>
	<div class="center">
		<p><span class="fa fa-envelope" style="font-size:2em;"></span></p>
		<p><a ui-sref="dashboard">View Your Friends List</a></p>
		<p><a ui-sref="dashboard ">Account Settings</a></p>
	</div>
</div>
<div class="full_width ">
	<div class="two_column_1">
		<h2 class="text-center">Achievements</h2>
		<h3>Achievements have not yet been awarded.</h3>
	</div>
	<div class="two_column_1">
		<h2 class="text-center">Contact (hidden from public profile)</h2>
		<div class="editable">
			<div class="user-contact" ng-if="Dashboard.readOnly.contact">
				<ul>
					<li>E-mail: {{Dashboard.currentUser.email}}</li>
					<li>Phone: {{Dashboard.currentUser.main_phone}}</li>
					<li>Address: {{Dashboard.currentUser.street_address}}</li>
					<li>Apt/Suite: {{Dashboard.currentUser.apt_suite}}
					<li>City: {{Dashboard.currentUser.city}}</li>
					<li>State: {{Dashboard.currentUser.state}}</li>
					<li>Zip: {{Dashboard.currentUser.zip}}</li>
				</ul>
			</div>

			<form name="contactForm" ng-show="!Dashboard.readOnly.contact" novalidate>
				<div class="form-group inline">
					<label class="title bold">E-mail:</label>
					<input name="email" type="email" id="email" ng-model="Dashboard.currentUser.email" disabled/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Phone:</label>
					<input name="main_phone" type="text" id="main_phone" ng-model="Dashboard.currentUser.main_phone" ui-mask="(999) 999-9999" />
				</div>
				<div class="form-group inline">
					<label class="title bold">Address:</label>
					<input name="street_address" type="text" id="street_address" ng-model="Dashboard.currentUser.street_address" maxlength="50"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Apt/Suite:</label>
					<input name="apt_suite" type="text" id="apt_suite" ng-model="Dashboard.currentUser.apt_suite" maxlength="10"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">City:</label>
					<input name="city" type="text" id="city" ng-model="Dashboard.currentUser.city" maxlength="50"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">State:</label>
					<input name="state" type="text" id="state" ng-model="Dashboard.currentUser.state" maxlength="50"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Zip:</label>
					<input name="zip" type="text" id="zip" ng-model="Dashboard.currentUser.zip" minlength="5" maxlength="12"/>
				</div>
			</form>
			<div class="text-right">
				<button class="exit" ng-click="Dashboard.savePlayer('contact')" ng-show="!Dashboard.readOnly.contact" ng-disabled="contactForm.$invalid">
					<span class="fa fa-check-square-o"></span>
				</button>
			</div>
			<div class="text-right" ng-show="Dashboard.readOnly.contact">
				<button class="edit" ng-click="Dashboard.toggleEdit('contact')">
					<span class="fa fa-edit"></span>
				</button>
			</div>
		</div>
	</div>
</div>
<div class="full_width">
	<h2>Photostream
		<a ui-sref="dashboard">
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
