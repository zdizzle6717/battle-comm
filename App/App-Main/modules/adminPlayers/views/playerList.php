<span access-level="['systemAdmin']">
	<div admin-nav></div>
</span>
<div class="full_width">
	<h2 class="push-top-2x">System Admin</h2>
</div>
<div class="four_column_1">
    <!-- <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Create Player</h3>
        </div>
        <div class="panel-body">
            <button class="btn btn-to-cart" ui-sref="player"><span class="fa fa-plus"></span> Add New Player</button>
        </div>
    </div> -->
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
            <label>Player results by:</label>
                <select name="selectedSort" id="selectedSort" ng-model="Player.selectedSort">
                    <option value="id">ID (ascending)</option>
                    <option value="-id">ID (descending)</option>
                    <option value="username">Username (ascending)</option>
                    <option value="-username">Username (descending)</option>
                    <option value="email">Email (ascending)</option>
                    <option value="-email">Email (descending)</option>
                    <option value="lastName">Last Name (ascending)</option>
                    <option value="-lastName">Last Name (descending)</option>
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
                <select name="pageSize" id="pageSize" ng-model="Player.pageSize">
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
                <th><strong>Player ID</strong></th>
                <th><strong>Username</strong></th>
                <th><strong>Email</strong></th>
                <th><strong>Last Name</strong></th>
                <th><strong>Created</strong></th>
                <th><strong>View/Edit</strong></th>
              </tr>
            </thead>
          <tbody>
            <!--START REPEAT-->
            <tr dir-paginate="player in Player.allPlayers | filter: query | orderBy: Player.selectedSort | itemsPerPage: Player.pageSize" >
              <td data-title="Player ID"><a ui-sref="player({ userId: player.id })">{{player.id}}</a></td>
              <td data-title="Username">{{player.username}}</td>
              <td data-title="Email">{{player.email}}</td>
              <td data-title="Last Name">{{player.lastName}}</td>
              <td data-title="Created">{{player.createdAt | jsonDate | date: 'medium'}}</td>
              <td data-title="View/Edit"><a ui-sref="player({ userId: player.id })"><span class="fa fa-edit"></span></a></td>
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
