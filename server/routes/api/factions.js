'use strict';

let Joi = require('joi');
let models = require('../../models');
let factions = require('../handlers/factions');

module.exports = [
	// Game Systems
    {
        method: 'POST',
        path: '/api/factions',
        config: {
            tags: ['api'],
            description: 'Add a new faction',
            notes: 'Add a new faction',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['systemAdmin']
            },
            validate: {
                payload: {
                    GameSystemId: Joi.number().required(),
                    name: Joi.string().required()
                }
            }
        },
        handler: factions.create
    },
    {
        method: 'PUT',
        path: '/api/factions/{id}',
        config: {
            tags: ['api'],
            description: 'Update a faction by id',
            notes: 'Update a faction by id',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['systemAdmin']
            },
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
					GameSystemId: Joi.number().required(),
                    name: Joi.string().required()
                }
            }
        },
        handler: factions.update
    },
    {
        method: 'DELETE',
        path: '/api/factions/{id}',
        config: {
            tags: ['api'],
            description: 'Delete a faction by id',
            notes: 'Delete a faction by id',
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
        handler: factions.delete
    }
];
