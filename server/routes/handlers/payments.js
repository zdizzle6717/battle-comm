'use strict';

import env from '../../../envVariables';
import Boom from 'boom';
import stripe from 'stripe';
let stripeService = stripe(env.stripe.testSecret);

// Product Route Configs
let payments = {
  oneTimeCharge: (request, reply) => {
		let token = JSON.parse(request.payload.token);
		let details = request.payload.details;
		stripeService.charges.create({
		  'amount': details.amount,
		  'currency': 'usd',
		  'description': details.description,
			'receipt_email': details.email,
		  'source': token.id,
		}, function(err, charge) {
		  if (err) {
				reply(Boom.badRequest(err));
			} else {
				reply(charge).code(200);
			}
		});
  }
};


export default payments;
