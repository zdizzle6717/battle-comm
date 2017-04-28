'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
function buildTemplate(data) {
	var productTable = '';
	data.productDetails.forEach(function (product, index) {
		if (index === 0 || index % 2 === 0) {
			productTable += '\n\t\t\t<tr style="background-color: #e8e8e8;">\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + product.SKU + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + product.name + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + product.price + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">(' + product.qty + ')</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + parseFloat(product.price) * parseFloat(product.qty) + ' RP</td>\n\t\t\t</tr>\n\t\t\t';
		} else {
			productTable += '\n\t\t\t<tr>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + product.SKU + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + product.name + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + product.price + '</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">(' + product.qty + ')</td>\n\t\t\t  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">' + parseFloat(product.price) * parseFloat(product.qty) + ' RP</td>\n\t\t\t</tr>\n\t\t\t';
		}
	});

	return '\n\t\t<div style="max-width:800px;position:relative;margin:20px auto;padding:15px;border:2px solid black;box-shadow:0 0 5px 2px lightgray;letter-spacing:1px;background-color:aliceblue;box-shadow: 0 0 2px 1px rgba(31, 31, 33, 0.47);">\n\t\t\t<div style="text-align:center;">\n\t\t\t\t<h1 style="font-size:40px; font-size:40px; padding-bottom:5px; margin-top:15px;  border-bottom:1px solid #cacaca;">' + (data.status === 'processing' ? 'Order Succes!' : 'Your order has shipped!') + '</h1>\n\t\t\t\t<h2 style="font-size:28px">...thanks for being a part of Battle-Comm.</h2>\n\n\t\t\t\t<b>This is a confirmation for ' + data.customerFullName + ' with order #' + data.id + '</b>\n\t\t\t</div>\n\n\t\t\t<h3 style="font-size="24px">Order Details</h3>\n\n\t\t\t<h4 style="font-size="18px">Shipping Address</h4>\n\t\t\t<p>' + data.shippingStreet + '</p>\n\t\t\t<p>' + data.shippingCity + ', ' + data.shippingState + ' ' + data.shippingZip + '</p>\n\t\t\t<p>' + data.shippingCountry + '</p>\n\n\t\t\t<p><strong>Order Details:</strong> ' + (data.orderDetails || 'N/A') + '</p>\n\n\t\t\t<table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;">\n\t\t\t  <tr>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">SKU</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Product Name</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Reward Points</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Quantity</th>\n\t\t\t\t<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Subtotal</th>\n\t\t\t  </tr>\n\t\t\t  ' + productTable + '\n\t\t\t</table>\n\n\t\t\t<h2 style="font-size:28px">Order Total: ' + data.orderTotal + ' Reward Points</h2>\n\n\t\t\t<div style="text-align:center; border-top:1px solid #cacaca; padding:20px 0 0;">\n\t\t\t\t<img src="https://www.battle-comm.net/images/BC_Web_Logo.png">\n\t\t\t</div>\n\t\t</div>\n\t';
}

exports.default = buildTemplate;