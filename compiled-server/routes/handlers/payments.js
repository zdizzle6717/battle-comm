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

var _pointPriceConfig = require('../../../pointPriceConfig');

var _pointPriceConfig2 = _interopRequireDefault(_pointPriceConfig);

var _stripe = require('stripe');

var _stripe2 = _interopRequireDefault(_stripe);

var _rpUpdate = require('../../email-templates/rpUpdate');

var _rpUpdate2 = _interopRequireDefault(_rpUpdate);

var _nodemailer = require('nodemailer');

var _nodemailer2 = _interopRequireDefault(_nodemailer);

var _xoauth = require('xoauth2');

var _xoauth2 = _interopRequireDefault(_xoauth);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var stripeService = (0, _stripe2.default)(_envVariables2.default.stripe.testSecret);


var generator = _xoauth2.default.createXOAuth2Generator(_envVariables2.default.email.XOAuth2);

// listen for token updates
// consider storying these to a db
generator.on('token', function (token) {});

var transporter = _nodemailer2.default.createTransport({
	'service': 'Gmail',
	'auth': {
		'xoauth2': generator
	}
});

// Product Route Configs
var payments = {
	purchaseRP: function purchaseRP(request, reply) {
		var token = JSON.parse(request.payload.token);
		var priceIndex = request.payload.details.priceIndex;
		var details = request.payload.details;
		// TODO: Extra security check
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
									'rewardPoints': user.rewardPoints
								};

								var rpMailConfig = {
									'from': _envVariables2.default.email.user,
									'to': user.email,
									'subject': 'Reward Point Update: New Total of ' + basicUser.rewardPoints,
									'html': (0, _rpUpdate2.default)(basicUser)
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