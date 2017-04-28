'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// User Friends
{
	'method': 'POST',
	'path': '/api/friends',
	'config': {
		'handler': _handlers.userFriends.create,
		'tags': ['api'],
		'description': 'Create a new user friend',
		'notes': 'Create a new user friend',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'payload': {
				'UserId': _joi2.default.number().required(),
				'InviteeId': _joi2.default.number().required()
			}
		}
	}
}, {
	'method': 'DELETE',
	'path': '/api/friends/{UserId}/{InviteeId}',
	'config': {
		'handler': _handlers.userFriends.remove,
		'tags': ['api'],
		'description': 'Remove a friend association',
		'notes': 'Remove a friend association',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'params': {
				'UserId': _joi2.default.number().required(),
				'InviteeId': _joi2.default.number().required()
			}
		}
	}
}, {
	'method': 'POST',
	'path': '/api/search/friends/{UserId}',
	'config': {
		'tags': ['api'],
		'description': 'Return User/Player Ally search results',
		'notes': 'Return User/Player Ally search results',
		'validate': {
			'payload': {
				'maxResults': _joi2.default.optional(),
				'searchQuery': _joi2.default.optional(),
				'searchBy': _joi2.default.optional(),
				'orderBy': _joi2.default.string().required(),
				'pageNumber': _joi2.default.number().required(),
				'pageSize': _joi2.default.optional()
			}
		}
	},
	'handler': _handlers.userFriends.search
}];