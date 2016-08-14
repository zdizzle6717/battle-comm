<div class="product-col-9 single-product">
    <h2 class="product-title">{{Product.product.name}}</h2>
    <div class="product-col-6">
        <div class="magnify">
        	<!-- This is the magnifying glass which will contain the original/large version -->
        	<div class="large" style="background: url('images/uploads/{{Product.product.imageOne.imgFrontUrl}}') no-repeat;"></div>
        	<!-- This is the small image -->
        	<img ng-src="images/uploads/{{Product.product.imageOne.imgFrontUrl}}" alt="Table Top Product" class="img-responsive product-img small">
        </div>
    </div>
    <div class="product-col-6">
        <div class="product-description-header">Product Description: </div>
        <div class="product-description"><p>{{Product.product.description}}</p></div>
    </div>
</div>
<div class="product-col-3 single-product">
    <div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">RP Value</h3>
            <h2>{{Product.product.price}} RP</h2>
        </div>
        <div class="panel-body">
            <ngcart-addtocart id="{{Product.product.id}}" name="{{Product.product.name}}" price="{{Product.product.price}}" quantity="1" quantity-max="5" class="center add-cart-box">Add to Cart</ngcart-addtocart>
        </div>
    </div>
    <div class="panel panel-default sidebar-menu" >
        <div class="panel-body" style="text-align:center;">
            <button ui-sref="cart" class="btn btn-to-cart">Go to Cart</button>
        </div>
    </div>
</div>
<script src="js/magnify.js" type="text/javascript"></script>
