'use strict';

import Joi from 'joi';
import { achievements } from '../handlers';

module.exports = [
  // Achievements
  {
    'method': 'GET',
    'path': '/api/achievements/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Get one achievement by id',
      'notes': 'Get one achievement by id',
      'validate': {
        'params': {
          'id': Joi.number().required()
        }
      }
    },
    'handler': achievements.get
  },
  {
    'method': 'GET',
    'path': '/api/achievements',
    'config': {
      'tags': ['api'],
      'description': 'Get all achievements',
      'notes': 'Get all achievements'
    },
    'handler': achievements.getAll
  },
  {
    'method': 'POST',
    'path': '/api/achievements',
    'config': {
      'tags': ['api'],
      'description': 'Add a new achievement',
      'notes': 'Add a new achievement',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'payload': {
          'title': Joi.string().required(),
          'category': Joi.string().required(),
          'description': Joi.string().required(),
          'priority': Joi.optional(),
        }
      }
    },
    'handler': achievements.create
  },
  {
    'method': 'PUT',
    'path': '/api/achievements/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Update an achievement by id',
      'notes': 'Update an achievement by id',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
        'payload': {
					'id': Joi.optional(),
					'createdAt': Joi.optional(),
					'updatedAt': Joi.optional(),
					'File': Joi.optional(),
					'title': Joi.number().required(),
					'priority': Joi.optional(),
          'category': Joi.string().required(),
          'description': Joi.optional()
        }
      }
    },
    'handler': achievements.update
  },
	{
    'method': 'POST',
    'path': '/api/search/achievements',
    'config': {
      'tags': ['api'],
      'description': 'Return achievement search results',
      'notes': 'Return achievement search results',
      'validate': {
        'payload': {
          'maxResults': Joi.optional(),
          'searchQuery': Joi.optional(),
					'searchBy': Joi.optional(),
					'orderBy': Joi.string().required(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    },
    'handler': achievements.search
  },
  {
    'method': 'DELETE',
    'path': '/api/achievements/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Delete an achievement by id',
      'notes': 'Delete an achievement by id',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        }
      }
    },
    'handler': achievements.delete
  }
];
