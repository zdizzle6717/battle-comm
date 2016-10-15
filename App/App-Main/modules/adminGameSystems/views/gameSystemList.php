<span access-level="['systemAdmin']">
	<div admin-nav></div>
</span>
<div class="full_width">
	<h2>System Admin</h2>
</div>
<div class="four_column_1">
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Create Game System</h3>
        </div>
        <div class="panel-body">
            <button class="btn btn-to-cart" ui-sref="gameSystem({id: undefined})"><span class="fa fa-plus"></span> Add Game System</button>
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
            <label>Game System results by:</label>
                <select name="selectedSort" id="selectedSort" ng-model="GameSystems.selectedSort">
                    <option value="id">Game System ID (ascending)</option>
                    <option value="-id">Game System ID (descending)</option>
                    <option value="Manufacturer.name">Manufacturer (ascending)</option>
                    <option value="-Manufacturer.name">Manufacturer (descending)</option>
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
                <select name="pageSize" id="pageSize" ng-model="GameSystems.pageSize">
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
                <th><strong>Game System ID</strong></th>
                <th><strong>Name</strong></th>
                <th><strong>Manufacturer</strong></th>
                <th><strong>Last Updated</strong></th>
                <th><strong>View/Edit</strong></th>
              </tr>
            </thead>
          <tbody>
            <!--START REPEAT-->
            <tr dir-paginate="gameSystem in GameSystems.allGameSystems | filter: query | orderBy: GameSystems.selectedSort | itemsPerPage: GameSystems.pageSize" >
              <td data-title="Game System ID"><a ui-sref="gameSystem({ id: gameSystem.id })">{{gameSystem.id}}</a></td>
              <td data-title="Name">{{gameSystem.name}}</td>
              <td data-title="Manufacturer">{{gameSystem.Manufacturer.name}}</td>
              <td data-title="Last Updated">{{gameSystem.updatedAt | jsonDate | date: 'medium'}}</td>
              <td data-title="View/Edit"><a ui-sref="gameSystem({ id: gameSystem.id })"><span class="fa fa-edit"></span></a></td>
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
