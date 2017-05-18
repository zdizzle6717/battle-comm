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
					'Files': Joi.optional(),
					'SKU': Joi.string().required(),
					'name': Joi.string().required(),
					'price': Joi.number().integer().required(),
					'shippingCost': Joi.number().precision(2).required(),
					'description': Joi.string().required(),
					'color': Joi.optional(),
					'tags': Joi.string(),
					'category': Joi.string(),
					'stockQty': Joi.number().required(),
					'isInStock': Joi.optional(),
					'filterVal': Joi.optional(),
					'isDisplayed': Joi.boolean().required(),
					'isFeatured': Joi.boolean().required(),
					'isNew': Joi.boolean().required(),
					'isOnSale': Joi.boolean().required()
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
				'scope': ['systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				},
				'payload': {
					'ManufacturerId': Joi.optional(),
					'GameSystemId': Joi.optional(),
					'FactionId': Joi.optional(),
					'Files': Joi.optional(),
					'id': Joi.optional(),
					'updatedAt': Joi.optional(),
					'createdAt': Joi.optional(),
					'SKU': Joi.string().required(),
					'name': Joi.string().required(),
					'price': Joi.number().integer().required(),
					'shippingCost': Joi.number().precision(2).required(),
					'description': Joi.string().required(),
					'color': Joi.optional(),
					'tags': Joi.string().required(),
					'category': Joi.string().required(),
					'stockQty': Joi.number().required(),
					'isInStock': Joi.optional(),
					'filterVal': Joi.optional(),
					'isDisplayed': Joi.boolean().required(),
					'isFeatured': Joi.boolean().required(),
					'isNew': Joi.boolean().required(),
					'isOnSale': Joi.boolean().required()
				}
			}
		},
		'handler': products.update
	},
	{
		'method': 'PUT',
		'path': '/api/products/stockQty/update',
		'config': {
			'tags': ['api'],
			'description': 'Update a product stock by id',
			'notes': 'Update a product stock by id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'payload': {
					'direction': Joi.string().valid('increment', 'decrement').required(),
					'products': Joi.array().items(Joi.object().keys({
						'id': Joi.number().required(),
						'qty': Joi.number().required()
					}))
				}
			}
		},
		'handler': products.updateStock
	},
	{
    'method': 'POST',
    'path': '/api/search/products',
    'config': {
      'tags': ['api'],
      'description': 'Return product search results',
      'notes': 'Return product search results',
      'validate': {
        'payload': {
          'maxResults': Joi.optional(),
          'searchQuery': Joi.optional(),
					'searchBy': Joi.optional(),
					'orderBy': Joi.string().required(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional(),
					'minPrice': Joi.optional(),
					'maxPrice': Joi.optional(),
					'manufacturerId': Joi.optional(),
					'gameSystemId': Joi.optional(),
					'storeView': Joi.boolean().required()
        }
      }
    },
    'handler': products.search
  },
	{
		'method': 'DELETE',
		'path': '/api/products/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Delete a product by id',
			'notes': 'Delete a product by id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				}
			}
		},
		'handler': products.delete
	}
];
