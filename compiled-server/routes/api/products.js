'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			}
		}
	},
	'handler': _handlers.products.get
}, {
	'method': 'GET',
	'path': '/api/products',
	'config': {
		'tags': ['api'],
		'description': 'Get all products',
		'notes': 'Get all products',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		}
	},
	'handler': _handlers.products.getAll
}, {
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
				'ManufacturerId': _joi2.default.optional(),
				'GameSystemId': _joi2.default.optional(),
				'FactionId': _joi2.default.optional(),
				'Files': _joi2.default.optional(),
				'SKU': _joi2.default.string().required(),
				'name': _joi2.default.string().required(),
				'price': _joi2.default.number().integer().required(),
				'shippingCost': _joi2.default.number().precision(2).required(),
				'description': _joi2.default.string().required(),
				'color': _joi2.default.optional(),
				'tags': _joi2.default.string(),
				'category': _joi2.default.string(),
				'stockQty': _joi2.default.number().required(),
				'isInStock': _joi2.default.optional(),
				'filterVal': _joi2.default.optional(),
				'isDisplayed': _joi2.default.boolean().required(),
				'isFeatured': _joi2.default.boolean().required(),
				'isNew': _joi2.default.boolean().required(),
				'isOnSale': _joi2.default.boolean().required()
			}
		}
	},
	'handler': _handlers.products.create
}, {
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
				'id': _joi2.default.number().required()
			},
			'payload': {
				'ManufacturerId': _joi2.default.optional(),
				'GameSystemId': _joi2.default.optional(),
				'FactionId': _joi2.default.optional(),
				'Files': _joi2.default.optional(),
				'id': _joi2.default.optional(),
				'updatedAt': _joi2.default.optional(),
				'createdAt': _joi2.default.optional(),
				'SKU': _joi2.default.string().required(),
				'name': _joi2.default.string().required(),
				'price': _joi2.default.number().integer().required(),
				'shippingCost': _joi2.default.number().precision(2).required(),
				'description': _joi2.default.string().required(),
				'color': _joi2.default.optional(),
				'tags': _joi2.default.string().required(),
				'category': _joi2.default.string().required(),
				'stockQty': _joi2.default.number().required(),
				'isInStock': _joi2.default.optional(),
				'filterVal': _joi2.default.optional(),
				'isDisplayed': _joi2.default.boolean().required(),
				'isFeatured': _joi2.default.boolean().required(),
				'isNew': _joi2.default.boolean().required(),
				'isOnSale': _joi2.default.boolean().required()
			}
		}
	},
	'handler': _handlers.products.update
}, {
	'method': 'PUT',
	'path': '/api/products/stockQty/update',
	'config': {
		'tags': ['api'],
		'description': 'Update a product stock by id',
		'notes': 'Update a product stock by id',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'payload': {
				'direction': _joi2.default.string().valid('increment', 'decrement').required(),
				'products': _joi2.default.array().items(_joi2.default.object().keys({
					'id': _joi2.default.number().required(),
					'qty': _joi2.default.number().required()
				}))
			}
		}
	},
	'handler': _handlers.products.updateStock
}, {
	'method': 'POST',
	'path': '/api/search/products',
	'config': {
		'tags': ['api'],
		'description': 'Return product search results',
		'notes': 'Return product search results',
		'validate': {
			'payload': {
				'maxResults': _joi2.default.optional(),
				'searchQuery': _joi2.default.optional(),
				'searchBy': _joi2.default.optional(),
				'orderBy': _joi2.default.string().required(),
				'pageNumber': _joi2.default.number().required(),
				'pageSize': _joi2.default.optional(),
				'minPrice': _joi2.default.optional(),
				'maxPrice': _joi2.default.optional(),
				'manufacturerId': _joi2.default.optional(),
				'gameSystemId': _joi2.default.optional(),
				'storeView': _joi2.default.boolean().required()
			}
		}
	},
	'handler': _handlers.products.search
}, {
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
				'id': _joi2.default.number().required()
			}
		}
	},
	'handler': _handlers.products.delete
}];