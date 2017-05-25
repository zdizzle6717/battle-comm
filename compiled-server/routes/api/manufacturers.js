'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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
      'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
    },
    'validate': {
      'params': {
        'id': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.manufacturers.get
}, {
  'method': 'GET',
  'path': '/api/manufacturers',
  'config': {
    'tags': ['api'],
    'description': 'Get all manufacturers',
    'notes': 'Get all manufacturers'
  },
  'handler': _handlers.manufacturers.getAll
}, {
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
        'File': _joi2.default.optional(),
        'name': _joi2.default.string().required(),
        'description': _joi2.default.optional(),
        'url': _joi2.default.optional()
      }
    }
  },
  'handler': _handlers.manufacturers.create
}, {
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
        'id': _joi2.default.number().required()
      },
      'payload': {
        'id': _joi2.default.optional(),
        'updatedAt': _joi2.default.optional(),
        'createdAt': _joi2.default.optional(),
        'GameSystems': _joi2.default.optional(),
        'File': _joi2.default.optional(),
        'name': _joi2.default.string().required(),
        'description': _joi2.default.optional(),
        'url': _joi2.default.optional()
      }
    }
  },
  'handler': _handlers.manufacturers.update
}, {
  'method': 'POST',
  'path': '/api/search/manufacturers',
  'config': {
    'tags': ['api'],
    'description': 'Return Manufacturer search results',
    'notes': 'Return Manufacturer search results',
    'validate': {
      'payload': {
        'maxResults': _joi2.default.optional(),
        'searchQuery': _joi2.default.optional(),
        'searchBy': _joi2.default.optional(),
        'orderBy': _joi2.default.string().required(),
        'pageNumber': _joi2.default.number().required(),
        'pageSize': _joi2.default.optional()
      }
    }
  },
  'handler': _handlers.manufacturers.search
}, {
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
        'id': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.manufacturers.delete
}];