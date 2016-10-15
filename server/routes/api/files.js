'use strict';

let files = require('../handlers/files');
let Joi = require('joi');
let models = require('../../models');

module.exports = [
	// File Upload
    {
        method: 'POST',
        path: '/api/files/{path*}',
        config: {
            payload: {
                output: 'stream',
                maxBytes: 209715200,
                parse: true,
                allow: 'multipart/form-data'
            },
            tags: ['api'],
            description: 'Upload a new file',
            notes: 'Upload a new file',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
            },
        },
        handler: files.create
    }
];
