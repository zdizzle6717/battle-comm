<span access-level="['systemAdmin']">
	<div admin-nav></div>
</span>
<div class="full_width">
	<h2>System Admin</h2>
</div>
<div class="four_column_3 single-product">
    <h2>Manufacturer ID: {{Manufacturer.currentManufacturer.id}}</h2>
    <fieldset class="full_width" ng-disabled="Manufacturer.readOnly">
        <form class="formoid-default-skyblue side_by_side" style="margin:0 auto;" name="postForm" novalidate>
            <h2 class="push-bottom">View/Edit</h2>
			<div class="form-group">
				<div class="three_column_1">
	                <label for="name" class="sublabel required">Name:</label>
	                <input id="name" name="name" ng-model="Manufacturer.currentManufacturer.name" type="text" class="formTextfield_Large" placeholder="Manufacturer name..." required>
	            </div>
				<div class="three_column_1">
	                <label for="url" class="sublabel">Url link (http...):</label>
	                <input id="url" name="url" ng-model="Manufacturer.currentManufacturer.url" type="url" class="formTextfield_Large" placeholder="Link to manufacturer page">
	            </div>
				<div class="three_column_1">
	                <label for="searchKey" class="sublabel required">Search Key (ask Zack):</label>
	                <input id="searchKey" name="searchKey" ng-model="Manufacturer.currentManufacturer.searchKey" type="text" class="formTextfield_Large" placeholder="Key for organizing search" required>
	            </div>
			</div>
			<div class="form-group">
				<div class="full_width">
	                <label for="description" class="sublabel">Description:</label>
	                <textarea id="description" name="description" ng-model="Manufacturer.currentManufacturer.description" type="text" class="formTextfield_Large" placeholder="Add a description for this manufacturer..." maxlength="750"></textarea>
	            </div>
			</div>

            <fieldset>
                <div class="full_width">
                    <div class="three_column_1">
                        <label for="image" class="sublabel">Manufactuer Logo or Image (optional):</label>
                        <img ng-src="/uploads/manufacturers/{{Manufacturer.currentManufacturer.photo}}" ng-if="Manufacturer.currentManufacturer.photo"/>
                    </div>
                    <div class="three_column_1">
                        <label>Image Path:</label>
                        <input id="imgAlt" name="imgAlt" ng-model="Manufacturer.currentManufacturer.photo" type="text" class="formTextfield_Large" disabled>
                    </div>
                    <div class="three_column_1">
                        <div file-upload model="Manufacturer.currentManufacturer.image" params="['manufacturers']"></div>
                    </div>
                </div>
            </fieldset>
        </form>
    </fieldset>
</div>
<div class="four_column_1 single-product">
    <div class="panel panel-default sidebar-menu" >
        <div class="panel-body" style="text-align:center;">
            <button ng-click="Manufacturer.editManufacturer()" ng-if="Manufacturer.readOnly" class="btn btn-to-cart" type="button">Edit Details</button>
            <button ng-click="Manufacturer.saveManufacturer(Manufacturer.currentManufacturer, postForm)" ng-if="!Manufacturer.readOnly" class="btn btn-to-cart" type="button" ng-disabled="postForm.$invalid">Save Changes</button>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu" ng-if="Manufacturer.readOnly">
        <div class="panel-body" style="text-align:center;">
            <button ng-click="Manufacturer.showDeleteModal(Manufacturer.currentManufacturer.id)" class="btn btn-to-cart" type="button">Remove Manufacturer</button>
            <div delete-record-modal delete="Manufacturer.removeManufacturer(Manufacturer.currentManufacturer.id)">
                <div class="small-12 text-right">
                    <i class="fa fa-times" ng-click="Manufacturer.hideDeleteModal()"></i>
                </div>
                <h4>Delete this manufacturer record?</h4>
            </div>
        </div>
    </div>
</div>
