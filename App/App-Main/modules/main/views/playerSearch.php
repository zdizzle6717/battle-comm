<div class="full_width ">
	<h2>Search: Players</h2>
</div>
<div class="full_width">
	<div class="form-group">
		<input type="text" placeholder="Enter search criteria..." ng-model="PlayerSearch.criteria.query"/>
	</div>
	<div class="form-group text-right">
		<button class="button button-primary" ng-click="PlayerSearch.search()"><i class="fa fa-search"></i> Search</button>
	</div>
	<h5 ng-if="PlayerSearch.results.length === 0">No results found.</h5>
	<table ng-if="PlayerSearch.results.length > 0" class="search-results">
		<tr>
	  	    <th>Full Name</th>
	  	    <th>Username</th>
	  	    <th>Ranking</th>
			<th>Icon</th>
	  	</tr>
		<tr ng-repeat="player in PlayerSearch.results" class="item" ui-sref="profile({'playerId': player.id})">
			<td><a>{{player.firstName}}  {{player.lastName}}</a></td>
			<td><a>{{player.username}}</a></td>
			<td></td>
			<td><img ng-src="/uploads/players/profile_image_default.png"/></td>
		</tr>
	</table>
</div>

<div class="full_width text-right">
	<a ng-click="Dashboard.logout()">Logout?</a>
</div>
