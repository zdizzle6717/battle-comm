<span access-level="['systemAdmin']">
	<div admin-nav></div>
</span>
<div class="full_width">
	<h2>System Admin</h2>
</div>
<div class="four_column_3 single-product">
    <h2>Player ID: {{Player.currentPlayer.id}}</h2>
    <fieldset class="full_width" ng-disabled="Player.readOnly">
        <form style="margin:0 auto;" name="playerForm" novalidate>
            <h2 class="push-bottom">View/Edit</h2>
			<div class="form-group">
				<div class="three_column_1">
	                <label for="firstName" class="sublabel required">Firstname:</label>
	                <input id="firstName" name="firstName" ng-model="Player.currentPlayer.firstName" type="text" class="formTextfield_Large" placeholder="Player first name...">
	            </div>
	            <div class="three_column_1">
	                <label for="lastName" class="sublabel required">Lastname:</label>
	                <input id="lastName" name="lastName" ng-model="Player.currentPlayer.lastName" type="text" class="formTextfield_Large" placeholder="Player last name...">
	            </div>
	            <div class="three_column_1">
	                <label for="email" class="sublabel required">Email:</label>
	                <input id="email" name="email" ng-model="Player.currentPlayer.email" type="text" class="formTextfield_Large" placeholder="Player email..." required>
	            </div>
			</div>
			<div class="form-group">
				<div class="two_column_1">
	                <label for="username" class="sublabel required">Handle:</label>
	                <input id="username" name="username" ng-model="Player.currentPlayer.username" type="text" class="formTextfield_Large" placeholder="Player handle..." required>
	            </div>
	            <div class="two_column_1">
	                <label for="rewardPoints" class="sublabel required">RP Points:</label>
	                <input id="rewardPoints" name="rewardPoints" ng-model="Player.currentPlayer.rewardPoints" type="number" class="formTextfield_Large" required>
	            </div>
			</div>
        </form>
    </fieldset>
	<hr>
	<form name="rankingForm">
		<div class="form-group">
			<div class="four_column_1">
				<label for="gameSystem" class="sublabel required">Game System:</label>
				<input id="gameSystem" name="gameSystem" ng-model="Player.newRanking.GameSystem.searchKey" type="text" class="formTextfield_Large" placeholder="Player first name...">
			</div>
			<div class="four_column_1">
				<label for="totalWins" class="sublabel required">Total Wins:</label>
				<input id="totalWins" name="totalWins" ng-model="Player.newRanking.totalWins" type="number" class="formTextfield_Large" placeholder="Player first name...">
			</div>
			<div class="four_column_1">
				<label for="totalDraws" class="sublabel required">Total Draws:</label>
				<input id="totalDraws" name="totalDraws" ng-model="Player.newRanking.totalDraws" type="number" class="formTextfield_Large" placeholder="Player last name...">
			</div>
			<div class="four_column_1">
				<label for="totalLosses" class="sublabel required"> Total Losses:</label>
				<input id="totalLosses" name="totalLosses" ng-model="Player.newRanking.totalLosses" type="number" class="formTextfield_Large" placeholder="Player email..." required>
			</div>
		</div>
		<div class="form-group">
			<div class="full_width text-right">
				<button class="button button-primary" ng-click="Player.saveRanking()">Update Ranking</button>
			</div>
		</div>
	</form>
	<hr>
	<h2>Player Ranking</h2>
	<table>
	  <tr>
	    <th>Game System</th>
	    <th>Total Wins</th>
	    <th>Total Draws</th>
	    <th>Total Losses</th>
	  </tr>
	  <tr ng-repeat="ranking in Player.currentPlayer.UserRankings">
	    <td>{{ranking.GameSystem.name}}</td>
	    <td>{{ranking.totalWins}}</td>
	    <td>{{ranking.totalDraws}}</td>
	    <td>{ranking.totalLosses}</td>
	  </tr>
	 </table>
</div>
<div class="four_column_1 single-product">
    <div class="panel panel-default sidebar-menu" >
        <div class="panel-body" style="text-align:center;">
            <button ng-click="Player.editPlayer()" ng-if="Player.readOnly" class="btn btn-to-cart" type="button">Edit Details</button>
            <button ng-click="Player.savePlayer(Player.currentPlayer, playerForm)" ng-if="!Player.readOnly" class="btn btn-to-cart" type="button" ng-disabled="playerForm.$invalid">Save Changes</button>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Subscriber?</h3>
            <select name="subscriber" id="subscriber" ng-model="Player.currentPlayer.subscriber" ng-disabled="Player.readOnly"
              ng-options="option.value as option.name for option in [{ name: 'No', value: false }, { name: 'Yes', value: true }]">
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Tourney Admin?</h3>
            <select name="tourneyAdmin" id="tourneyAdmin" ng-model="Player.currentPlayer.tourneyAdmin" selected="Player.currentPlayer.tourneyAdmin" ng-disabled="Player.readOnly"
              ng-options="option.value as option.name for option in [{ name: 'No', value: false }, { name: 'Yes', value: true }]">
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Event Admin?</h3>
            <select name="eventAdmin" id="eventAdmin" ng-model="Player.currentPlayer.eventAdmin" selected="Player.currentPlayer.eventAdmin" ng-disabled="Player.readOnly"
              ng-options="option.value as option.name for option in [{ name: 'No', value: false }, { name: 'Yes', value: true }]">
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Venue Admin?</h3>
            <select name="venueAdmin" id="venueAdmin" ng-model="Player.currentPlayer.venueAdmin" selected="Player.currentPlayer.venueAdmin" ng-disabled="Player.readOnly"
              ng-options="option.value as option.name for option in [{ name: 'No', value: false }, { name: 'Yes', value: true }]">
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Club Admin?</h3>
            <select name="clubAdmin" id="clubAdmin" ng-model="Player.currentPlayer.clubAdmin" selected="Player.currentPlayer.clubAdmin" ng-disabled="Player.readOnly"
              ng-options="option.value as option.name for option in [{ name: 'No', value: false }, { name: 'Yes', value: true }]">
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Site Admin?</h3>
            <select name="systemAdmin" id="systemAdmin" ng-model="Player.currentPlayer.systemAdmin" selected="Player.currentPlayer.systemAdmin" ng-disabled="Player.readOnly"
              ng-options="option.value as option.name for option in [{ name: 'No', value: false }, { name: 'Yes', value: true }]">
            </select><br>
        </div>
        <div class="panel-body" ng-if="!Player.isNew">
            Updated: {{Player.currentPlayer.updatedAt | jsonDate | date: 'medium'}}
        </div>
    </div>
</div>
