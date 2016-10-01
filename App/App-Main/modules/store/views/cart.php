<div class="full_width">
	<div class="product-col-9">
		<a ui-sref="store" style="background:none;box-shadow:none;"><img src="../images/BC_RPStore_Logo.png" alt="Reward Point Store" class="store-logo"/></a>
	</div>
	<div class="product-col-3">
		<a ui-sref="cart" style="padding: 5px 0 0 0; width:150px">
			<ngcart-summary></ngcart-summary>
		</a>
		<div user-details></div>
	</div>
	<hr class="push-bottom">
</div>
<h1 style="text-align:center;">Cart Summary</h1>

    <ngcart-cart complete="complete(info)"></ngcart-cart>


<div class="product-col-12" style="text-align:center;">
    <hr/>
    <!--<button ui-sref="checkout" class="btn btn-addtocart">Continue to Checkout</button>-->
</div>
