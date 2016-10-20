<div class="full_width ">
	<h2>Ranking: {{PlayerRanking.rankingHeader}}</h2>
</div>
<div class="full_width">
	<form name="rankingSearchForm" ng-submit="PlayerRanking.search()">
		<!-- <div class="form-group">
			<input type="text" placeholder="Enter a player's username..." ng-model="PlayerRanking.criteria.query" required/>
		</div> -->
		<div class="form-group">
			<div class="three_column_1 inline-field">
				<label for="gameSystemId" class="sublabel required"><strong>Game System</strong>:</label>
				<select ng-options="gameSystem.id as gameSystem.name for gameSystem in PlayerRanking.gameSystems track by gameSystem.id" ng-model="PlayerRanking.GameSystemId" ng-change="PlayerRanking.getFactions()" required></select>
			</div>
			<div class="three_column_1 inline-field">
				<label for="FactionId" class="sublabel required"><strong>Faction</strong>:</label>
				<select ng-options="faction.id as faction.name for faction in PlayerRanking.factions track by faction.id" ng-model="PlayerRanking.FactionId" required ng-if="PlayerRanking.factions"></select>
			</div>
			<div class="three_column_1 text-right">
				<button class="button button-primary" type="submit" ng-click="PlayerRanking.searchRankings()" ng-disabled="rankingSearchForm.$invalid"><i class="fa fa-search"></i> Search</button>
			</div>
		</div>
	</form>
	<h5 class="text-center" ng-if="PlayerRanking.results.length === 0">Select a game system and faction to search the Battle-Comm leaderboards.</h5>
	<table ng-if="PlayerRanking.results.length > 0" class="search-results">
		<tr>
	  	    <th>Username</th>
	  	    <th>Game System</th>
			<th>Faction</th>
			<th>Ranking</th>
			<th>Points Value</th>
	  	</tr>
		<tr ng-repeat="ranking in PlayerRanking.results | orderBy: ranking.pointValue" class="item" ui-sref="profile({'playerId': ranking.User.id})">
			<td><a>{{ranking.User.username}}</a></td>
			<td>{{ranking.GameSystem.name}}</td>
			<td>{{ranking.Faction.name}}</td>
			<td>{{ranking.totalWins}}/{{ranking.totalLosses}}/{{ranking.totalDraws}}</td>
			<td>{{ranking.pointValue}}</td>
		</tr>
	</table>
</div>
