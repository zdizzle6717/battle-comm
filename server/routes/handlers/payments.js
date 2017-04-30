'use strict';

import models from '../../models';
import env from '../../../envVariables';
import Boom from 'boom';
import pointPriceConfig from '../../../pointPriceConfig';
import stripe from 'stripe';
let stripeService = stripe(env.stripe.testSecret);
import buildRPUpdateEmail from '../../email-templates/rpUpdate';
import nodemailer from 'nodemailer';
import xoauth2 from 'xoauth2';

let generator = xoauth2.createXOAuth2Generator(env.email.XOAuth2);

// listen for token updates
// consider storying these to a db
generator.on('token', (token) => {});

let transporter = nodemailer.createTransport(({
  'service': 'Gmail',
  'auth': {
    'xoauth2': generator
  }
}));

// Product Route Configs
let payments = {
  purchaseRP: (request, reply) => {
		let token = JSON.parse(request.payload.token);
		let priceIndex = request.payload.details.priceIndex;
		let details = request.payload.details;
		// TODO: Extra security check
		let secure = true;
		if (secure) {
			stripeService.charges.create({
			  'amount': pointPriceConfig[priceIndex].value,
			  'currency': 'usd',
			  'description': details.description,
				'receipt_email': details.email,
			  'source': token.id,
			}, function(err, charge) {
			  if (err) {
					reply(Boom.badRequest(err));
				} else {
					// Find user and increment reward points
					models.User.find({
			        'where': {
			          'id': request.params.id
			        }
			      })
			      .then((user) => {
			        if (user) {
			          user.increment({
									'rewardPoints': pointPriceConfig[priceIndex].rp
								}).then((user) => {
									user = user.get({'plain': true});

									let basicUser = {
										'id': user.id,
										'username': user.username,
										'firstName': user.firstName,
										'lastName': user.lastName,
										'rewardPoints': user.rewardPoints
									};

									let rpMailConfig = {
										'from': env.email.user,
										'to': user.email,
										'subject': `Reward Point Update: New Total of ${basicUser.rewardPoints}`,
										'html': buildRPUpdateEmail(basicUser)
									};

									transporter.sendMail(rpMailConfig, (error, info) => {
										if (error) {
											console.log(error);
											reply(Boom.badRequest('Reward Point Email Failed.'));
										}

										reply({
											'user': basicUser,
											'charge': charge
										}).code(200);
									});

								});
			        } else {
			          reply().code(404);
			        }
			      }).catch((error) => {
			        console.log(error);
			      });
				}
			});
		} else {
			reply(Boom.badRequest(`Don't fuck with the machine!`));
		}
  }
};


export default payments;
