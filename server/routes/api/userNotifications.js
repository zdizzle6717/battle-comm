'use strict';

import Joi from 'joi';
import { userNotifications } from '../handlers';

module.exports = [
	// User Notifications
	{
		'method': 'POST',
		'path': '/api/userNotifications',
		'config': {
			'tags': ['api'],
			'description': 'Add a new userNotification',
			'notes': 'Add a new userNotification',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'payload': {
					'UserId': Joi.number().required(),
					'type': Joi.string().valid().required('allyRequestReceived', 'allyRequestAccepted', 'newMessage'),
					'status': Joi.optional(),
					'fromId': Joi.number().required(),
					'fromUsername': Joi.string().required(),
					'fromName': Joi.string().required()
				}
			}
		},
		'handler': userNotifications.create
	},
	{
		'method': 'PUT',
		'path': '/api/userNotifications/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Update a user notification by id',
			'notes': 'Update a user notification by id',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'params': {
					'id': Joi.number().required()
				},
				'payload': {
					'UserId': Joi.number().required(),
					'type': Joi.string().valid().required('allyRequestReceived', 'allyRequestAccepted', 'newMessage'),
					'status': Joi.string().required(),
					'fromId': Joi.number().required(),
					'fromName': Joi.string().required()
				}
			}
		},
		'handler': userNotifications.update
	},
	{
    'method': 'POST',
    'path': '/api/search/userNotifications',
    'config': {
      'tags': ['api'],
      'description': 'Return user notification search results',
      'notes': 'Return user notification search results',
      'validate': {
        'payload': {
					'UserId': Joi.number().required(),
          'maxResults': Joi.optional(),
          'searchQuery': Joi.optional(),
					'searchBy': Joi.optional(),
					'orderBy': Joi.string().required(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    },
    'handler': userNotifications.search
  },
	{
		'method': 'DELETE',
		'path': '/api/userNotifications/{id}',
		'config': {
			'tags': ['api'],
			'description': 'Delete a user notification by id',
			'notes': 'Delete a user notification by id',
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
		'handler': userNotifications.delete
	}
];
