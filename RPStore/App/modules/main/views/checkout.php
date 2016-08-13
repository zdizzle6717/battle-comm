<h1 style="text-align:center;">Checkout</h1>
<p style="text-align:center;">
    Please enter your shipping information to complete the order.  Products usually ship within 3-7 business days.  Thanks for being part of Battle-Comm!
</p>
<div>
    <div class="shipping-info">
        <div>
            <form ng-submit="Checkout.completeOrder(Checkout.order)" class="formoid-default-skyblue side_by_side" style="margin:0 auto;" name="orderForm" novalidate>
                <h2>Shipping Info</h2>
                <div class="lineGroup three_column_1">
                    <label for="customerFullName" class="sublabel"> *Full Name:</label>
                    <input id="customerFullName" name="customerFullName" ng-model="Checkout.order.customerFullName" type="text" value="" class="formTextfield_Large" title="Please enter your full name..." maxlength="30" required>
                </div>
                <div class="lineGroup three_column_1">
                    <label for="customerEmail" class="sublabel"> *Email:</label>
                    <input id="customerEmail" name="customerEmail" ng-model="Checkout.order.customerEmail" type="email" value="" class="formTextfield_Large" title="Please enter your email..." required>
                </div>
                <div class="lineGroup three_column_1">
                    <label for="phone" class="sublabel"> Phone (optional):</label>
                    <input id="phone" name="phone" ng-model="Checkout.order.phone" type="text" value="" class="formTextfield_Large" title="Please enter a phone number..." ui-mask="(999) 999-9999" >
                </div>
                <div class="lineGroup full_width">
                    <label for="shippingStreet" class="sublabel"> *Street Address:</label>
                    <input id="shippingStreet" name="shippingStreet" ng-model="Checkout.order.shippingStreet" type="text" value="" class="formTextfield_Large" title="Please enter your address..." maxlength="50" required>
                </div>
                <div class="lineGroup three_column_1">
                    <label for="shippingApartment" class="sublabel"> Apt/Suite #:</label>
                    <input id="shippingApartment" name="shippingApartment" ng-model="Checkout.order.shippingApartment" type="text" value="" class="formTextfield_Large" title="Apartment #..." maxlength="10">
                </div>
                <div class="lineGroup three_column_1">
                    <label for="shippingCity" class="sublabel"> *City/Town:</label>
                    <input id="shippingCity" name="shippingCity" ng-model="Checkout.order.shippingCity" type="text" value="" class="formTextfield_Large" title="City..." maxlength="30" required>
                </div>
                <div class="lineGroup three_column_1">
                    <label for="shippingState" class="sublabel"> *State/Province:</label>
                    <input id="shippingState" name="shippingState" ng-model="Checkout.order.shippingState" type="text" value="" class="formTextfield_Large" title="State..." maxlength="30" required>
                </div>
                <div class="lineGroup two_column_1">
                    <label for="shippingZip" class="sublabel"> *Zip Code:</label>
                    <input id="shippingZip" name="shippingZip" ng-model="Checkout.order.shippingZip" type="text" value="" class="formTextfield_Large" title="Zip code..." maxlength="15" required>
                </div>
                <div class="lineGroup two_column_1">
                    <label for="shippingCountry" class="sublabel"> *Country:</label>
                    <input id="shippingCountry" name="shippingCountry" ng-model="Checkout.order.shippingCountry" type="text" value="" class="formTextfield_Large" title="Country..." maxlength="50" required>
                </div>
                <div class="lineGroup full_width right">
                    <h4>Your Current Reward Point Total: {{Checkout.player.user_points | number}} RP</h4>
                    <h4>Total Price: {{Checkout.total | number}} RP</h4>
                    <h4>Remaining Balance: {{Checkout.player.user_points - Checkout.total | number}} RP</h4>
                </div>

                <div class="two_column_1">
                </div>
                <div class="two_column_1 right">
                    <span class="buttonFieldGroup">
                      <button class="btn btn-addtocart" name="" type="submit" ng-disabled="orderForm.$invalid">Finalize Your Order</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</div>
