<div class="full_width ">
	<h2>Player Profile</h2>
</div>
<div class="two_column_1">
  <h2 class="text-center">Player Info</h2>
		<h3 class="user-bio push-bottom-2x" ng-if="Profile.currentUser.bio">{{Profile.currentUser.bio}}</h3>
		<h3 class="user-bio push-bottom-2x" ng-if="!Profile.currentUser.bio">This player has not yet updaed their bio.</h3>

		<div class="sociallinks push-bottom" style="text-align:center;">
			<a ng-href="{{Profile.currentUser.facebook}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.facebook"><span class="fa fa-facebook" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.twitter}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.twitter"><span class="fa fa-twitter" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.instagram}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.instagram"><span class="fa fa-instagram" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.twitch}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.twitch"><span class="fa fa-twitch" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.googlePlus}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.googlePlus"><span class="fa fa-google-plus" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.website}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.website"><span class="fa fa-globe" style="font-size: 38px;"></span></a>
		</div>
</div>
<div class="two_column_1">
	<h2 class="text-center" ng-if="!Profile.currentUser.firstName">Anonymous</h2>
	<h2 class="text-center" ng-if="Profile.currentUser.firstName">{{Profile.currentUser.firstName}} {{Profile.currentUser.lastName}}</h2>
	<div class="text-center">
		<br/>
		<img ng-src="/uploads/players/{{Profile.currentUser.id}}/playerIcon/{{Profile.currentUser.icon}}" alt="" class="shadow" width="220px"/>
	</div>
	<h1 class="text-center" style="text-transform: initial;color: gold;text-shadow: 1px 1px 5px black;">
		<span class="glyphicon glyphicon-user" style="font-size:.7em"></span> {{Profile.currentUser.username}}
	</h1>
	<div class="text-center" ng-if="!Profile.alreadyFriends">
		<p ng-if="!Profile.isMe"><a ng-click="Profile.addFriend()"><i class="fa fa-plus"></i> Add as Friend</a></p>
	</div>
</div>
<div class="full_width">
	<h2>Friends</h2>
	<div class="friend-list">
		<img class="friend-icon" ng-src="/uploads/players/{{friend.id}}/playerIcon/thumbs/{{friend.icon}}" ui-sref="profile({'playerId': friend.id})" ng-repeat="friend in Profile.currentUser.Friends">
	</div>
	<div class="text-center" ng-if="Profile.currentUser.Friends.length <= 0">
		<h5>Search by player profile and click 'Add Friend' to send a friend request.</h5>
	</div>
</div>
<div class="full_width">
	<h2>Achievements</h2>
	<h3 class="text-center">This player has not yet been awarded any achievements.</h3>
</div>
<div class="full_width">
	<h2>Photostream</h2>
	<div class="photostream">
		<div popup ng-repeat="photo in Profile.currentUser.UserPhotos">
			<img ng-src="/uploads/players/{{Profile.currentUser.id}}/photostream/{{photo.url}}" alt=""/>
		</div>
	</div>
	<div class="text-center" ng-if="Profile.currentUser.UserPhotos.length <= 0">
		<h5>Upload photos from you dashboard to share your table-top experience with friends.</h5>
	</div>
</div>
