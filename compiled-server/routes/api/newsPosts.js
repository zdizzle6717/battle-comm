'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// News Posts
{
	'method': 'GET',
	'path': '/api/newsPosts/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Get one newsPost by id',
		'notes': 'Get one newsPost by id',
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			}
		}
	},
	'handler': _handlers.newsPosts.get
}, {
	'method': 'GET',
	'path': '/api/newsPosts',
	'config': {
		'tags': ['api'],
		'description': 'Get all newsPosts',
		'notes': 'Get all newsPosts'
	},
	'handler': _handlers.newsPosts.getAll
}, {
	'method': 'POST',
	'path': '/api/newsPosts',
	'config': {
		'tags': ['api'],
		'description': 'Add a new newsPost',
		'notes': 'Add a new newsPost',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['newsContributor', 'systemAdmin']
		},
		'validate': {
			'payload': {
				'Files': _joi2.default.optional(),
				'UserId': _joi2.default.number().required(),
				'FactionId': _joi2.default.optional(),
				'GameSystemId': _joi2.default.optional(),
				'ManufacturerId': _joi2.default.optional(),
				'title': _joi2.default.string().required(),
				'callout': _joi2.default.string().required(),
				'body': _joi2.default.string().required(),
				'published': _joi2.default.boolean().required(),
				'featured': _joi2.default.boolean().required(),
				'tags': _joi2.default.optional(),
				'manufacturerId': _joi2.default.optional(),
				'gameSystemId': _joi2.default.optional(),
				'category': _joi2.default.string().required()
			}
		}
	},
	'handler': _handlers.newsPosts.create
}, {
	'method': 'PUT',
	'path': '/api/newsPosts/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Update a newsPost by id',
		'notes': 'Update a newsPost by id',
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
				'ManufacturerId': _joi2.default.optional(),
				'FactionId': _joi2.default.optional(),
				'GameSystemId': _joi2.default.optional(),
				'User': _joi2.default.optional(),
				'Files': _joi2.default.optional(),
				'UserId': _joi2.default.number().required(),
				'title': _joi2.default.string().required(),
				'callout': _joi2.default.string().required(),
				'body': _joi2.default.string().required(),
				'published': _joi2.default.boolean().required(),
				'featured': _joi2.default.boolean().required(),
				'tags': _joi2.default.optional(),
				'manufacturerId': _joi2.default.optional(),
				'gameSystemId': _joi2.default.optional(),
				'category': _joi2.default.string().required()
			}
		}
	},
	'handler': _handlers.newsPosts.update
}, {
	'method': 'POST',
	'path': '/api/search/newsPosts',
	'config': {
		'tags': ['api'],
		'description': 'Return News Post search results',
		'notes': 'Return News Post search results',
		'validate': {
			'payload': {
				'maxResults': _joi2.default.optional(),
				'searchQuery': _joi2.default.optional(),
				'orderBy': _joi2.default.string().required(),
				'searchBy': _joi2.default.optional(),
				'pageNumber': _joi2.default.number().required(),
				'pageSize': _joi2.default.optional(),
				'published': _joi2.default.optional()
			}
		}
	},
	'handler': _handlers.newsPosts.search
}, {
	'method': 'DELETE',
	'path': '/api/newsPosts/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Delete a newsPost by id',
		'notes': 'Delete a newsPost by id',
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
	'handler': _handlers.newsPosts.delete
}];