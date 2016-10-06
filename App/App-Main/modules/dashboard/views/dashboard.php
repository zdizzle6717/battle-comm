<div class="full_width ">
	<h2>Player Dashboard</h2>
</div>
<div class="two_column_1">
	<h2 class="no_shadow text-center">Player Bio</h2>
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
			<li class="">Google +: <a href="{{Dashboard.currentUser.googlePlus}}" target="_blank" style="display:inline;text-decoration:initial;">{{Dashboard.currentUser.googlePlus}}</a></li>
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
				<label class="title bold">Google +:</label>
				<input name="googlePlus" type="url" id="googlePlus" placeholder="http://..." ng-model="Dashboard.currentUser.googlePlus" />
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
		<h3 class="gold-label">RP Stash: <span><strong>{{Dashboard.currentUser.rewardPoints || 0}}</strong> Points</span></h3>
		<div class="flex-row-center push-top">
			<div class="profile-picture">
				<img ng-src="/uploads/players/{{Dashboard.currentUser.id}}/playerIcon/{{Dashboard.currentUser.icon}}" alt="{{Dashboard.currentUser.username}}" class="shadow" ng-if="Dashboard.currentUser.icon !== 'profile_image_default.png'"/>
				<img ng-src="/uploads/players/{{Dashboard.currentUser.icon}}" alt="{{Dashboard.currentUser.username}}" class="shadow" ng-if="Dashboard.currentUser.icon === 'profile_image_default.png'"/>
				<div class="upload-overlay" file-upload ratio="1:1" model="Dashboard.currentUser.icon" save="Dashboard.savePlayer()" params="['players', Dashboard.currentUser.id, 'playerIcon']"></div>
			</div>
		</div>
	</div>
	<h1 class="center push-top" style="text-transform: initial;"><a ui-sref="profile({playerId: Dashboard.currentUser.id})" style="color:black;text-decoration:none;">{{Dashboard.currentUser.username}}</a></h1>
	<div class="center">
		<p><strong>{{Dashboard.currentUser.totalWins}} / {{Dashboard.currentUser.totalDraws}} / {{Dashboard.currentUser.totalLosses}}</strong></p>
		<p><a ui-sref="dashboard">Account Settings</a></p>
	</div>
</div>
<div class="full_width">
	<h2>Friends</h2>
	<div class="friend-list">
		<img class="friend-icon" ng-src="/uploads/players/{{friend.friendId}}/playerIcon/thumbs/{{friend.icon}}" ui-sref="profile({'playerId': friend.id})" ng-repeat="friend in Dashboard.currentUser.UserFriends">
	</div>
	<div class="text-center" ng-if="Dashboard.currentUser.Friends.length <= 0">
		<h5>Search by player profile and click 'Add Friend' to send a friend request.</h5>
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
					<li>First Name: {{Dashboard.currentUser.firstName}}</li>
					<li>Last Name: {{Dashboard.currentUser.lastName}}</li>
					<li>E-mail: {{Dashboard.currentUser.email}}</li>
					<li>Phone: {{Dashboard.currentUser.mainPhone}}</li>
					<li>Address: {{Dashboard.currentUser.streetAddress}}</li>
					<li>Apt/Suite: {{Dashboard.currentUser.aptSuite}}
					<li>City: {{Dashboard.currentUser.city}}</li>
					<li>State: {{Dashboard.currentUser.state}}</li>
					<li>Zip: {{Dashboard.currentUser.zip}}</li>
				</ul>
			</div>

			<form name="contactForm" ng-show="!Dashboard.readOnly.contact" novalidate>
				<div class="form-group inline">
					<label class="title bold">First Name:</label>
					<input name="firstName" type="text" id="firstName" ng-model="Dashboard.currentUser.firstName"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Last Name:</label>
					<input name="lastName" type="text" id="lastName" ng-model="Dashboard.currentUser.lastName"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">E-mail:</label>
					<input name="email" type="email" id="email" ng-model="Dashboard.currentUser.email" disabled/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Phone:</label>
					<input name="mainPhone" type="text" id="mainPhone" ng-model="Dashboard.currentUser.mainPhone" ui-mask="(999) 999-9999" />
				</div>
				<div class="form-group inline">
					<label class="title bold">Address:</label>
					<input name="streetAddress" type="text" id="streetAddress" ng-model="Dashboard.currentUser.streetAddress" maxlength="50"/>
				</div>
				<div class="form-group inline">
					<label class="title bold">Apt/Suite:</label>
					<input name="aptSuite" type="text" id="aptSuite" ng-model="Dashboard.currentUser.aptSuite" maxlength="10"/>
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
		<div file-upload class="right collapse" model="Dashboard.newPhoto" save="Dashboard.savePhoto()" params="['players', Dashboard.currentUser.id, 'photostream']" button-text="Add Photo" icon-class="fa-plus" ng-if="Dashboard.currentUser.UserPhotos.length <= 50"></div>
	</h2>
	<div class="photostream">
		<div popup ng-repeat="photo in Dashboard.currentUser.UserPhotos">
			<img ng-src="/uploads/players/{{Dashboard.currentUser.id}}/photostream/{{photo.url}}" alt=""/>
		</div>
	</div>
	<div class="text-center" ng-if="Dashboard.currentUser.UserPhotos.length <= 0">
		<h5>Upload photos from you dashboard to share your table-top experience with friends.</h5>
	</div>
</div>
<div class="full_width text-right">
	<a ng-click="Dashboard.logout()">Logout?</a>
</div>
