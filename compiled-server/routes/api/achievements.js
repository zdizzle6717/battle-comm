'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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
        'id': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.achievements.get
}, {
  'method': 'GET',
  'path': '/api/achievements',
  'config': {
    'tags': ['api'],
    'description': 'Get all achievements',
    'notes': 'Get all achievements'
  },
  'handler': _handlers.achievements.getAll
}, {
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
        'title': _joi2.default.string().required(),
        'category': _joi2.default.string().required(),
        'description': _joi2.default.string().required(),
        'priority': _joi2.default.optional(),
        'rpValue': _joi2.default.optional()
      }
    }
  },
  'handler': _handlers.achievements.create
}, {
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
        'id': _joi2.default.number().required()
      },
      'payload': {
        'id': _joi2.default.optional(),
        'createdAt': _joi2.default.optional(),
        'updatedAt': _joi2.default.optional(),
        'File': _joi2.default.optional(),
        'title': _joi2.default.number().required(),
        'priority': _joi2.default.number().required(),
        'category': _joi2.default.string().required(),
        'description': _joi2.default.optional(),
        'rpValue': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.achievements.update
}, {
  'method': 'POST',
  'path': '/api/search/achievements',
  'config': {
    'tags': ['api'],
    'description': 'Return achievement search results',
    'notes': 'Return achievement search results',
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
  'handler': _handlers.achievements.search
}, {
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
        'id': _joi2.default.number().required()
      }
    }
  },
  'handler': _handlers.achievements.delete
}];