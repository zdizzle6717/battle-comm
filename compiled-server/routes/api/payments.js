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
			'scope': ['member', 'eventAdmin']
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
			'scope': ['member', 'eventAdmin']
		}
	},
	'handler': _handlers.payments.getSubscriptionPlans
}, {
	'method': 'GET',
	'path': '/api/payments/getCustomer/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Get customer by Id',
		'notes': 'Get customer by Id',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'eventAdminSubscriber']
		},
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			}
		}
	},
	'handler': _handlers.payments.getCustomer
}, {
	'method': 'POST',
	'path': '/api/payments/payShippingCost/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Request new purchase',
		'notes': 'Request new purchase',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
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
					'shippingCost': _joi2.default.number().precision(2).required()
				})
			}
		}
	},
	'handler': _handlers.payments.payShippingCost
}, {
	'method': 'POST',
	'path': '/api/payments/purchaseRP/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Request new purchase',
		'notes': 'Request new purchase',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
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