'use strict';

import Joi from 'joi';
import { userAchievements } from '../handlers';

module.exports = [
	// User Friends
	{
		'method': 'POST',
		'path': '/api/userAchievements',
		'config': {
			'handler': userAchievements.create,
			'tags': ['api'],
			'description': 'Create a new user achievement',
			'notes': 'Create a new user achievement',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'payload': Joi.alternatives().try(
					Joi.object({
						'UserId': Joi.number().required(),
						'AchievementId': Joi.number().required(),
						'notify': Joi.optional()
					}),
					Joi.object({
						'UserId': Joi.number().required(),
						'AchievementTitle': Joi.string().required(),
						'notify': Joi.optional()
					})
				)
			}
		}
	},
	{
		'method': 'DELETE',
		'path': '/api/userAchievements/{UserId}/{AchievementId}',
		'config': {
			'handler': userAchievements.remove,
			'tags': ['api'],
			'description': 'Remove a user achievement association',
			'notes': 'Remove a user achievement association',
			'auth': {
				'strategy': 'jsonWebToken',
				'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			'validate': {
				'params': {
					'UserId': Joi.number().required(),
					'AchievementId': Joi.number().required(),
				}
			}
		}
	},
	{
    'method': 'POST',
    'path': '/api/search/userAchievements',
    'config': {
      'tags': ['api'],
      'description': 'Return User/Player achievement search results',
      'notes': 'Return User/Player achievement search results',
      'validate': {
				'payload': {
					'username': Joi.string().required(),
          'maxResults': Joi.optional(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    },
    'handler': userAchievements.search
  }
];
