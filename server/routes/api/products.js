'use strict';

let products = require('../handlers/products');
let Joi = require('joi');
let models = require('../../models');

module.exports = [
	// Products
	{
		method: 'GET',
		path: '/api/products/{id}',
		config: {
			tags: ['api'],
			description: 'Get one product by id',
			notes: 'Get one product by id',
			auth: {
				strategy: 'jsonWebToken',
				scope: ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			validate: {
				params: {
					id: Joi.number().required()
				}
			}
		},
		handler: products.get
	},
	{
		method: 'GET',
		path: '/api/products',
		config: {
			tags: ['api'],
			description: 'Get all products',
			notes: 'Get all products',
			auth: {
				strategy: 'jsonWebToken',
				scope: ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
		},
		handler: products.getAll
	},
	{
		method: 'POST',
		path: '/api/products',
		config: {
			tags: ['api'],
			description: 'Add a new product',
			notes: 'Add a new product',
			auth: {
				strategy: 'jsonWebToken',
				scope: ['systemAdmin']
			},
			validate: {
				payload: {
					SKU: Joi.string().required(),
					name: Joi.string().required(),
					price: Joi.number().required(),
					description: Joi.string().required(),
					manufacturerId: Joi.string().required(),
					gameSystem: Joi.string().required(),
					color: Joi.optional(),
					tags: Joi.string(),
					category: Joi.string(),
					stockQty: Joi.number().required(),
					inStock: Joi.boolean().required(),
					filterVal: Joi.string().required(),
					displayStatus: Joi.boolean().required(),
					featured: Joi.boolean().required(),
					new: Joi.boolean().required(),
					onSale: Joi.boolean().required(),
					imgAlt: Joi.string().required(),
					imgOneFront: Joi.string().required(),
					imgOneBack: Joi.string().required(),
					imgTwoFront: Joi.optional(),
					imgTwoBack: Joi.optional(),
					imgThreeFront: Joi.optional(),
					imgThreeBack: Joi.optional(),
					imgFourFront: Joi.optional(),
					imgFourBack: Joi.optional()
				}
			}
		},
		handler: products.create
	},
	{
		method: 'PUT',
		path: '/api/products/{id}',
		config: {
			tags: ['api'],
			description: 'Update a product by id',
			notes: 'Update a product by id',
			auth: {
				strategy: 'jsonWebToken',
				scope: ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			validate: {
				params: {
					id: Joi.number().required()
				},
				payload: {
					SKU: Joi.string().required(),
					name: Joi.string().required(),
					price: Joi.number().required(),
					description: Joi.string().required(),
					manufacturerId: Joi.string().required(),
					gameSystem: Joi.string().required(),
					color: Joi.optional(),
					tags: Joi.string(),
					category: Joi.string(),
					stockQty: Joi.number().required(),
					inStock: Joi.boolean().required(),
					filterVal: Joi.string().required(),
					displayStatus: Joi.boolean().required(),
					featured: Joi.boolean().required(),
					new: Joi.boolean().required(),
					onSale: Joi.boolean().required(),
					imgAlt: Joi.string().required(),
					imgOneFront: Joi.string().required(),
					imgOneBack: Joi.string().required(),
					imgTwoFront: Joi.optional(),
					imgTwoBack: Joi.optional(),
					imgThreeFront: Joi.optional(),
					imgThreeBack: Joi.optional(),
					imgFourFront: Joi.optional(),
					imgFourBack: Joi.optional()
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
