'use strict';

import Joi from 'joi';
import { userPhotos } from '../handlers';

module.exports = [
  // Files
  {
    'method': 'POST',
    'path': '/api/userPhotos',
    'handler': userPhotos.create,
    'config': {
      'tags': ['api'],
      'description': 'Add file details',
      'notes': 'Add file details',
      'validate': {
        'payload': {
					'UserId': Joi.optional(),
          'identifier': Joi.string().required(),
          'locationUrl': Joi.optional(),
          'label': Joi.optional(),
          'name': Joi.string().required(),
          'size': Joi.number().required(),
          'type': Joi.string().required()
        }
      },
			'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'cors': {
        'origin': ['*']
      }
    }
  },
  {
    'method': 'PUT',
    'path': '/api/userPhotos/{id}',
    'handler': userPhotos.update,
    'config': {
      'tags': ['api'],
      'description': 'Update file details',
      'notes': 'Update file details',
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
        'payload': {
          'UserId': Joi.optional(),
          'identifier': Joi.string().required(),
          'locationUrl': Joi.optional(),
          'label': Joi.optional(),
          'name': Joi.string().required(),
          'size': Joi.number().required(),
          'type': Joi.string().required()
        }
      },
      'cors': {
        'origin': ['*']
      }
    }
  },
  {
    'method': 'DELETE',
    'path': '/api/userPhotos/{id}',
    'handler': userPhotos.delete,
    'config': {
      'tags': ['api'],
      'description': 'Delete a user photo by id',
      'notes': 'Delete a user photo by id',
      'validate': {
        'params': {
          'id': Joi.number().required()
        }
      },
			'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'cors': {
        'origin': ['*']
      }
    }
  }
];
