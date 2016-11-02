<span access-level="['systemAdmin']">
	<div admin-nav></div>
</span>
<div class="full_width">
	<h2>System Admin</h2>
</div>
<div class="four_column_3 single-product">
    <h2>Game System ID: {{GameSystem.currentGameSystem.id}}</h2>
    <fieldset class="full_width" ng-disabled="GameSystem.readOnly">
        <form style="margin:0 auto;" name="postForm" novalidate>
            <h2 class="push-bottom">View/Edit</h2>
			<div class="form-group">
				<div class="three_column_1">
	                <label for="name" class="sublabel required">Name:</label>
	                <input id="name" name="name" ng-model="GameSystem.currentGameSystem.name" type="text" class="formTextfield_Large" placeholder="Game System name..." required>
	            </div>
				<div class="three_column_1">
	                <label for="url" class="sublabel">Url link (http...):</label>
	                <input id="url" name="url" ng-model="GameSystem.currentGameSystem.url" type="url" class="formTextfield_Large" placeholder="Link to game system page">
	            </div>
				<div class="three_column_1">
	                <label for="searchKey" class="sublabel required">Search Key (ask Zack):</label>
	                <input id="searchKey" name="searchKey" ng-model="GameSystem.currentGameSystem.searchKey" type="text" class="formTextfield_Large" placeholder="Key for organizing search" required>
	            </div>
			</div>
			<div class="form-group">
				<div class="two_column_1">
	                <label for="name" class="sublabel required">Manufacturer:</label>
					<select ng-options="manufacturer as manufacturer.name for manufacturer in GameSystem.manufacturers track by manufacturer.id" ng-model="GameSystem.manufacturer" required></select>
	            </div>
			</div>
			<div class="form-group">
				<div class="full_width">
	                <label for="description" class="sublabel">Description:</label>
	                <textarea id="description" name="description" ng-model="GameSystem.currentGameSystem.description" type="text" class="formTextfield_Large" placeholder="Add a description for this game system..." maxlength="750"></textarea>
	            </div>
			</div>

            <fieldset>
                <div class="full_width">
                    <div class="three_column_1">
                        <label for="image" class="sublabel">Game System Logo or Image (optional):</label>
                        <img ng-src="/uploads/gameSystems/{{GameSystem.currentGameSystem.photo}}" ng-if="GameSystem.currentGameSystem.photo"/>
                    </div>
                    <div class="three_column_1">
                        <label>Image Path:</label>
                        <input id="imgAlt" name="imgAlt" ng-model="GameSystem.currentGameSystem.photo" type="text" class="formTextfield_Large" disabled>
                    </div>
                    <div class="three_column_1">
                        <div file-upload model="GameSystem.currentGameSystem.image" params="['gameSystems']"></div>
                    </div>
                </div>
            </fieldset>
        </form>
    </fieldset>
	<hr ng-if="!GameSystem.isNew">
	<div class="full_width" ng-if="!GameSystem.isNew">
		<h2 class="push-bottom">Factions for This Game System</h2>
		<div class="two_column_1">
			<ul>
				<li ng-repeat="faction in GameSystem.currentGameSystem.Factions"><h3>{{faction.name}} <span class="fa fa-edit" ng-click="GameSystem.changeFaction(faction)"></span></h3></li>
			</ul>
		</div>
		<div class="two_column_1">
			<form style="margin:0 auto;" name="factionUpdateForm" novalidate ng-if="GameSystem.editingFaction === true">
				<div class="form-group">
					<label for="name" class="sublabel required">Faction Name:</label>
					<input id="name" name="name" ng-model="GameSystem.factionUpdate.name" type="text" class="formTextfield_Large" placeholder="Game System name..." required>
				</div>
				<div class="form-group">
					<button class="button button-primary" ng-click="GameSystem.updateFaction()" ng-disabled="factionUpdateForm.$invalid"><span class="fa fa-plus"></span> Update Faction</button>
					<button class="button button-danger" ng-click="GameSystem.cancelFactionUpdate()"><span class="fa fa-minus"></span> Cancel</button>
				</div>
			</form>
		</div>

		<h3 ng-if="GameSystem.currentGameSystem.Factions.length < 1">There are currently no factions associated with this game system.</h3>
		<hr>
		<form style="margin:0 auto;" name="factionForm" novalidate>
			<h2 class="push-bottom">Add Faction to {{GameSystem.currentGameSystem.name}}</h2>
			<div class="form-group">
				<div class="three_column_1">
					<label for="name" class="sublabel required">Faction Name:</label>
					<input id="name" name="name" ng-model="GameSystem.faction.name" type="text" class="formTextfield_Large" placeholder="Game System name..." required>
				</div>
			</div>
			<div class="form-group">
				<div class="full_width">
					<button class="button button-primary" ng-click="GameSystem.addFaction()" ng-disabled="factionForm.$invalid"><span class="fa fa-plus"></span> Add Faction</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="four_column_1 single-product">
    <div class="panel panel-default sidebar-menu" >
        <div class="panel-body" style="text-align:center;">
            <button ng-click="GameSystem.editGameSystem()" ng-if="GameSystem.readOnly" class="btn btn-to-cart" type="button">Edit Details</button>
            <button ng-click="GameSystem.saveGameSystem(GameSystem.currentGameSystem, postForm)" ng-if="!GameSystem.readOnly" class="btn btn-to-cart" type="button" ng-disabled="postForm.$invalid">Save Changes</button>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu" ng-if="GameSystem.readOnly">
        <div class="panel-body" style="text-align:center;">
            <button ng-click="GameSystem.showDeleteModal(GameSystem.currentGameSystem.id)" class="btn btn-to-cart" type="button">Remove Game System</button>
            <div delete-record-modal delete="GameSystem.removeGameSystem(GameSystem.currentGameSystem.id)">
                <div class="small-12 text-right">
                    <i class="fa fa-times" ng-click="GameSystem.hideDeleteModal()"></i>
                </div>
                <h4>Delete this game system record?</h4>
            </div>
        </div>
    </div>
</div>
