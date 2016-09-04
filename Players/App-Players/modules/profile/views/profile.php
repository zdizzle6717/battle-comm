<div class="two_column_1">
  <h2 class="text-center">Player Bio</h2>
		<p class="user-bio" ng-if="Profile.currentUser.user_bio">{{Profile.currentUser.user_bio}}</p>
		<p class="user-bio" ng-if="!Profile.currentUser.user_bio">This player has not yet updaed their bio.</p>

		<div class="sociallinks push-bottom" style="text-align:center;">
			<a ng-href="{{Profile.currentUser.user_facebook}}" target="_blank" ><span class="symbol face" style="font-size: 38px;">&#xe427;</span></a>
			<a ng-href="{{Profile.currentUser.user_twitter}}" target="_blank" ><span class="symbol twit" style="font-size: 38px;">&#xe286;</span></a>
			<a ng-href="{{Profile.currentUser.user_instagram}}" target="_blank" ><span class="symbol insta" style="font-size: 38px;">&#xe500;</span></a>
		</div>
		<a class="fill text-center push-bottom" ng-href="{{Profile.currentUser.user_twitch}}" target="_blank">Twitch</a>
		<a class="fill text-center push-bottom" ng-href="{{Profile.currentUser.user_website}}" target="_blank">Website</a>
</div>
<div class="two_column_1">
	<h2 class="text-center">{{Profile.currentUser.firstName}} {{Profile.currentUser.lastName}}</h2>
	<h1 class="center" style="text-transform: initial;color: gold;text-shadow: 1px 1px 5px black;">
		<span class="glyphicon glyphicon-user" style="font-size:.7em"></span> {{Profile.currentUser.user_handle}}
	</h1>
	<div class="center"><br/><img ng-src="/uploads/players/{{Profile.currentUser.user_icon}}" alt="" class="shadow" width="220px"/></div>
	<div class="center">
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
