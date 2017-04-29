'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// Game Systems
{
  'method': 'POST',
  'path': '/api/factions',
  'config': {
    'tags': ['api'],
    'description': 'Add a new faction',
    'notes': 'Add a new faction',
    'auth': {
      'strategy': 'jsonWebToken',
      'scope': ['systemAdmin']
    },
    'validate': {
      'payload': {
        'GameSystemId': _joi2.default.number().required(),
        'name': _joi2.default.string().required()
      }
    }
  },
  'handler': _handlers.factions.create
}, {
  'method': 'PUT',
  'path': '/api/factions/{id}',
  'config': {
    'tags': ['api'],
    'description': 'Update a faction by id',
    'notes': 'Update a faction by id',
    'auth': {
      'strategy': 'jsonWebToken',
      'scope': ['systemAdmin']
    },
    'validate': {
      'params': {
        'id': _joi2.default.number().required()
      },
      'payload': {
        'GameSystemId': _joi2.default.number().required(),
        'name': _joi2.default.string().required()
      }
    }
  },
  'handler': _handlers.factions.update
}, {
  'method': 'DELETE',
  'path': '/api/factions/{id}',
  'config': {
    'tags': ['api'],
    'description': 'Delete a faction by id',
    'notes': 'Delete a faction by id',
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
  'handler': _handlers.factions.delete
}];