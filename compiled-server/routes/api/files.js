'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// Files
{
  'method': 'POST',
  'path': '/api/files',
  'handler': _handlers.files.create,
  'config': {
    'tags': ['api'],
    'description': 'Add file details',
    'notes': 'Add file details',
    'validate': {
      'payload': {
        'BannerSlideId': _joi2.default.optional(),
        'GameSystemId': _joi2.default.optional(),
        'ManufacturerId': _joi2.default.optional(),
        'NewsPostId': _joi2.default.optional(),
        'ProductId': _joi2.default.optional(),
        'UserId': _joi2.default.optional(),
        'UserAchievementId': _joi2.default.optional(),
        'identifier': _joi2.default.string().valid('playerIcon', 'photoStream', 'newsPostPhoto', 'gameSystemPhoto', 'manufacturerPhoto', 'productPhoto', 'productPhotoFront', 'productPhotoBack', 'bannerImage').required(),
        'locationUrl': _joi2.default.string().required(),
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
  'path': '/api/files/{id}',
  'handler': _handlers.files.update,
  'config': {
    'tags': ['api'],
    'description': 'Update file details',
    'notes': 'Update file details',
    'validate': {
      'params': {
        'id': _joi2.default.number().required()
      },
      'payload': {
        'BannerSlideId': _joi2.default.optional(),
        'GameSystemId': _joi2.default.optional(),
        'ManufacturerId': _joi2.default.optional(),
        'NewsPostId': _joi2.default.optional(),
        'ProductId': _joi2.default.optional(),
        'UserId': _joi2.default.optional(),
        'UserAchievementId': _joi2.default.optional(),
        'identifier': _joi2.default.string().valid('playerIcon', 'photoStream', 'newsPostPhoto', 'gameSystemPhoto', 'manufacturerPhoto', 'productPhoto', 'productPhotoFront', 'productPhotoBack', 'bannerImage').required(),
        'locationUrl': _joi2.default.string().required(),
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
  'method': 'POST',
  'path': '/api/files/add',
  'handler': _handlers.files.add,
  'config': {
    'payload': {
      'output': 'stream',
      'maxBytes': 209715200,
      'parse': true,
      'allow': 'multipart/form-data'
    },
    'tags': ['api'],
    'description': 'Upload a new file',
    'notes': 'Upload a new file',
    'auth': {
      'strategy': 'jsonWebToken',
      'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
    },
    'cors': {
      'origin': ['*']
    }
  }
}, {
  'method': 'GET',
  'path': '/api/files',
  'handler': _handlers.files.getAll,
  'config': {
    'tags': ['api'],
    'description': 'Get all files',
    'notes': 'Get all files',
    'cors': {
      'origin': ['*']
    }
  }
}, {
  'method': 'DELETE',
  'path': '/api/files/{id}',
  'handler': _handlers.files.delete,
  'config': {
    'tags': ['api'],
    'description': 'Delete a file by id',
    'notes': 'Delete a file by id',
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