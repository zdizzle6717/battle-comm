<div class="two_column_1">
  <h2 class="text-center">Player Info</h2>
		<p class="user-bio" ng-if="Profile.currentUser.user_bio">{{Profile.currentUser.user_bio}}</p>
		<p class="user-bio" ng-if="!Profile.currentUser.user_bio">This player has not yet updaed their bio.</p>

		<div class="sociallinks push-bottom" style="text-align:center;">
			<a ng-href="{{Profile.currentUser.user_facebook}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.user_facebook"><span class="fa fa-facebook" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.user_twitter}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.user_twitter"><span class="fa fa-twitter" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.user_instagram}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.user_instagram"><span class="fa fa-instagram" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.user_twitch}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.user_twitch"><span class="fa fa-twitch" style="font-size: 38px;"></span></a>
			<a ng-href="{{Profile.currentUser.user_website}}" class="push-right push-left" target="_blank" ng-if="Profile.currentUser.user_website"><span class="fa fa-globe" style="font-size: 38px;"></span></a>
		</div>
</div>
<div class="two_column_1">
	<h2 class="text-center">{{Profile.currentUser.firstName}} {{Profile.currentUser.lastName}}</h2>
	<div class="text-center"><br/><img ng-src="/uploads/players/{{Profile.currentUser.user_icon}}" alt="" class="shadow" width="220px"/></div>
	<h1 class="text-center" style="text-transform: initial;color: gold;text-shadow: 1px 1px 5px black;">
		<span class="glyphicon glyphicon-user" style="font-size:.7em"></span> {{Profile.currentUser.user_handle}}
	</h1>
	<div class="text-center">
		<ul class="inline">
			<li class="item"><a class="" ui-sref="profile" target="_self">Send a Message (pending)</a></li>
			<li><a ui-sref="profile">Create Match (pending)</a></li>
			<li><a ui-sref="profile">Add as Friend (pending)</a></li>
		</ul>
	</div>
</div>
<div class="full_width">
	<div class="two_column_1">
		   <h2 style="text-align:center;">Info (demo content)</h2>
			<ul class="list">
			  <li class="">Available to Play: <b>&nbsp;Yes</b></li>
			  <li class="">Local to you: <b>&nbsp;Yes</b> (Approx. 10 mi)</li>
			  <li class="">Local Store: <a ui-sref="profile" target="_self" class="anchor3">DryRox Games and Artisinal Cheeses</a></li>
			  <li class="">Games: &nbsp;Chess, Warhammer 40K, Magic.</li>
			</ul>
	</div>
	<div class="two_column_1">
		<div class="recent_articles">
		  <h2 style="text-align:center;">Recent Activity (demo content)</h2>
		  <ul>
			<li> <a ui-sref="profile">Played [Game] with [Username] and [Username]</a>
			  <div class="separator"></div>
			</li>
			<li> <a ui-sref="profile">Played [Game] with [Username]</a>
			  <div class="separator"></div>
			</li>
			<li> <a ui-sref="profile">Signed up for [Tournament]</a>
			  <div class="separator"></div>
			</li>
			<li> <a ui-sref="profile">Attended [Event] at [FLGS]</a>
			  <div class="separator"></div>
			</li>
		  </ul>
		</div>
	</div>
</div>
<br/>
<br/>
<div class="full_width">
	<h2>Photostream</h2>
	<div class="center thumbnail">
		<img src="../media/filler/dice.png" alt="" />
		<img src="../media/filler/game1.jpeg" alt=""/>
		<img src="../media/filler/game3.jpg" alt=""/>
		<img src="../media/filler/game2.jpg" alt=""/>
	</div>
</div>
