<div class="alert alert-warning" role="alert" ng-show="ngCart.getTotalItems() === 0">
    Your cart is empty
</div>


<div class="mobile-table table-responsive col-lg-12" ng-show="ngCart.getTotalItems() > 0">
    <table border="1" class="mobile-table table table-striped ngCart cart">
        <thead class="cf">
            <tr>
                <th></th>
                <th><strong>Product Name</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>Amount</strong></th>
                <th><strong>Total</strong></th>
            </tr>
        </thead>
        <tbody>
            <!--START REPEAT-->
            <tr ng-repeat="item in ngCart.getCart().items track by $index">
                <td data-title=""><span ng-click="ngCart.removeItemById(item.getId())" class="fa fa-remove"></span></td>
                <td data-title="Product Name">{{ item.getName() }}</td>
                <td data-title="Quantity"><span class="fa fa-minus" ng-class="{'disabled':item.getQuantity()==1}" ng-click="item.setQuantity(-1, true)"></span> &nbsp;&nbsp; {{ item.getQuantity() | number }}&nbsp;&nbsp;
                    <span class="fa fa-plus" ng-click="item.setQuantity(1, true)"></span></td>
                <td data-title="Amount">{{ item.getPrice() | currency : 'RP ' }}</td>
                <td data-title="Total">{{ item.getTotal() | currency : 'RP ' }}</td>
            </tr>
            <!--END REPEAT-->
        </tbody>
    </table>
    <script>
        /* Adds Header Labels for Mobile-Friendly */
        (function($) {
            $.fn.rte = function() {
                var that = this;
                this.find('th').each(function(index) {
                    index++;
                    that.find('tr td:nth-child(' + index + ')').attr('data-title', that.find('th:nth-child(' + index + ')').text());
                });
            }
        })(jQuery);
        $('.mobile-table').rte();
    </script>
    <h3 style="text-align:right;"><strong>Total:</strong>{{ ngCart.totalCost() | currency : 'RP ' }}</h3>
</div>
<div class="two_column_1" style="height:10px">

</div>
<div class="two_column_1 right">
    <button ui-sref="store" class="btn btn-addtocart">Continue Shopping</button>
    <button ng-show="ngCart.getTotalItems() !== 0" ng-click="goToCheckout(ngCart.getCart().items)" class="btn btn-addtocart">Go to Checkout</button>
</div>

<style>
    .ngCart.cart span[ng-click] {
        cursor: pointer;
    }

    .ngCart.cart .fa.disabled {
        color: #aaa;
    }
</style>
