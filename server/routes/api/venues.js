'use strict';

import Joi from 'joi';
import { venues } from '../handlers';

module.exports = [
  // Venues
  {
    'method': 'POST',
    'path': '/api/venues/assignPoints',
    'config': {
      'tags': ['api'],
      'description': 'Add new points assignment',
      'notes': 'Add new points assignment by e-mail',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'validate': {
        'payload': {
          'venueEvent': {
			'adminUsername': Joi.string().required(),
            'venueName': Joi.string().required(),
            'eventName': Joi.string().required(),
            'venueAdmin': Joi.string().required(),
            'eventDate': Joi.string().required(),
            'returnEmail': Joi.string().required(),
          },
          'players': Joi.array().items(Joi.object({
            'fullName': Joi.string().required(),
            'email': Joi.string().required(),
            'pointsEarned': Joi.number().required(),
            'gameSystem': Joi.string().required(),
            'faction': Joi.optional(),
            'totalWins': Joi.number().optional(),
            'totalDraws': Joi.number().optional(),
            'totalLosses': Joi.number().optional(),
            'achievementsList': Joi.optional(),
          }))
        }
      }
    },
    handler: venues.create
  }
];
