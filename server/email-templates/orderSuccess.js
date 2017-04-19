'use strict';

function buildTemplate(data) {
	let productList = data.orderDetails.split(' || ');
	let productArray = [];

	productList.forEach(function(product) {
		let arr = product.split(', ');
		let obj = {
			id: arr[0].substring(3),
			name: arr[1].substring(8),
			price: arr[2].substring(3),
			quantity: arr[3].substring(4)
		}
		productArray.push(obj);
	});

	let productTable = '';
	productArray.forEach(function(product, index) {
		if (index === 0 || index % 2 === 0) {
			productTable +=
			`
			<tr style="background-color: #e8e8e8;">
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${product.id}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${product.name}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${product.price}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">(${product.quantity})</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${parseFloat(product.price) * parseFloat(product.quantity)} RP</td>
			</tr>
			`
		} else {
			productTable +=
			`
			<tr>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${product.id}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${product.name}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${product.price}</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">(${product.quantity})</td>
			  <td style="border:1px solid #dddddd; text-align:left; padding:8px;">${parseFloat(product.price) * parseFloat(product.quantity)} RP</td>
			</tr>
			`
		}
	});

	return `
		<div style="max-width:800px;position:relative;margin:20px auto;padding:15px;border:2px solid black;box-shadow:0 0 5px 2px lightgray;letter-spacing:1px;background-color:aliceblue;box-shadow: 0 0 2px 1px rgba(31, 31, 33, 0.47);">
			<div style="text-align:center;">
				<h1 style="font-size:40px; font-size:40px; padding-bottom:5px; margin-top:15px;  border-bottom:1px solid #cacaca;">Thank You For Your Order!</h1>
				<h2 style="font-size:28px">...and thanks for being a part of Battle-Comm.</h2>

				<b>This is a confirmation for ${data.customerFullName} with order #${data.id}</b>
			</div>

			<h3 style="font-size="24px">Order Details</h3>

			<h4 style="font-size="18px">Shipping Address</h4>
			<p>${data.shippingStreet}</p>
			<p>${data.shippingCity}, ${data.shippingState} ${data.shippingZip}</p>
			<p>${data.shippingCountry}</p>

			<table style="font-family: arial, sans-serif;border-collapse: collapse;width: 100%;">
			  <tr>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">ID</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Product Name</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Reward Points</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Quantity</th>
				<th style="border:1px solid #dddddd; text-align:left; padding:8px;">Subtotal</th>
			  </tr>
			  ${productTable}
			</table>

			<h2 style="font-size:28px">Order Total: ${data.orderTotal} Reward Points</h2>

			<div style="text-align:center; border-top:1px solid #cacaca; padding:20px 0 0;">
				<img src="https://www.battle-comm.net/images/BC_Web_Logo.png">
			</div>
		</div>
	`
}

export default buildTemplate;
