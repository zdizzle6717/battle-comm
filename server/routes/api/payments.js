'use strict';

import Joi from 'joi';
import { payments } from '../handlers';

module.exports = [
	// Payments
	{
		'method': 'POST',
		'path': '/api/payments/oneTimeCharge',
		'config': {
			'tags': ['api'],
			'description': 'Request new purchase',
			'notes': 'Request new purchase',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['eventAdmin', 'venueAdmin', 'systemAdmin']
			},
			'validate': {
				'payload': {
					'token': Joi.string().required(),
					'details': Joi.object().keys({
						'amount': Joi.number().required(),
						'description': Joi.string().required(),
						'email': Joi.string().required()
					})
				}
			}
		},
		'handler': payments.oneTimeCharge
	}
];
