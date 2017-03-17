'use strict';

import files from '../handlers/files';
import Joi from 'joi';

module.exports = [
  // File Upload
  {
    'method': 'POST',
    'path': '/api/files/{path*}',
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
    },
    'handler': files.create
  }
];
