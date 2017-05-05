'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// Payments
{
	'method': 'POST',
	'path': '/api/payments/subscriptions',
	'config': {
		'tags': ['api'],
		'description': 'Create a new subscription',
		'notes': 'Create a new subscription',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member']
		},
		'validate': {
			'payload': {
				'UserId': _joi2.default.number().required(),
				'token': _joi2.default.optional(),
				'plan': _joi2.default.string().required(),
				'email': _joi2.default.string().required(),
				'description': _joi2.default.string().required()
			}
		}
	},
	'handler': _handlers.payments.createSubscription
}, {
	'method': 'GET',
	'path': '/api/payments/subscriptions',
	'config': {
		'tags': ['api'],
		'description': 'Get all available subscriptions',
		'notes': 'Get all available subscriptions',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member']
		}
	},
	'handler': _handlers.payments.getSubscriptionPlans
}, {
	'method': 'POST',
	'path': '/api/payments/purchaseRP/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Request new purchase',
		'notes': 'Request new purchase',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['eventAdmin', 'venueAdmin', 'systemAdmin']
		},
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			},
			'payload': {
				'token': _joi2.default.string().required(),
				'details': _joi2.default.object().keys({
					'email': _joi2.default.string().required(),
					'description': _joi2.default.string().required(),
					'priceIndex': _joi2.default.number().required()
				})
			}
		}
	},
	'handler': _handlers.payments.purchaseRP
}];