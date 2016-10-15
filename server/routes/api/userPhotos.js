'use strict';

let userPhotos = require('../handlers/userPhotos');
let Joi = require('joi');
let models = require('../../models');

module.exports = [
	// User photos
	{
        method: 'POST',
        path: '/api/userPhotos',
        config: {
            handler: userPhotos.create,
            tags: ['api'],
            description: 'Create a new user photo',
            notes: 'Create a new user photo',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
            },
            validate: {
                payload: {
                    UserId: Joi.number().required(),
                    url: Joi.string().required(),
                }
            }
        }
    }
];
