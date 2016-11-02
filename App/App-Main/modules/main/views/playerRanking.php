<div class="full_width ">
	<h2>Ranking Search: {{PlayerRanking.rankingHeader}}</h2>
</div>
<div class="full_width">
	<form name="rankingSearchForm" ng-submit="PlayerRanking.search()">
		<!-- <div class="form-group">
			<input type="text" placeholder="Enter a player's username..." ng-model="PlayerRanking.criteria.query" required/>
		</div> -->
		<div class="form-group">
			<div class="two_column_1">
				<label for="gameSystemId" class="sublabel required"><strong>Game System</strong>:</label>
				<select ng-options="gameSystem.id as gameSystem.name for gameSystem in PlayerRanking.gameSystems track by gameSystem.id" ng-model="PlayerRanking.GameSystemId" ng-change="PlayerRanking.getFactionsAndSearch()"></select>
			</div>
			<div class="two_column_1">
				<label for="FactionId" class="sublabel required"><strong>Faction</strong>:</label>
				<select ng-options="faction.id as faction.name for faction in PlayerRanking.factions track by faction.id" ng-model="PlayerRanking.FactionId" ng-if="PlayerRanking.factions" ng-change="PlayerRanking.searchByFaction()"></select>
			</div>
		</div>
	</form>
	<h5 class="text-center" ng-if="PlayerRanking.results.length === 0">Select a game system and faction to search the Battle-Comm leaderboards.</h5>
	<table ng-if="PlayerRanking.results.length > 0 && PlayerRanking.byGameSystem" class="search-results">
		<tr>
			<th>#</th>
	  	    <th>Username</th>
	  	    <th>Game System</th>
			<th>Ranking W/L/D</th>
	  	</tr>
		<tr ng-repeat="ranking in PlayerRanking.filteredResults" class="item" ui-sref="profile({'playerId': ranking.UserId})">
			<td>{{$index + 1}}</td>
			<td><a>{{ranking.User.username}}</a></td>
			<td>{{ranking.GameSystem.name}}</td>
			<td>{{ranking.totalWins}}/{{ranking.totalLosses}}/{{ranking.totalDraws}}</td>
		</tr>
	</table>
	<table ng-if="PlayerRanking.results.length > 0 && PlayerRanking.byFaction" class="search-results">
		<tr>
			<th>#</th>
	  	    <th>Username</th>
	  	    <th>Game System</th>
			<th>Faction</th>
			<th>Ranking W/L/D</th>
	  	</tr>
		<tr ng-repeat="ranking in PlayerRanking.filteredResults" class="item" ui-sref="profile({'playerId': ranking.GameSystemRanking.UserId})">
			<td>{{$index + 1}}</td>
			<td><a>{{ranking.GameSystemRanking.User.username}}</a></td>
			<td>{{ranking.GameSystemRanking.GameSystem.name}}</td>
			<td>{{ranking.Faction.name}}</td>
			<td>{{ranking.totalWins}}/{{ranking.totalLosses}}/{{ranking.totalDraws}}</td>
		</tr>
	</table>
</div>
