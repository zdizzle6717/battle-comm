'use strict';

import Joi from 'joi';
import { products } from '../handlers';

module.exports = [
	// Products
	{
		'method': 'GET',
		'path': '/api/products/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Get one product by id',
			'notes': 'Get one product by id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				}
			}
		},
		'handler': products.get
	},
	{
		'method': 'GET',
		'path': '/api/products',
		'config': {
			'tags': ['api'],
			'description': 'Get all products',
			'notes': 'Get all products',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
		},
		'handler': products.getAll
	},
	{
		'method': 'POST',
		'path': '/api/products',
		'config': {
			'tags': ['api'],
			'description': 'Add a new product',
			'notes': 'Add a new product',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['systemAdmin']
			},
			'validate': {
				'payload': {
					'ManufacturerId': Joi.optional(),
					'GameSystemId': Joi.optional(),
					'FactionId': Joi.optional(),
					'SKU': Joi.string().required(),
					'name': Joi.string().required(),
					'price': Joi.number().required(),
					'description': Joi.string().required(),
					'color': Joi.optional(),
					'tags': Joi.string(),
					'category': Joi.string(),
					'stockQty': Joi.number().required(),
					'inStock': Joi.boolean().required(),
					'filterVal': Joi.optional(),
					'displayStatus': Joi.boolean().required(),
					'featured': Joi.boolean().required(),
					'new': Joi.boolean().required(),
					'onSale': Joi.boolean().required()
				}
			}
		},
		'handler': products.create
	},
	{
		'method': 'PUT',
		'path': '/api/products/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Update a product by id',
			'notes': 'Update a product by id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				},
				'payload': {
					'ManufacturerId': Joi.optional(),
					'GameSystemId': Joi.optional(),
					'FactionId': Joi.optional(),
					'SKU': Joi.string().required(),
					'name': Joi.string().required(),
					'price': Joi.number().required(),
					'description': Joi.string().required(),
					'color': Joi.optional(),
					'tags': Joi.string(),
					'category': Joi.string(),
					'stockQty': Joi.number().required(),
					'inStock': Joi.boolean().required(),
					'filterVal': Joi.optional(),
					'displayStatus': Joi.boolean().required(),
					'featured': Joi.boolean().required(),
					'new': Joi.boolean().required(),
					'onSale': Joi.boolean().required()
				}
			}
		},
		handler: products.update
	},
	{
		method: 'DELETE',
		path: '/api/products/{id}',
		config: {
			tags: ['api'],
			description: 'Delete a product by id',
			notes: 'Delete a product by id',
			auth: {
				strategy: 'jsonWebToken',
				scope: ['systemAdmin']
			},
			validate: {
				params: {
					id: Joi.number().required()
				}
			}
		},
		handler: products.delete
	}
];
