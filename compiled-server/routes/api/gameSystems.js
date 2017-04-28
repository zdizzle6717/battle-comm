'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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
        'id': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.gameSystems.get
}, {
  'method': 'GET',
  'path': '/api/gameSystems',
  'config': {
    'tags': ['api'],
    'description': 'Get all gameSystems',
    'notes': 'Get all gameSystems'
  },
  'handler': _handlers.gameSystems.getAll
}, {
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
        'Factions': _joi2.default.optional(),
        'File': _joi2.default.optional(),
        'ManufacturerId': _joi2.default.number().required(),
        'name': _joi2.default.string().required(),
        'description': _joi2.default.optional(),
        'url': _joi2.default.optional()
      }
    }
  },
  'handler': _handlers.gameSystems.create
}, {
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
        'id': _joi2.default.number().required()
      },
      'payload': {
        'id': _joi2.default.optional(),
        'createdAt': _joi2.default.optional(),
        'updatedAt': _joi2.default.optional(),
        'Manufacturer': _joi2.default.optional(),
        'Factions': _joi2.default.optional(),
        'File': _joi2.default.optional(),
        'ManufacturerId': _joi2.default.number().required(),
        'name': _joi2.default.string().required(),
        'description': _joi2.default.optional(),
        'url': _joi2.default.optional()
      }
    }
  },
  'handler': _handlers.gameSystems.update
}, {
  'method': 'POST',
  'path': '/api/search/gameSystems',
  'config': {
    'tags': ['api'],
    'description': 'Return Game System search results',
    'notes': 'Return Game System search results',
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
  'handler': _handlers.gameSystems.search
}, {
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
        'id': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.gameSystems.delete
}];