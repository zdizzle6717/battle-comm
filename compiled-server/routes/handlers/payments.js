'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _envVariables = require('../../../envVariables');

var _envVariables2 = _interopRequireDefault(_envVariables);

var _boom = require('boom');

var _boom2 = _interopRequireDefault(_boom);

var _stripe = require('stripe');

var _stripe2 = _interopRequireDefault(_stripe);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var stripeService = (0, _stripe2.default)(_envVariables2.default.stripe.testSecret);

// Product Route Configs
var payments = {
	oneTimeCharge: function oneTimeCharge(request, reply) {
		var token = JSON.parse(request.payload.token);
		var details = request.payload.details;
		stripeService.charges.create({
			'amount': details.amount,
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
	}
};

exports.default = payments;