'use strict';

import Joi from 'joi';
import { userPhotos } from '../handlers';

module.exports = [
  // User photos
  {
    'method': 'POST',
    'path': '/api/userPhotos',
    'config': {
      'handler': userPhotos.create,
      'tags': ['api'],
      'description': 'Create a new user photo',
      'notes': 'Create a new user photo',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'validate': {
        'payload': {
          'UserId': Joi.number().required(),
          'url': Joi.string().required(),
        }
      }
    }
  }
];
