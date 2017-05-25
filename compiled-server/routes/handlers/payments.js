'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

var _envVariables = require('../../../envVariables');

var _envVariables2 = _interopRequireDefault(_envVariables);

var _boom = require('boom');

var _boom2 = _interopRequireDefault(_boom);

var _roleConfig = require('../../../roleConfig');

var _roleConfig2 = _interopRequireDefault(_roleConfig);

var _pointPriceConfig = require('../../../pointPriceConfig');

var _pointPriceConfig2 = _interopRequireDefault(_pointPriceConfig);

var _stripe = require('stripe');

var _stripe2 = _interopRequireDefault(_stripe);

var _rpPoolUpdate = require('../../email-templates/rpPoolUpdate');

var _rpPoolUpdate2 = _interopRequireDefault(_rpPoolUpdate);

var _nodemailer = require('nodemailer');

var _nodemailer2 = _interopRequireDefault(_nodemailer);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var stripeService = (0, _stripe2.default)(_envVariables2.default.stripe.secret);


var transporter = _nodemailer2.default.createTransport({
	'service': 'Gmail',
	'auth': {
		'type': 'OAuth2',
		'clientId': _envVariables2.default.email.OAuth2.clientId,
		'clientSecret': _envVariables2.default.email.OAuth2.clientSecret
	}
});

// Product Route Configs
var payments = {
	createSubscription: function createSubscription(request, reply) {
		var plan = JSON.parse(request.payload.plan);
		var token = request.payload.token ? JSON.parse(request.payload.token) : undefined;
		_models2.default.User.find({
			'where': {
				'$or': [{
					'email': request.payload.email
				}, {
					'id': request.payload.UserId
				}]
			}
		}).then(function (user) {
			if (user) {
				if (user.customerId) {
					stripeService.subscriptions.create({
						'customer': user.customerId,
						'plan': plan.id
					}, function (error, subscription) {
						if (error) {
							reply(_boom2.default.badRequest(error));
						}
						var userConfig = {};
						_roleConfig2.default.forEach(function (role) {
							if (role.name !== 'public') {
								userConfig[role.name] = false;
							}
						});
						if (user.eventAdmin) {
							userConfig.eventAdminSubscriber = true;
						} else if (user.member) {
							userConfig.subscriber = true;
						}
						var rpPool = subscription.plan.metadata.rewardPoints ? parseInt(subscription.plan.metadata.rewardPoints, 10) : 0;
						userConfig.rewardPoints = user.get({
							'plain': true
						}).rewardPoints + rpPool;
						user.updateAttributes(userConfig).then(function () {
							_models2.default.UserNotification.create({
								'UserId': request.payload.UserId,
								'type': 'newAchievement',
								'fromUsername': 'systemAdmin',
								'details': subscription.plan.metadata.achievement
							}).then(function () {
								reply(subscription).code(200);
							});
						});
					});
				} else {
					// Create the user in stripe
					if (!token.id) {
						reply(_boom2.default.badRequest('Checkout token is required for new customers'));
						return;
					}
					stripeService.customers.create({
						'email': request.payload.email,
						'source': token.id
					}, function (error, customer) {
						if (error) {
							reply(_boom2.default.badRequest(error));
							return;
						}
						stripeService.subscriptions.create({
							'customer': customer.id,
							'plan': plan.id
						}, function (error, subscription) {
							if (error) {
								reply(_boom2.default.badRequest(error));
								return;
							}
							var userConfig = {};
							_roleConfig2.default.forEach(function (role) {
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
							var rpPool = subscription.plan.metadata.rewardPoints ? parseInt(subscription.plan.metadata.rewardPoints, 10) : 0;
							userConfig.rewardPoints = user.get({
								'plain': true
							}).rewardPoints + rpPool;
							user.updateAttributes(userConfig).then(function () {
								_models2.default.UserNotification.create({
									'UserId': request.payload.UserId,
									'type': 'newAchievement',
									'fromUsername': 'systemAdmin',
									'details': subscription.plan.metadata.achievement
								}).then(function () {
									reply(subscription).code(200);
								}).catch(function (error) {
									console.log(error);
								});
							});
						});
					});
				}
			} else {
				reply(_boom2.default.notFound('No user found with the supplied e-mail'));
			}
		});
	},
	getSubscriptionPlans: function getSubscriptionPlans(request, reply) {
		stripeService.plans.list({ limit: 100 }, function (error, plans) {
			if (error) {
				reply(_boom2.default.badRequest(error));
				return;
			}
			reply(plans).code(200);
		});
	},
	getCustomer: function getCustomer(request, reply) {
		_models2.default.User.find({
			'where': {
				'id': request.params.id
			}
		}).then(function (user) {
			stripeService.customers.retrieve(user.customerId, function (error, customer) {
				if (error) {
					reply(_boom2.default.badRequest(error));
				} else {
					reply(customer).code(200);
				}
			});
		});
	},
	payShippingCost: function payShippingCost(request, reply) {
		var token = JSON.parse(request.payload.token);
		var shippingCost = request.payload.details.shippingCost;
		var details = request.payload.details;
		// TODO: Add extra security check
		var secure = true;
		if (secure) {
			stripeService.charges.create({
				'amount': shippingCost,
				'currency': 'usd',
				'description': details.description,
				'receipt_email': details.email,
				'source': token.id
			}, function (err, charge) {
				if (err) {
					reply(_boom2.default.badRequest(err));
				} else {
					reply(charge).code(200);
				}
			});
		} else {
			reply(_boom2.default.badRequest('Don\'t fuck with the machine!'));
		}
	},
	purchaseRP: function purchaseRP(request, reply) {
		var token = JSON.parse(request.payload.token);
		var priceIndex = request.payload.details.priceIndex;
		var details = request.payload.details;
		// TODO: Add extra security check
		var secure = true;
		if (secure) {
			stripeService.charges.create({
				'amount': _pointPriceConfig2.default[priceIndex].value,
				'currency': 'usd',
				'description': details.description,
				'receipt_email': details.email,
				'source': token.id
			}, function (err, charge) {
				if (err) {
					reply(_boom2.default.badRequest(err));
				} else {
					// Find user and increment reward points
					_models2.default.User.find({
						'where': {
							'id': request.params.id
						}
					}).then(function (user) {
						if (user) {
							user.increment({
								'rpPool': _pointPriceConfig2.default[priceIndex].rp
							}).then(function (user) {
								user = user.get({ 'plain': true });

								var basicUser = {
									'id': user.id,
									'username': user.username,
									'firstName': user.firstName,
									'lastName': user.lastName,
									'rewardPoints': user.rewardPoints,
									'rpPool': user.rpPool,
									'service': 'Gmail',
									'auth': {
										'user': _envVariables2.default.email.user,
										'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
									}
								};

								var rpMailConfig = {
									'from': _envVariables2.default.email.user,
									'to': user.email,
									'subject': 'RP Pool Updated: Receipt for ' + _pointPriceConfig2.default[priceIndex].rp + ' RP',
									'html': (0, _rpPoolUpdate2.default)(basicUser),
									'service': 'Gmail',
									'auth': {
										'user': _envVariables2.default.email.user,
										'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
									}
								};

								transporter.sendMail(rpMailConfig, function (error, info) {
									if (error) {
										console.log(error);
										reply(_boom2.default.badRequest('Reward Point Email Failed.'));
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
					}).catch(function (error) {
						console.log(error);
					});
				}
			});
		} else {
			reply(_boom2.default.badRequest('Don\'t fuck with the machine!'));
		}
	}
};

exports.default = payments;