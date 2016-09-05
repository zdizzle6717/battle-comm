<div class="four_column_3 single-product">
	<div class="full_width">
	    <h2>Order ID: {{Order.currentOrder.id}}</h2>
	    <div class="two_column_1">
	        <h3>Customer: {{Order.currentOrder.customerFullName}}</h3>
	        <h3>Customer ID: {{Order.currentOrder.userLoginId}}</h3>
	        <h3>Order Total: {{Order.currentOrder.orderTotal}} RP</h3>
	    </div>
	    <div class="two_column_1">
	        <div class="product-description-header">Order Details: </div>
	        <div><p>{{Order.currentOrder.orderDetails}}</p></div>
	    </div>
	</div>
    <div class="full_width push-top">
        <form class="formoid-default-skyblue side_by_side" name="orderForm" novalidate>
            <h2>View/Edit</h2>
			<div class="form-group">
				<div class="three_column_1">
	                <label for="customerFullName" class="sublabel"> *Full Name:</label>
	                <input id="customerFullName" name="customerFullName" ng-model="Order.currentOrder.customerFullName" type="text" value="" class="formTextfield_Large" title="Please enter your full name..." ng-disabled="Order.readOnly" required>
	            </div>
	            <div class="three_column_1">
	                <label for="customerEmail" class="sublabel"> *Email:</label>
	                <input id="customerEmail" name="customerEmail" ng-model="Order.currentOrder.customerEmail" type="email" value="" class="formTextfield_Large" title="Please enter your email..." ng-disabled="Order.readOnly" required>
	            </div>
	            <div class="three_column_1">
	                <label for="phone" class="sublabel"> Phone (optional):</label>
	                <input id="phone" name="phone" ng-model="Order.currentOrder.phone" type="text" value="" class="formTextfield_Large" title="Please enter a phone number..." ui-mask="(999) 999-9999" ng-disabled="Order.readOnly">
	            </div>
			</div>
			<div class="form-group">
				<div class="four_column_3">
	                <label for="shippingStreet" class="sublabel"> *Street Address:</label>
	                <input id="shippingStreet" name="shippingStreet" ng-model="Order.currentOrder.shippingStreet" type="text" value="" class="formTextfield_Large" title="Please enter your address..." ng-disabled="Order.readOnly" required>
	            </div>
	            <div class="four_column_1">
	                <label for="shippingAppartment" class="sublabel"> Apt/Suite #:</label>
	                <input id="shippingAppartment" name="shippingAppartment" ng-model="Order.currentOrder.shippingAppartment" type="text" value="" class="formTextfield_Large" title="Apartment #..." ng-disabled="Order.readOnly">
	            </div>
			</div>
            <div class="form-group">
				<div class="two_column_1">
	                <label for="shippingCity" class="sublabel"> *City:</label>
	                <input id="shippingCity" name="shippingCity" ng-model="Order.currentOrder.shippingCity" type="text" value="" class="formTextfield_Large" title="City..." ng-disabled="Order.readOnly" required>
	            </div>
	            <div class="two_column_1">
	                <label for="shippingState" class="sublabel"> *State:</label>
	                <input id="shippingState" name="shippingState" ng-model="Order.currentOrder.shippingState" type="text" value="" class="formTextfield_Large" title="State..." ng-disabled="Order.readOnly" required>
	            </div>
			</div>
            <div class="form-group">
				<div class="two_column_1">
	                <label for="shippingZip" class="sublabel"> *Zip Code:</label>
	                <input id="shippingZip" name="shippingZip" ng-model="Order.currentOrder.shippingZip" type="text" value="" class="formTextfield_Large" title="Zip code..." ng-disabled="Order.readOnly" required>
	            </div>
	            <div class="two_column_1">
	                <label for="shippingCountry" class="sublabel"> *Country:</label>
	                <input id="shippingCountry" name="shippingCountry" ng-model="Order.currentOrder.shippingCountry" type="text" value="" class="formTextfield_Large" title="Country..." ng-disabled="Order.readOnly" required>
	            </div>
			</div>
        </form>
    </div>
    <div class="full_width">
		<h2>Products</h2>
        <div class="product-description-header">Order Details: </div>
        <div><p>{{Order.currentOrder.orderDetails}}</p></div>
    </div>
</div>
<div class="four_column_1 single-product">
    <div class="panel panel-default sidebar-menu" >
        <div class="panel-body" style="text-align:center;">
            <button ng-click="Order.edit()" ng-if="Order.readOnly" class="btn btn-to-cart" type="button">Edit Details</button>
            <button ng-click="Order.save(Order.currentOrder, orderForm)" ng-if="!Order.readOnly" class="btn btn-to-cart" type="submit">Save Changes</button>
            <button ng-click="Order.complete(Order.currentOrder)" ng-if="Order.readOnly" class="btn btn-to-cart" type="button">Ship & Complete</button>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Current Statues</h3>
            <select name="statusSelect" id="statusSelect" ng-model="Order.currentOrder.status" ng-disabled="Order.readOnly">
              <option value="">---Please select---</option>
              <option value="processing">Processing</option>
              <option value="canceled">Cancel</option>
              <option value="completed">Complete</option>
            </select><br>
        </div>
        <div class="panel-body">
            Updated: {{Order.currentOrder.updatedAt | jsonDate | date: 'medium'}}
        </div>
    </div>
</div>
