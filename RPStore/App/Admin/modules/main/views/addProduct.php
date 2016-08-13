<div class="product-col-9 single-product">
    <h2 class="product-title">{{vm.product.name}}</h2>
    <div class="product-col-6">
        <div class="magnify">
        	<!-- This is the magnifying glass which will contain the original/large version -->
        	<div class="large" style="background: url('{{vm.product.imageOne.imgFrontUrl}}') no-repeat;"></div>
        	<!-- This is the small image -->
        	<img ng-src="{{vm.product.imageOne.imgFrontUrl}}" alt="Table Top Product" class="img-responsive product-img small">
        </div>
    </div>
    <div class="product-col-6">
        <div class="product-description-header">Product Description: </div>
        <div class="product-description"><p>{{vm.product.description}}</p></div>
    </div>
</div>
<div class="product-col-3 single-product">
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">RP Value</h3>
            <h2>{{vm.product.price}} RP</h2>
        </div>
        <div class="panel-body">
            <ngcart-addtocart id="{{vm.product.id}}" name="{{vm.product.name}}" price="{{vm.product.price}}" quantity="1" quantity-max="5" class="center">Add to Cart</ngcart-addtocart>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu" >
        <div class="panel-body" style="text-align:center;">
            <button ui-sref="cart" class="btn btn-to-cart">Go to Cart</button>
        </div>
    </div>
</div>
<script src="Scripts/magnify.js" type="text/javascript"></script>
