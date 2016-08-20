<div class="product-col-9 single-product">
    <h2>Product ID: {{Product.currentProduct.id}}</h2>
    <fieldset class="product-col-12" ng-disabled="Product.readOnly">
        <form class="formoid-default-skyblue side_by_side" style="margin:0 auto;" name="productForm" novalidate>
            <h2>View/Edit</h2>
            <div class="lineGroup three_column_1">
                <label for="name" class="sublabel"> *Name:</label>
                <input id="name" name="name" ng-model="Product.currentProduct.name" type="text" class="formTextfield_Large" placeholder="Product name..." required>
            </div>
            <div class="lineGroup three_column_1">
                <label for="price" class="sublabel"> *Price:</label>
                <input id="price" name="customerEmail" ng-model="Product.currentProduct.price" type="number" class="formTextfield_Large" placeholder="Numbers only..." required>
            </div>
            <div class="lineGroup three_column_1">
                <label for="SKU" class="sublabel"> *SKU:</label>
                <input id="SKU" name="SKU" ng-model="Product.currentProduct.SKU" type="text" class="formTextfield_Large" placeholder="Please enter an ID...">
            </div>
            <div class="lineGroup three_column_1" ng-if="Product.isNew">
                <label for="manufacturerId" class="sublabel"> *Manufacturer ID:</label>
                <select name="manufacturerId" id="manufacturerId" ng-model="Product.currentProduct.manufacturer" ng-options="manufacturer as manufacturer.name for manufacturer in Product.manufacturers" ng-change="Product.setMNU(Product.currentProduct.manufacturer)" required></select>
            </div>
            <div class="lineGroup three_column_1" ng-if="!Product.isNew">
                <label for="manufacturerId" class="sublabel"> *Manufacturer ID:</label>
                <input name="manufacturerId" id="manufacturerId" ng-model="Product.currentProduct.manufacturerId" type="text" class="formTextfield_Large" disabled>
            </div>
            <div class="lineGroup three_column_1" ng-if="Product.isNew">
                <label for="gameSystem" class="sublabel"> *Game System ID:</label>
                <select name="gameSystem" id="gameSystem" ng-model="Product.currentProduct.gameSystem" ng-options="system.searchValue as system.name for system in Product.currentMNU.gameSystem" ng-disabled="!Product.currentProduct.manufacturer || Product.selectedMNU.name === 'Show All...'" required></select>
            </div>
            <div class="lineGroup three_column_1" ng-if="!Product.isNew">
                <label for="gameSystem" class="sublabel"> *Game System ID:</label>
                <input name="gameSystem" id="gameSystem" ng-model="Product.currentProduct.gameSystem" type="text" class="formTextfield_Large" disabled></select>
            </div>
            <div class="lineGroup three_column_1">
                <label for="stockQty" class="sublabel"> *Stock:</label>
                <input id="stockQty" name="stockQty" ng-model="Product.currentProduct.stockQty" type="number" class="formTextfield_Large" placeholder="Current stock quantity..." required>
            </div>
            <div class="lineGroup two_column_1">
                <label for="color" class="sublabel"> Color:</label>
                <input id="color" name="color" ng-model="Product.currentProduct.color" type="text" class="formTextfield_Large" placeholder="Does this product have a color for grouping...?">
            </div>
            <div class="lineGroup two_column_1">
                <label for="category" class="sublabel"> *Category:</label>
                <input id="category" name="category" ng-model="Product.currentProduct.category" type="text" class="formTextfield_Large" placeholder="Category for sorting..." required>
            </div>

            <div class="lineGroup full_width">
                <label for="tags" class="sublabel"> *Tags:</label>
                <input id="tags" name="tags" ng-model="Product.currentProduct.tags" type="text" class="formTextfield_Large" placeholder="Comma separated tags..." required>
            </div>
            <div class="lineGroup full_width">
                <label for="description" class="sublabel"> *Description:</label>
                <textarea id="description" name="description" ng-model="Product.currentProduct.description" type="text" class="formTextfield_Large" placeholder="Enter a description of the product..." required></textarea>
            </div>
            <div class="lineGroup three_column_1">
                <label for="imgAlt" class="sublabel"> *Image Title:</label>
                <input id="imgAlt" name="imgAlt" ng-model="Product.currentProduct.imgAlt" type="text" class="formTextfield_Large" placeholder="This is for meta data..." required>
            </div>
            <div class="lineGroup three_column_1">
                <label for="imgOneFront" class="sublabel"> *Image (front) Name:</label>
                <input id="imgOneFront" name="customerEmail" ng-model="Product.currentProduct.imgOneFront" type="text" class="formTextfield_Large" placeholder="File name and extension (ie. warhammer.jpg)" required>
            </div>
            <div class="lineGroup three_column_1">
                <label for="imgOneBack" class="sublabel"> *Image (back) Name:</label>
                <input id="imgOneBack" name="phone" ng-model="Product.currentProduct.imgOneBack" type="text" class="formTextfield_Large" placeholder="File name and extension (ie. warhammer.jpg)" required>
            </div>
        </form>
    </fieldset>
</div>
<div class="product-col-3 single-product">
    <div class="panel panel-default sidebar-menu" >
        <div class="panel-body" style="text-align:center;">
            <button ng-click="Product.editProduct()" ng-if="Product.readOnly" class="btn btn-to-cart" type="button">Edit Details</button>
            <button ng-click="Product.saveProduct(Product.currentProduct, productForm)" ng-if="!Product.readOnly" class="btn btn-to-cart" type="button" ng-disabled="productForm.$invalid">Save Changes</button>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Featured?</h3>
            <select name="statusSelect" id="statusSelect" ng-model="Product.currentProduct.featured" selected="Product.currentProduct.featured" ng-disabled="Product.readOnly">
              <option value="true">Yes</option>
              <option value="false">No</option>
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">New?</h3>
            <select name="statusSelect" id="statusSelect" ng-model="Product.currentProduct.new" selected="Product.currentProduct.new" ng-disabled="Product.readOnly">
              <option value="true">Yes</option>
              <option value="false">No</option>
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">On Sale?</h3>
            <select name="statusSelect" id="statusSelect" ng-model="Product.currentProduct.onSale" selected="Product.currentProduct.onSale" ng-disabled="Product.readOnly">
              <option value="true">Yes</option>
              <option value="false">No</option>
            </select><br>
        </div>
        <div class="panel-heading">
            <h3 class="panel-title">Display?</h3>
            <select name="statusSelect" id="statusSelect" ng-model="Product.currentProduct.displayStatus" selected="Product.currentProduct.displayStatus" ng-disabled="Product.readOnly">
              <option value="true">Yes</option>
              <option value="false">No</option>
            </select><br>
        </div>
        <div class="panel-body" ng-if="!Product.isNew">
            Updated: {{Product.currentProduct.updated | jsonDate | date: 'medium'}}
        </div>
    </div>
    <div class="panel panel-default sidebar-menu" ng-if="Product.readOnly">
        <div class="panel-body" style="text-align:center;">
            <button ng-click="Product.removeProduct(Product.currentProduct.id)" class="btn btn-to-cart" type="button">Remove Product</button>
        </div>
    </div>
</div>
