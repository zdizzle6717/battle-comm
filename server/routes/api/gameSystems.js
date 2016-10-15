'use strict';

let Joi = require('joi');
let models = require('../../models');
let gameSystems = require('../handlers/gameSystems');

module.exports = [
	// Game Systems
    {
        method: 'GET',
        path: '/api/gameSystems/{id}',
        config: {
            tags: ['api'],
            description: 'Get one game system by id',
            notes: 'Get one game system by id',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
            },
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: gameSystems.get
    },
    {
        method: 'GET',
        path: '/api/gameSystems',
        config: {
            tags: ['api'],
            description: 'Get all gameSystems',
            notes: 'Get all gameSystems',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
            },
        },
        handler: gameSystems.getAll
    },
    {
        method: 'POST',
        path: '/api/gameSystems',
        config: {
            tags: ['api'],
            description: 'Add a new game system',
            notes: 'Add a new game system',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['systemAdmin']
            },
            validate: {
                payload: {
                    ManufacturerId: Joi.number().required(),
                    description: Joi.string().required(),
                    searchKey: Joi.string().required(),
                    photo: Joi.string().required(),
                    url: Joi.string().required()
                }
            }
        },
        handler: gameSystems.create
    },
    {
        method: 'PUT',
        path: '/api/gameSystems/{id}',
        config: {
            tags: ['api'],
            description: 'Update a game system by id',
            notes: 'Update a game system by id',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['systemAdmin']
            },
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
					ManufacturerId: Joi.number().required(),
                    description: Joi.string().required(),
                    searchKey: Joi.string().required(),
                    photo: Joi.string().required(),
                    url: Joi.string().required()
                }
            }
        },
        handler: gameSystems.update
    },
    {
        method: 'DELETE',
        path: '/api/gameSystems/{id}',
        config: {
            tags: ['api'],
            description: 'Delete a game system by id',
            notes: 'Delete a game system by id',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['systemAdmin']
            },
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: gameSystems.delete
    }
];