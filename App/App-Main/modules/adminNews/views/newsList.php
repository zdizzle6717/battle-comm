<div class="four_column_1">
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Create News</h3>
        </div>
        <div class="panel-body">
            <button class="btn btn-to-cart" ui-sref="post({id: undefined})"><span class="fa fa-plus"></span> Add New Post</button>
        </div>
    </div>
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
            <label>News results by:</label>
                <select name="selectedSort" id="selectedSort" ng-model="News.selectedSort">
                    <option value="id">News ID (ascending)</option>
                    <option value="-id">News ID (descending)</option>
                    <option value="-createdAt">Created (most recent)</option>
                    <option value="createdAt">Created (ascending)</option>
                    <option value="-updatedAt">Updated (descending)</option>
                    <option value="updatedAt">Updated (ascending)</option>
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
                <select name="pageSize" id="pageSize" ng-model="News.pageSize">
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
<div class="four_column_3">
        <div class="mobile-table">
          <table border="1" class="mobile-table">
            <thead class="cf">
              <tr>
                <th><strong>News ID</strong></th>
                <th><strong>Title</strong></th>
                <th><strong>Author</strong></th>
                <th><strong>Tags</strong></th>
                <th><strong>Featured?</strong></th>
                <th><strong>Last Updated</strong></th>
                <th><strong>View/Edit</strong></th>
              </tr>
            </thead>
          <tbody>
            <!--START REPEAT-->
            <tr dir-paginate="news in News.allPosts | filter: query | orderBy: News.selectedSort | itemsPerPage: News.pageSize" >
              <td data-title="News ID"><a ui-sref="post({ id: news.id })">{{news.id}}</a></td>
              <td data-title="Name">{{news.title}}</td>
              <td data-title="Price">{{news.userLoginId}}</td>
              <td data-title="Quantity">{{news.tags}}</td>
              <td data-title="Featured?">{{news.featured}}</td>
              <td data-title="Last Updated">{{news.updatedAt | jsonDate | date: 'medium'}}</td>
              <td data-title="View/Edit"><a ui-sref="post({ id: news.id })"><span class="fa fa-edit"></span></a></td>
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
