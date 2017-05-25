'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// User Friends
{
	'method': 'POST',
	'path': '/api/userAchievements',
	'config': {
		'handler': _handlers.userAchievements.create,
		'tags': ['api'],
		'description': 'Create a new user achievement',
		'notes': 'Create a new user achievement',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'payload': _joi2.default.alternatives().try(_joi2.default.object({
				'UserId': _joi2.default.number().required(),
				'AchievementId': _joi2.default.number().required()
			}), _joi2.default.object({
				'UserId': _joi2.default.number().required(),
				'AchievementTitle': _joi2.default.string().required()
			}))
		}
	}
}, {
	'method': 'DELETE',
	'path': '/api/userAchievements/{UserId}/{AchievementId}',
	'config': {
		'handler': _handlers.userAchievements.remove,
		'tags': ['api'],
		'description': 'Remove a user achievement association',
		'notes': 'Remove a user achievement association',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
		},
		'validate': {
			'params': {
				'UserId': _joi2.default.number().required(),
				'AchievementId': _joi2.default.number().required()
			}
		}
	}
}, {
	'method': 'POST',
	'path': '/api/search/userAchievements',
	'config': {
		'tags': ['api'],
		'description': 'Return User/Player achievement search results',
		'notes': 'Return User/Player achievement search results',
		'validate': {
			'payload': {
				'username': _joi2.default.string().required(),
				'maxResults': _joi2.default.optional(),
				'pageNumber': _joi2.default.number().required(),
				'pageSize': _joi2.default.optional()
			}
		}
	},
	'handler': _handlers.userAchievements.search
}];