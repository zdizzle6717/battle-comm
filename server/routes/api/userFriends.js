'use strict';

import Joi from 'joi';
import { userFriends } from '../handlers';

module.exports = [
	// User Friends
	{
		'method': 'POST',
		'path': '/api/friends',
		'config': {
			'handler': userFriends.create,
			'tags': ['api'],
			'description': 'Create a new user friend',
			'notes': 'Create a new user friend',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'payload': {
					'UserId': Joi.number().required(),
					'InviteeId': Joi.number().required(),
				}
			}
		}
	},
	{
		'method': 'DELETE',
		'path': '/api/friends/{UserId}/{InviteeId}',
		'config': {
			'handler': userFriends.remove,
			'tags': ['api'],
			'description': 'Remove a friend association',
			'notes': 'Remove a friend association',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'params': {
					'UserId': Joi.number().required(),
					'InviteeId': Joi.number().required(),
				}
			}
		}
	}
];
