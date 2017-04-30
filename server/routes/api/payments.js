'use strict';

import Joi from 'joi';
import { payments } from '../handlers';

module.exports = [
	// Payments
	{
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
