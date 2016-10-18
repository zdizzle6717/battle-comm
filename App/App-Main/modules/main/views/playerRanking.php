<div class="full_width ">
	<h2>Ranking: Overall</h2>
</div>
<div class="full_width">
	<form name="rankingSearchForm" ng-submit="PlayerRanking.search()" class="form-group">
		<input type="text" placeholder="Enter a player's username..." ng-model="PlayerRanking.criteria.query" required/>
	</form>
	<div class="form-group text-right">
		<button class="button button-primary" type="submit" ng-click="PlayerRanking.search()" ng-disabled="rankingSearchForm.$invalid"><i class="fa fa-search"></i> Search</button>
	</div>
	<h5 class="text-center" ng-if="PlayerRanking.results.length === 0">No results found. Enter a new search term.</h5>
	<table ng-if="PlayerRanking.results.length > 0" class="search-results">
		<tr>
	  	    <th>Username</th>
	  	    <th>Game System</th>
			<th>Faction</th>
			<th>Ranking</th>
	  	</tr>
		<tr ng-repeat="player in PlayerRanking.results" class="item" ui-sref="profile({'playerId': player.id})">
			<td><a>{{player.username}}</a></td>
			<td>{{player.UserRanking.GameSystem.name}}</td>
			<td>{{player.UserRanking.Faction.name}}</td>
			<td>{{player.UserRanking.totalWins}}/{{player.UserRanking.totalDraws}}/{{player.UserRanking.totalLosses}}</td>
		</tr>
	</table>
</div>
