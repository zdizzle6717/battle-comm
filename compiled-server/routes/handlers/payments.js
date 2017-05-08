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

var _rpUpdate = require('../../email-templates/rpUpdate');

var _rpUpdate2 = _interopRequireDefault(_rpUpdate);

var _nodemailer = require('nodemailer');

var _nodemailer2 = _interopRequireDefault(_nodemailer);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var stripeService = (0, _stripe2.default)(_envVariables2.default.stripe.testSecret);


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
				'email': request.payload.email
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
						userConfig.subscriber = true;
						user.updateAttributes(userConfig).then(function () {
							reply(subscription).code(200);
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
						// Set user's customerId
						user.updateAttributes({
							'customerId': customer.id
						}).then(function (user) {
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
								userConfig.subscriber = true;
								user.updateAttributes(userConfig).then(function () {
									reply(subscription).code(200);
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
								'rewardPoints': _pointPriceConfig2.default[priceIndex].rp
							}).then(function (user) {
								user = user.get({ 'plain': true });

								var basicUser = {
									'id': user.id,
									'username': user.username,
									'firstName': user.firstName,
									'lastName': user.lastName,
									'rewardPoints': user.rewardPoints,
									'service': 'Gmail',
									'auth': {
										'user': _envVariables2.default.email.user,
										'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
									}
								};

								var rpMailConfig = {
									'from': _envVariables2.default.email.user,
									'to': user.email,
									'subject': 'Reward Point Update: New Total of ' + basicUser.rewardPoints,
									'html': (0, _rpUpdate2.default)(basicUser),
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