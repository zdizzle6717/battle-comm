<div class="full_width ">
	<h2>Search: Players</h2>
</div>
<div class="full_width">
	<form name="playerSearchForm" ng-submit="PlayerSearch.search()" class="form-group">
		<input type="text" placeholder="Enter search criteria..." ng-model="PlayerSearch.criteria.query" required/>
	</form>
	<div class="form-group text-right">
		<button class="button button-primary" type="submit" ng-click="PlayerSearch.search()" ng-disabled="playerSearchForm.$invalid"><i class="fa fa-search"></i> Search</button>
	</div>
	<h5 class="text-center" ng-if="PlayerSearch.results.length === 0">No results found. Enter a new search term.</h5>
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
			<td><img ng-src="/uploads/players/{{player.id}}/playerIcon/thumbs/{{player.icon}}"></td>
		</tr>
	</table>
</div>

<div class="full_width text-right">
	<a ng-click="Dashboard.logout()">Logout?</a>
</div>
