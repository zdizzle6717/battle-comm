'use strict';

import Joi from 'joi';
import { files } from '../handlers';

module.exports = [
  // Files
  {
    'method': 'POST',
    'path': '/api/files',
    'handler': files.create,
    'config': {
      'tags': ['api'],
      'description': 'Add file details',
      'notes': 'Add file details',
      'validate': {
        'payload': {
          'BannerSlideId': Joi.optional(),
          'GameSystemId': Joi.optional(),
          'ManufacturerId': Joi.optional(),
          'NewsPostId': Joi.optional(),
          'ProductId': Joi.optional(),
          'UserId': Joi.optional(),
          'UserAchievementId': Joi.optional(),
          'identifier': Joi.string().valid('achievement', 'playerIcon', 'photoStream', 'newsPostPhoto', 'gameSystemPhoto', 'manufacturerPhoto', 'productPhoto', 'productPhotoFront', 'productPhotoBack', 'bannerImage').required(),
          'locationUrl': Joi.string().required(),
          'label': Joi.optional(),
          'name': Joi.string().required(),
          'size': Joi.number().required(),
          'type': Joi.string().required()
        }
      },
			'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'cors': {
        'origin': ['*']
      }
    }
  },
  {
    'method': 'PUT',
    'path': '/api/files/{id}',
    'handler': files.update,
    'config': {
      'tags': ['api'],
      'description': 'Update file details',
      'notes': 'Update file details',
      'validate': {
        'params': {
          'id': Joi.number().required()
        },
        'payload': {
					'BannerSlideId': Joi.optional(),
					'GameSystemId': Joi.optional(),
          'ManufacturerId': Joi.optional(),
          'NewsPostId': Joi.optional(),
          'ProductId': Joi.optional(),
          'UserId': Joi.optional(),
          'UserAchievementId': Joi.optional(),
          'identifier': Joi.string().valid('achievement', 'playerIcon', 'photoStream', 'newsPostPhoto', 'gameSystemPhoto', 'manufacturerPhoto', 'productPhoto', 'productPhotoFront', 'productPhotoBack', 'bannerImage').required(),
          'locationUrl': Joi.string().required(),
          'label': Joi.optional(),
          'name': Joi.string().required(),
          'size': Joi.number().required(),
          'type': Joi.string().required()
        }
      },
			'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'cors': {
        'origin': ['*']
      }
    }
  },
  {
    'method': 'POST',
    'path': '/api/files/add',
    'handler': files.add,
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
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'cors': {
        'origin': ['*']
      }
    }
  },
  {
    'method': 'GET',
    'path': '/api/files',
    'handler': files.getAll,
    'config': {
      'tags': ['api'],
      'description': 'Get all files',
      'notes': 'Get all files',
      'cors': {
        'origin': ['*']
      }
    }
  },
  {
    'method': 'DELETE',
    'path': '/api/files/{id}',
    'handler': files.delete,
    'config': {
      'tags': ['api'],
      'description': 'Delete a file by id',
      'notes': 'Delete a file by id',
      'validate': {
        'params': {
          'id': Joi.number().required()
        }
      },
			'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
      },
      'cors': {
        'origin': ['*']
      }
    }
  }
];
