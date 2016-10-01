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
	<div class="text-center"><br/><img ng-src="/uploads/players/{{Profile.currentUser.icon}}" alt="" class="shadow" width="220px"/></div>
	<h1 class="text-center" style="text-transform: initial;color: gold;text-shadow: 1px 1px 5px black;">
		<span class="glyphicon glyphicon-user" style="font-size:.7em"></span> {{Profile.currentUser.username}}
	</h1>
	<div class="text-center">
			<p><a class="" ui-sref="profile" target="_self">Send a Message (pending)</a></p>
			<p><a ui-sref="profile">Create Match (pending)</a></p>
			<p><a ui-sref="profile">Add as Friend (pending)</a></p>
	</div>
</div>
<div class="full_width">
	<h2>Achievements</h2>
	<h3 class="text-center">This player has not yet been awarded any achievements.</h3>
</div>
<div class="full_width">
	<h2>Photostream</h2>
	<div class="center thumbnail">
		<img src="../media/filler/dice.png" alt="" />
		<img src="../media/filler/game1.jpeg" alt=""/>
		<img src="../media/filler/game3.jpg" alt=""/>
		<img src="../media/filler/game2.jpg" alt=""/>
	</div>
</div>
