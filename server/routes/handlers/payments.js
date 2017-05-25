'use strict';

import models from '../../models';
import env from '../../../envVariables';
import Boom from 'boom';
import roleConfig from '../../../roleConfig';
import pointPriceConfig from '../../../pointPriceConfig';
import stripe from 'stripe';
let stripeService = stripe(env.stripe.secret);
import buildRPPoolUpdateEmail from '../../email-templates/rpPoolUpdate';
import nodemailer from 'nodemailer';

let transporter = nodemailer.createTransport(({
	'service': 'Gmail',
	'auth': {
		'type': 'OAuth2',
		'clientId': env.email.OAuth2.clientId,
		'clientSecret': env.email.OAuth2.clientSecret
	}
}));

// Product Route Configs
let payments = {
	createSubscription: (request, reply) => {
		let plan = JSON.parse(request.payload.plan);
		let token = request.payload.token ? JSON.parse(request.payload.token) : undefined;
		models.User.find({
			'where': {
				'$or': [
					{
						'email': request.payload.email
					},
					{
						'id': request.payload.UserId
					}
				]
			}
		}).then((user) => {
			if (user) {
				if (user.customerId) {
					stripeService.subscriptions.create({
						'customer': user.customerId,
						'plan': plan.id
					}, function(error, subscription) {
						if (error) {
							reply(Boom.badRequest(error));
						}
						let userConfig = {};
						roleConfig.forEach((role) => {
							if (role.name !== 'public') {
								userConfig[role.name] = false;
							}
						});
						if (user.eventAdmin) {
							userConfig.eventAdminSubscriber = true;
						} else if (user.member) {
							userConfig.subscriber = true;
						}
						let rpPool = subscription.plan.metadata.rewardPoints ? parseInt(subscription.plan.metadata.rewardPoints, 10) : 0;
						userConfig.rewardPoints = user.get({
							'plain': true
						}).rewardPoints + rpPool;
						user.updateAttributes(userConfig).then(() => {
							models.UserNotification.create({
								'UserId': request.payload.UserId,
			          'type': 'newAchievement',
			          'fromUsername': 'systemAdmin',
								'details': subscription.plan.metadata.achievement
							}).then(() => {
								reply(subscription).code(200);
							});
						});
					});
				} else {
					// Create the user in stripe
					if (!token.id) {
						reply(Boom.badRequest('Checkout token is required for new customers'));
						return;
					}
					stripeService.customers.create({
					  'email': request.payload.email,
						'source': token.id
					}, (error, customer) => {
						if (error) {
							reply(Boom.badRequest(error));
							return;
						}
						stripeService.subscriptions.create({
						  'customer': customer.id,
						  'plan': plan.id
						}, function(error, subscription) {
							if (error) {
								reply(Boom.badRequest(error));
								return;
							}
							let userConfig = {};
							roleConfig.forEach((role) => {
								if (role.name !== 'public') {
									userConfig[role.name] = false;
								}
							});
							if (user.eventAdmin) {
								userConfig.eventAdminSubscriber = true;
							} else if (user.member) {
								userConfig.subscriber = true;
							}
							userConfig.customerId = customer.id;
							let rpPool = subscription.plan.metadata.rewardPoints ? parseInt(subscription.plan.metadata.rewardPoints, 10) : 0;
							userConfig.rewardPoints = user.get({
								'plain': true
							}).rewardPoints + rpPool;
							user.updateAttributes(userConfig).then(() => {
								models.UserNotification.create({
									'UserId': request.payload.UserId,
				          'type': 'newAchievement',
				          'fromUsername': 'systemAdmin',
									'details': subscription.plan.metadata.achievement
								}).then(() => {
									reply(subscription).code(200);
								}).catch((error) => {
									console.log(error);
								});
							});
						});
					});
				}
			} else {
				reply(Boom.notFound('No user found with the supplied e-mail'));
			}
		});
	},
	getSubscriptionPlans: (request, reply) => {
		stripeService.plans.list(
		  { limit: 100 },
		  function(error, plans) {
				if (error) {
					reply(Boom.badRequest(error));
					return;
				}
		    reply(plans).code(200);
		  }
		);
	},
	getCustomer: (request, reply) => {
		models.User.find({
			'where': {
				'id': request.params.id
			}
		}).then((user) => {
			stripeService.customers.retrieve(
			  user.customerId,
			  function(error, customer) {
			    if (error) {
						reply(Boom.badRequest(error));
					} else {
						reply(customer).code(200);
					}
			  }
			);
		})
	},
	payShippingCost: (request, reply) => {
		let token = JSON.parse(request.payload.token);
		let shippingCost = request.payload.details.shippingCost;
		let details = request.payload.details;
		// TODO: Add extra security check
		let secure = true;
		if (secure) {
			stripeService.charges.create({
			  'amount': shippingCost,
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
		} else {
			reply(Boom.badRequest(`Don't fuck with the machine!`));
		}
  },
  purchaseRP: (request, reply) => {
		let token = JSON.parse(request.payload.token);
		let priceIndex = request.payload.details.priceIndex;
		let details = request.payload.details;
		// TODO: Add extra security check
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
									'rpPool': pointPriceConfig[priceIndex].rp
								}).then((user) => {
									user = user.get({'plain': true});

									let basicUser = {
										'id': user.id,
										'username': user.username,
										'firstName': user.firstName,
										'lastName': user.lastName,
										'rewardPoints': user.rewardPoints,
										'rpPool': user.rpPool,
										'service': 'Gmail',
										'auth': {
											'user': env.email.user,
											'refreshToken': env.email.OAuth2.refreshToken
										}
									};

									let rpMailConfig = {
										'from': env.email.user,
										'to': user.email,
										'subject': `RP Pool Updated: Receipt for ${pointPriceConfig[priceIndex].rp} RP`,
										'html': buildRPPoolUpdateEmail(basicUser),
										'service': 'Gmail',
										'auth': {
											'user': env.email.user,
											'refreshToken': env.email.OAuth2.refreshToken
										}
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
