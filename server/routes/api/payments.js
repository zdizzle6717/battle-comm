'use strict';

import Joi from 'joi';
import { payments } from '../handlers';

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
					'UserId': Joi.number().required(),
					'token': Joi.optional(),
					'plan': Joi.string().required(),
					'email': Joi.string().required(),
					'description': Joi.string().required()
				}
			}
		},
		'handler': payments.createSubscription
	},
	{
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
		'handler': payments.getSubscriptionPlans
	},
	{
		'method': 'GET',
		'path': '/api/payments/getCustomer/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Get customer by Id',
			'notes': 'Get customer by Id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				}
			}
		},
		'handler': payments.getCustomer
	},
	{
		'method': 'POST',
		'path': '/api/payments/payShippingCost/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Request new purchase',
			'notes': 'Request new purchase',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				},
				'payload': {
					'token': Joi.string().required(),
					'details': Joi.object().keys({
						'email': Joi.string().required(),
						'description': Joi.string().required(),
						'shippingCost': Joi.number().precision(2).required()
					})
				}
			}
		},
		'handler': payments.payShippingCost
	},
	{
		'method': 'POST',
		'path': '/api/payments/purchaseRP/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Request new purchase',
			'notes': 'Request new purchase',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				},
				'payload': {
					'token': Joi.string().required(),
					'details': Joi.object().keys({
						'email': Joi.string().required(),
						'description': Joi.string().required(),
						'priceIndex': Joi.number().required()
					})
				}
			}
		},
		'handler': payments.purchaseRP
	}
];
