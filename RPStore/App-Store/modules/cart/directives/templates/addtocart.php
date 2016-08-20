<div ng-hide="attrs.id">
    <a class="btn btn-lg btn-primary" ng-disabled="true" ng-transclude></a>

</div>
<div ng-show="attrs.id">
    <div>
        <span ng-show="quantityMax">
            <select name="quantity" id="quantity" ng-model="q"
                    ng-options=" v for v in qtyOpt"></select>
        </span>
        <button ng-show="!inCart()" class="btn btn-addtocart" ng-click="ngCart.addItem(id, name, price, q, data)" >Add to Cart</button>
        <button ng-show="inCart()" ng-click="ngCart.removeItemById(id)" class="btn btn-remove">Remove</button>
        <button ng-show="!inCart()" ui-sref="product({ id: id })" class="btn btn-details">View details</button>
        <button ng-show="inCart()" ui-sref="cart" class="btn btn-addtocart">Go to Cart</button>
    </div>
    <mark ng-show="inCart()" class="cart-mark">
        <hr />
        <!-- <button ng-click="ngCart.removeItemById(id)" class="btn btn-remove" style="cursor: pointer;">Remove</button> -->
    </mark>
</div>
