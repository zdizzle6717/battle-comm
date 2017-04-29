'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// News Posts
{
	'method': 'GET',
	'path': '/api/bannerSlides/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Get one bannerSlide by id',
		'notes': 'Get one bannerSlide by id',
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			}
		}
	},
	'handler': _handlers.bannerSlides.get
}, {
	'method': 'GET',
	'path': '/api/bannerSlides',
	'config': {
		'tags': ['api'],
		'description': 'Get all bannerSlides',
		'notes': 'Get all bannerSlides'
	},
	'handler': _handlers.bannerSlides.getAll
}, {
	'method': 'POST',
	'path': '/api/bannerSlides',
	'config': {
		'tags': ['api'],
		'description': 'Add a new bannerSlide',
		'notes': 'Add a new bannerSlide',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['newsContributor', 'systemAdmin']
		},
		'validate': {
			'payload': {
				'index': _joi2.default.optional(),
				'actionText': _joi2.default.string().required(),
				'pageName': _joi2.default.string().required(),
				'title': _joi2.default.string().required(),
				'text': _joi2.default.string().required(),
				'priority': _joi2.default.number().required(),
				'link': _joi2.default.optional(),
				'isActive': _joi2.default.optional()
			}
		}
	},
	'handler': _handlers.bannerSlides.create
}, {
	'method': 'PUT',
	'path': '/api/bannerSlides/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Update a bannerSlide by id',
		'notes': 'Update a bannerSlide by id',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['newsContributor', 'systemAdmin']
		},
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			},
			'payload': {
				'id': _joi2.default.optional(),
				'createdAt': _joi2.default.optional(),
				'updatedAt': _joi2.default.optional(),
				'File': _joi2.default.optional(),
				'index': _joi2.default.optional(),
				'actionText': _joi2.default.string().required(),
				'pageName': _joi2.default.string().required(),
				'title': _joi2.default.string().required(),
				'text': _joi2.default.string().required(),
				'priority': _joi2.default.number().required(),
				'link': _joi2.default.optional(),
				'isActive': _joi2.default.optional()
			}
		}
	},
	'handler': _handlers.bannerSlides.update
}, {
	'method': 'DELETE',
	'path': '/api/bannerSlides/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Delete a bannerSlide by id',
		'notes': 'Delete a bannerSlide by id',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['newsContributor', 'systemAdmin']
		},
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			}
		}
	},
	'handler': _handlers.bannerSlides.delete
}];