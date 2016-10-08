<div class="full_width ">
	<h2>Search: <span ng-if="Profile.isMe">My</span><span ng-if="!Profile.isMe">{{Profile.currentUser.firstName + ' ' + Profile.currentUser.lastName}}'s</span> Allies</h2>
</div>
<div class="full_width">
	<form name="allySearchForm" class="form-group">
		<input type="text" placeholder="State typing search criteria..." ng-model="query" required/>
	</form>
	<h5 class="text-center" ng-if="Profile.currentUser.Friends.length === 0">This player has not yet added any allies. Send them an ally request to welcome them to Battle-Comm.</h5>
	<div class="friend-list" ng-if="Profile.currentUser.Friends.length > 0">
		<span class="icon-box" ng-repeat="friend in Profile.currentUser.Friends | filter:query">
			<img class="icon" ng-src="/uploads/players/{{friend.id}}/playerIcon/thumbs/{{friend.icon}}" ui-sref="profile({'playerId': friend.id})">
			<span class="name-label">{{friend.firstName + ' ' + friend.lastName}}</span>
		</span>
	</div>
</div>
