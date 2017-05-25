'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// User Notifications
{
	'method': 'GET',
	'path': '/api/userNotifications/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Get user notifications by id',
		'notes': 'Get user notifications by id',
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			}
		}
	},
	'handler': _handlers.userNotifications.get
}, {
	'method': 'POST',
	'path': '/api/userNotifications',
	'config': {
		'tags': ['api'],
		'description': 'Add a new userNotification',
		'notes': 'Add a new userNotification',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'payload': {
				'UserId': _joi2.default.number().required(),
				'type': _joi2.default.string().valid('allyRequestReceived', 'allyRequestAccepted', 'newAchievement', 'newMessage').required(),
				'status': _joi2.default.optional(),
				'fromId': _joi2.default.number().required(),
				'fromUsername': _joi2.default.string().required(),
				'fromName': _joi2.default.string().required()
			}
		}
	},
	'handler': _handlers.userNotifications.create
}, {
	'method': 'PUT',
	'path': '/api/userNotifications/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Update a user notification by id',
		'notes': 'Update a user notification by id',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'params': {
				'id': _joi2.default.number().required()
			},
			'payload': {
				'UserId': _joi2.default.number().required(),
				'type': _joi2.default.string().valid().required('allyRequestReceived', 'allyRequestAccepted', 'newAchievement', 'newMessage'),
				'status': _joi2.default.string().required(),
				'fromId': _joi2.default.number().required(),
				'fromName': _joi2.default.string().required()
			}
		}
	},
	'handler': _handlers.userNotifications.update
}, {
	'method': 'POST',
	'path': '/api/search/userNotifications',
	'config': {
		'tags': ['api'],
		'description': 'Return user notification search results',
		'notes': 'Return user notification search results',
		'validate': {
			'payload': {
				'UserId': _joi2.default.number().required(),
				'maxResults': _joi2.default.optional(),
				'searchQuery': _joi2.default.optional(),
				'searchBy': _joi2.default.optional(),
				'orderBy': _joi2.default.string().required(),
				'pageNumber': _joi2.default.number().required(),
				'pageSize': _joi2.default.optional()
			}
		}
	},
	'handler': _handlers.userNotifications.search
}, {
	'method': 'DELETE',
	'path': '/api/userNotifications/{id}',
	'config': {
		'tags': ['api'],
		'description': 'Delete a user notification by id',
		'notes': 'Delete a user notification by id',
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
	'handler': _handlers.userNotifications.delete
}];