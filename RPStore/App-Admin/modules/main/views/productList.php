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
            <label>Product results by:</label>
                <select name="selectedSort" id="selectedSort" ng-model="Product.selectedSort">
                    <option value="id">Product ID (ascending)</option>
                    <option value="-id">Product ID (descending)</option>
                    <option value="-created">Created (most recent)</option>
                    <option value="created">Created (ascending)</option>
                    <option value="-updated">Updated (descending)</option>
                    <option value="updated">Updated (ascending)</option>
                    <option value="productTotal">Product Total (low to high)</option>
                    <option value="-productTotal">Product Total (high to low)</option>
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
                <select name="pageSize" id="pageSize" ng-model="Product.pageSize">
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
                <th><strong>Product ID</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Price</strong></th>
                <th><strong>Stock Qty</strong></th>
                <th><strong>Featured?</strong></th>
                <th><strong>Last Updated</strong></th>
                <th><strong>View/Edit</strong></th>
              </tr>
            </thead>
          <tbody>
            <!--START REPEAT-->
            <tr dir-paginate="product in Product.products | filter: query | orderBy: Product.selectedSort | itemsPerPage: Product.pageSize" >
              <td data-title="Product ID"><a ui-sref="product({ id: product.id })">{{product.id}}</a></td>
              <td data-title="Name">{{product.name}}</td>
              <td data-title="Price">{{product.price}}</td>
              <td data-title="Quantity">{{product.stockQty}}</td>
              <td data-title="Featured?">{{product.featured}}</td>
              <td data-title="Last Updated">{{product.updatedAt | jsonDate | date: 'medium'}}</td>
              <td data-title="View/Edit"><a ui-sref="product({ id: product.id })"><span class="glyphicon glyphicon-edit"></span></a></td>
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
