'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// Files
{
  'method': 'POST',
  'path': '/api/userPhotos',
  'handler': _handlers.userPhotos.create,
  'config': {
    'tags': ['api'],
    'description': 'Add file details',
    'notes': 'Add file details',
    'validate': {
      'payload': {
        'UserId': _joi2.default.optional(),
        'identifier': _joi2.default.string().required(),
        'locationUrl': _joi2.default.optional(),
        'label': _joi2.default.optional(),
        'name': _joi2.default.string().required(),
        'size': _joi2.default.number().required(),
        'type': _joi2.default.string().required()
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
}, {
  'method': 'PUT',
  'path': '/api/userPhotos/{id}',
  'handler': _handlers.userPhotos.update,
  'config': {
    'tags': ['api'],
    'description': 'Update file details',
    'notes': 'Update file details',
    'validate': {
      'params': {
        'id': _joi2.default.number().required()
      },
      'payload': {
        'UserId': _joi2.default.optional(),
        'identifier': _joi2.default.string().required(),
        'locationUrl': _joi2.default.optional(),
        'label': _joi2.default.optional(),
        'name': _joi2.default.string().required(),
        'size': _joi2.default.number().required(),
        'type': _joi2.default.string().required()
      }
    },
    'cors': {
      'origin': ['*']
    }
  }
}, {
  'method': 'DELETE',
  'path': '/api/userPhotos/{id}',
  'handler': _handlers.userPhotos.delete,
  'config': {
    'tags': ['api'],
    'description': 'Delete a user photo by id',
    'notes': 'Delete a user photo by id',
    'validate': {
      'params': {
        'id': _joi2.default.number().required()
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
}];