'use strict';

import Joi from 'joi';
import { manufacturers } from '../handlers';

module.exports = [
  // Manufacturers
  {
    'method': 'GET',
    'path': '/api/manufacturers/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Get one manufacturer by id',
      'notes': 'Get one manufacturer by id',
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
    'handler': manufacturers.get
  },
  {
    'method': 'GET',
    'path': '/api/manufacturers',
    'config': {
      'tags': ['api'],
      'description': 'Get all manufacturers',
      'notes': 'Get all manufacturers',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
    },
    'handler': manufacturers.getAll
  },
  {
    'method': 'POST',
    'path': '/api/manufacturers',
    'config': {
      'tags': ['api'],
      'description': 'Add a new manufacturer',
      'notes': 'Add a new manufacturer',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'payload': {
          'name': Joi.string().required(),
          'searchKey': Joi.optional(),
          'description': Joi.optional(),
          'url': Joi.optional()
        }
      }
    },
    'handler': manufacturers.create
  },
  {
    'method': 'PUT',
    'path': '/api/manufacturers/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Update a manufacturer by id',
      'notes': 'Update a manufacturer by id',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['systemAdmin']
      },
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
        'payload': {
          'name': Joi.string().required(),
          'searchKey': Joi.optional(),
          'description': Joi.optional(),
          'url': Joi.optional()
        }
      }
    },
    'handler': manufacturers.update
  },
	{
    'method': 'POST',
    'path': '/api/search/manufacturers',
    'config': {
      'tags': ['api'],
      'description': 'Return Manufacturer search results',
      'notes': 'Return Manufacturer search results',
      'validate': {
        'payload': {
          'maxResults': Joi.optional(),
          'searchQuery': Joi.optional(),
					'searchBy': Joi.optional(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    },
    'handler': manufacturers.search
  },
  {
    'method': 'DELETE',
    'path': '/api/manufacturers/{id}',
    'config': {
      'tags': ['api'],
      'description': 'Delete a manufacturer by id',
      'notes': 'Delete a manufacturer by id',
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
    'handler': manufacturers.delete
  }
];
