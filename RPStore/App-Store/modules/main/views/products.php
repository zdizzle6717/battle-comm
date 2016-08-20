<div class="product-col-3">
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">RP Value</h3>
        </div>
        <div class="panel-body">
            <div>
                <rzslider
                    rz-slider-model="Store.slider.min"
                    rz-slider-high="Store.slider.max"
                    rz-slider-options="Store.slider.options">
                </rzslider>
            </div>
            <div style="text-align:center;padding-top:10px;">All Items <strong>{{Store.slider.min | number}}</strong> RP - <strong>{{Store.slider.max | number}}</strong> RP</div>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Game Developer</h3>
        </div>
        <div class="panel-body">
            <label>Manufacturer:</label>
            <select name="manufacturerSelect" id="manufacturerSelect" ng-model="Store.selectedMNU" ng-options="manufacturer as manufacturer.name for manufacturer in Store.manufacturers" ng-change="Store.setMNU(Store.selectedMNU)"></select>
            </select>
            <!-- <div ng-hide="!Store.selectedMNU.name || Store.selectedMNU.name === 'Show All...'">
                <label>Game System:</label>
                <select name="systemSelect" id="systemSelect" ng-model="Store.selectedSystem" ng-options="system as system.name for system in Store.currentMNU.gameSystem"></select>
            </div> -->
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Sort By</h3>
        </div>
        <div class="panel-body">
            <label>Order results by:</label>
                <select name="selectedSort" id="selectedSort" ng-model="Store.selectedSort">
                    <option value="name">Name Alphabetical</option>
                    <option value="-updatedAt">Newest to Oldest</option>
                    <option value="updatedAt">Oldest to Newest</option>
                    <option value="price">Price (low to high)</option>
                    <option value="-price">Price (high to low)</option>
                    <option value="category">Category Alphabetical</option>
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
                <select name="pageSize" id="pageSize" ng-model="Store.pageSize">
                    <option value="3">3</option>
                    <option value="15">15</option>
                    <option value="30">30</option>
                    <option value="100">100</option>
                </select>
            </select>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Search</h3>
        </div>
        <div class="panel-body">
            <label>Search selected filters:</label>
            <div class="input-append span12">
                <input type="text" class="search-query mac-style" placeholder="Enter keyword..." ng-model="Store.searchQuery">
            </div>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Reset Filters</h3>
        </div>
        <div class="panel-body">
            <div class="input-append span12 center">
                <button class="btn btn-remove" type="button" ng-click="Store.reset()">Reset <i class="glyphicon glyphicon-refresh"></i></button>
            </div>
        </div>
    </div>
    <!--
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Reset Filter Selection</h3>
        </div>
        <div class="panel-body" style="text-align:center;">
            <button class="btn btn-default" style="width:100%;" ng-click="Store.reset()">Reset</button>
        </div>
    </div>
    -->
</div>
<div class="product-col-9">
    <div class="product-box" dir-paginate="product in Store.products | filter: Store.selectedMNU.searchValue | filter: Store.searchQuery | filter: Store.selectedSystem.searchValue | filter: Store.priceFilter | orderBy: Store.selectedSort | itemsPerPage: Store.pageSize">
        <div class="product">
            <div class="flip-container">
                <div class="flipper">
                    <div class="front">
                        <a ui-sref="product({ id: product.id })"><img ng-src="images/uploads/{{product.imgOneFront}}" alt="{{product.imgAlt}}" class="img-responsive"></a>
                    </div>
                    <div class="back">
                        <a ui-sref="product({ id: product.id })"><img ng-src="images/uploads/{{product.imgOneBack}}" alt="{{product.imgAlt}}" class="img-responsive"></a>
                    </div>
                </div>
            </div>
            <a ui-sref="product({ id: product.id })" class="invisible"><img ng-src="images/uploads/{{product.imgOneFront}}" alt="{{product.imgAlt}}" class="img-responsive"></a>
            <div class="text text-center">
                <h3><a ui-sref="product({ id: product.id })" >{{product.name}}</a></h3>
                <p class="price">
                    {{product.price}}</p>
                <ngcart-addtocart id="{{product.id}}" name="{{product.name}}" price="{{product.price}}" quantity="1" quantity-max="5" class="add-cart-box">Add to Cart</ngcart-addtocart>
            </div>
            <!-- /.text -->
        </div>
    </div>
    <div class="full_width right">
        <dir-pagination-controls boundary-links="true" on-page-change="Store.goTop()"></dir-pagination-controls>
    </div>
</div>
