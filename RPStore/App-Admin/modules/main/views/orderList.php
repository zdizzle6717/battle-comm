<div class="product-col-3">
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Search</h3>
        </div>
        <div class="panel-body">
            <label>Search selected filters:</label>
            <div class="input-append span12">
                <input type="text" class="search-query mac-style" placeholder="Enter keyword..." ng-model="query">
            </div>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Sort By</h3>
        </div>
        <div class="panel-body">
            <label>Order results by:</label>
                <select name="selectedSort" id="selectedSort" ng-model="Order.selectedSort">
                    <option value="id">Order ID (ascending)</option>
                    <option value="-id">Order ID (descending)</option>
                    <option value="-created">Created (most recent)</option>
                    <option value="created">Created (ascending)</option>
                    <option value="-updated">Updated (descending)</option>
                    <option value="updated">Updated (ascending)</option>
                    <option value="orderTotal">Order Total (low to high)</option>
                    <option value="-orderTotal">Order Total (high to low)</option>
                    <option value="-status">Status</option>
                </select>
            </select>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Items Per Page</h3>
        </div>
        <div class="panel-body">
            <label>Now Showing:</label>
                <select name="pageSize" id="pageSize" ng-model="Order.pageSize">
                    <option value="5">5</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </select>
        </div>
    </div>
    <!--
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Reset Filter Selection</h3>
        </div>
        <div class="panel-body" style="text-align:center;">
            <button class="btn btn-default" style="width:100%;" ng-click="store.reset()">Reset</button>
        </div>
    </div>
    -->
</div>
<div class="product-col-9">
        <div class="mobile-table">
          <table border="1" class="mobile-table">
            <thead class="cf">
              <tr>
                <th><strong>Order ID</strong></th>
                <th><strong>Customer</strong></th>
                <th><strong>Order Details</strong></th>
                <th><strong>Order Total</strong></th>
                <th><strong>Last Updated</strong></th>
                <th><strong>Status</strong></th>
              </tr>
            </thead>
          <tbody>
            <!--START REPEAT-->
            <tr dir-paginate="order in Order.orders | filter: query | orderBy: Order.selectedSort | itemsPerPage: Order.pageSize" >
              <td data-title="Order ID"><a ui-sref="order({ id: order.id })">{{order.id}}</a></td>
              <td data-title="Customer">{{order.customerFullName}}</td>
              <td data-title="Order Details">{{order.orderDetails}}</td>
              <td data-title="Order Total">{{order.orderTotal | number}} RP</td>
              <td data-title="Last Updated">{{order.updated | jsonDate | date: 'medium'}}</td>
              <td data-title="Status" ng-class="{'green': order.status === 'processing', 'blue': order.status === 'completed' , 'red': order.status === 'canceled'}"><a ui-sref="order({ id: order.id })">{{order.status}}</a></td>
            </tr>
            <!--END REPEAT-->
          </tbody>
        </table>
       	<script>
    	/* Adds Header Labels for Mobile-Friendly */
    		(function ($) {
    		$.fn.rte = function () {
    			var that = this;
    				this.find('th').each(function (index) {
    					index++;
    					that.find('tr td:nth-child(' + index + ')').attr('data-title', that.find('th:nth-child(' + index + ')').text());
    				});
    			}
    		})(jQuery);
    				$('.mobile-table').rte();
    	</script>
    </div>
    <div class="full_width right">
        <dir-pagination-controls boundary-links="true" ></dir-pagination-controls>
    </div>
</div>
