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
	},
	{
    'method': 'POST',
    'path': '/api/search/friends',
    'config': {
      'tags': ['api'],
      'description': 'Return User/Player Ally search results',
      'notes': 'Return User/Player Ally search results',
      'validate': {
				'payload': {
					'username': Joi.string().required(),
          'maxResults': Joi.optional(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    },
    'handler': userFriends.search
  }
];
