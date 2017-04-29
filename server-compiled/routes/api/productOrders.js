'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// Product Orders
{
	'method': 'GET',
	'path': '/api/productOrders/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Get one productOrder by id',
		'notes': 'Get one productOrder by id',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			}
		}
	},
	'handler': _handlers.productOrders.get
}, {
	'method': 'GET',
	'path': '/api/productOrders',
	'config': {
		'tags': ['api'],
		'description': 'Get all productOrders',
		'notes': 'Get all productOrders',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		}
	},
	'handler': _handlers.productOrders.getAll
}, {
	'method': 'POST',
	'path': '/api/productOrders',
	'config': {
		'tags': ['api'],
		'description': 'Add a new productOrder',
		'notes': 'Add a new productOrder',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'payload': {
				'status': _joi2.default.string().valid('processing', 'shipped', 'completed').required(),
				'orderDetails': _joi2.default.optional(),
				'productDetails': _joi2.default.array().items(_joi2.default.object().keys({
					'id': _joi2.default.optional(),
					'createdAt': _joi2.default.optional(),
					'updatedAt': _joi2.default.optional(),
					'FactionId': _joi2.default.optional(),
					'GameSystemId': _joi2.default.optional(),
					'ManufacturerId': _joi2.default.optional(),
					'Files': _joi2.default.optional(),
					'qty': _joi2.default.number().required(),
					'SKU': _joi2.default.string().required(),
					'name': _joi2.default.string().required(),
					'price': _joi2.default.number().required(),
					'color': _joi2.default.optional(),
					'description': _joi2.default.optional(),
					'tags': _joi2.default.optional(),
					'category': _joi2.default.optional(),
					'stockQty': _joi2.default.optional(),
					'isDisplayed': _joi2.default.optional(),
					'isFeatured': _joi2.default.optional(),
					'isNew': _joi2.default.optional(),
					'isOnSale': _joi2.default.optional(),
					'isInStock': _joi2.default.optional()
				})).required(),
				'orderTotal': _joi2.default.number().required(),
				'UserId': _joi2.default.number().required(),
				'customerFullName': _joi2.default.string().required(),
				'customerEmail': _joi2.default.string().email().required(),
				'phone': _joi2.default.optional(),
				'shippingStreet': _joi2.default.string().required(),
				'shippingApartment': _joi2.default.optional(),
				'shippingCity': _joi2.default.string().required(),
				'shippingState': _joi2.default.string().required(),
				'shippingZip': _joi2.default.string().required(),
				'shippingCountry': _joi2.default.string().required()
			}
		}
	},
	'handler': _handlers.productOrders.create
}, {
	'method': 'PUT',
	'path': '/api/productOrders/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Update a productOrder by id',
		'notes': 'Update a productOrder by id',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['systemAdmin']
		},
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			},
			'payload': {
				'status': _joi2.default.string().valid('processing', 'shipped', 'completed').required(),
				'orderDetails': _joi2.default.string().required(),
				'productDetails': _joi2.default.optional(),
				'orderTotal': _joi2.default.number().required(),
				'id': _joi2.default.optional(),
				'createdAt': _joi2.default.optional(),
				'updatedAt': _joi2.default.optional(),
				'UserId': _joi2.default.number().required(),
				'customerFullName': _joi2.default.string().required(),
				'customerEmail': _joi2.default.string().email().required(),
				'phone': _joi2.default.optional(),
				'shippingStreet': _joi2.default.string().required(),
				'shippingApartment': _joi2.default.optional(),
				'shippingCity': _joi2.default.string().required(),
				'shippingState': _joi2.default.string().required(),
				'shippingZip': _joi2.default.string().required(),
				'shippingCountry': _joi2.default.string().required()
			}
		}
	},
	'handler': _handlers.productOrders.update
}, {
	'method': 'POST',
	'path': '/api/search/productOrders',
	'config': {
		'tags': ['api'],
		'description': 'Return Product Order search results',
		'notes': 'Return Product Order search results',
		'validate': {
			'payload': {
				'maxResults': _joi2.default.optional(),
				'searchQuery': _joi2.default.optional(),
				'orderBy': _joi2.default.optional(),
				'searchBy': _joi2.default.optional(),
				'pageNumber': _joi2.default.number().required(),
				'pageSize': _joi2.default.optional()
			}
		}
	},
	'handler': _handlers.productOrders.search
}, {
	'method': 'DELETE',
	'path': '/api/productOrders/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Delete a productOrder by id',
		'notes': 'Delete a productOrder by id',
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
	'handler': _handlers.productOrders.delete
}];