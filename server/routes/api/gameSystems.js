'use strict';

import Joi from 'joi';
import { gameSystems } from '../handlers';

module.exports = [
  // Game Systems
  {
    'method': 'GET',
    'path': '/api/gameSystems/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Get one game system by id',
      'notes': 'Get one game system by id',
      'validate': {
        'params': {
          'id': Joi.number().required()
        }
      }
    },
    'handler': gameSystems.get
  },
  {
    'method': 'GET',
    'path': '/api/gameSystems',
    'config': {
      'tags': ['api'],
      'description': 'Get all gameSystems',
      'notes': 'Get all gameSystems'
    },
    'handler': gameSystems.getAll
  },
  {
    'method': 'POST',
    'path': '/api/gameSystems',
    'config': {
      'tags': ['api'],
      'description': 'Add a new game system',
      'notes': 'Add a new game system',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'payload': {
					'Factions': Joi.optional(),
					'File': Joi.optional(),
          'ManufacturerId': Joi.number().required(),
          'name': Joi.string().required(),
          'description': Joi.optional(),
          'url': Joi.optional()
        }
      }
    },
    'handler': gameSystems.create
  },
  {
    'method': 'PUT',
    'path': '/api/gameSystems/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Update a game system by id',
      'notes': 'Update a game system by id',
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
					'Manufacturer': Joi.optional(),
					'Factions': Joi.optional(),
					'File': Joi.optional(),
          'ManufacturerId': Joi.number().required(),
          'name': Joi.string().required(),
          'description': Joi.optional(),
          'url': Joi.optional()
        }
      }
    },
    'handler': gameSystems.update
  },
	{
    'method': 'POST',
    'path': '/api/search/gameSystems',
    'config': {
      'tags': ['api'],
      'description': 'Return Game System search results',
      'notes': 'Return Game System search results',
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
    'handler': gameSystems.search
  },
  {
    'method': 'DELETE',
    'path': '/api/gameSystems/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Delete a game system by id',
      'notes': 'Delete a game system by id',
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
    'handler': gameSystems.delete
  }
];
