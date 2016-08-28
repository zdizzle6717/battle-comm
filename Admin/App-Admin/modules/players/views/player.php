<div class="four_column_3 single-product">
    <h2>Player ID: {{Player.currentPlayer.id}}</h2>
    <fieldset class="full_width" ng-disabled="Player.readOnly">
        <form class="formoid-default-skyblue side_by_side" style="margin:0 auto;" name="playerForm" novalidate>
            <h2>View/Edit</h2>
            <div class="lineGroup three_column_1">
                <label for="firstName" class="sublabel required">Firstname:</label>
                <input id="firstName" name="firstName" ng-model="Player.currentPlayer.firstName" type="text" class="formTextfield_Large" placeholder="Player first name...">
            </div>
            <div class="lineGroup three_column_1">
                <label for="lastName" class="sublabel required">Lastname:</label>
                <input id="lastName" name="lastName" ng-model="Player.currentPlayer.lastName" type="text" class="formTextfield_Large" placeholder="Player last name...">
            </div>
            <div class="lineGroup three_column_1">
                <label for="email" class="sublabel required">Email:</label>
                <input id="email" name="email" ng-model="Player.currentPlayer.email" type="text" class="formTextfield_Large" placeholder="Player email...">
            </div>
            <div class="lineGroup two_column_1">
                <label for="user_handle" class="sublabel required">Handle:</label>
                <input id="user_handle" name="user_handle" ng-model="Player.currentPlayer.user_handle" type="text" class="formTextfield_Large" placeholder="Player handle...">
            </div>
            <div class="lineGroup two_column_1">
                <label for="user_points" class="sublabel required">RP Points:</label>
                <input id="user_points" name="user_points" ng-model="Player.currentPlayer.user_points" type="number" class="formTextfield_Large">
            </div>
        </form>
    </fieldset>
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
            <h3 class="panel-title">Tourney Admin?</h3>
            <select name="tourneyAdmin" id="tourneyAdmin" ng-model="Player.currentPlayer.tourneyAdmin" selected="Player.currentPlayer.tourneyAdmin" ng-disabled="Player.readOnly">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Event Admin?</h3>
            <select name="EventAdmin" id="EventAdmin" ng-model="Player.currentPlayer.EventAdmin" selected="Player.currentPlayer.EventAdmin" ng-disabled="Player.readOnly">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Venue Admin?</h3>
            <select name="venueAdmin" id="venueAdmin" ng-model="Player.currentPlayer.venueAdmin" selected="Player.currentPlayer.venueAdmin" ng-disabled="Player.readOnly">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Club Admin?</h3>
            <select name="clubAdmin" id="clubAdmin" ng-model="Player.currentPlayer.clubAdmin" selected="Player.currentPlayer.clubAdmin" ng-disabled="Player.readOnly">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Site Admin?</h3>
            <select name="siteAdmin" id="siteAdmin" ng-model="Player.currentPlayer.siteAdmin" selected="Player.currentPlayer.siteAdmin" ng-disabled="Player.readOnly">
              <option value="yes">Yes</option>
              <option value="no">No</option>
            </select><br>
        </div>
        <div class="panel-body" ng-if="!Player.isNew">
            Updated: {{Player.currentPlayer.updatedAt | jsonDate | date: 'medium'}}
        </div>
    </div>
</div>
