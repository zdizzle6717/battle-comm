'use strict';

let userRankings = require('../handlers/userRankings');
let Joi = require('joi');
let models = require('../../models');

module.exports = [
	// User Rankings
	{
        method: 'POST',
        path: '/api/userRankings',
        config: {
            handler: userRankings.createOrUpdate,
            tags: ['api'],
            description: 'Create a new user ranking',
            notes: 'Create a new user ranking',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'systemAdmin']
            },
            validate: {
                payload: {
					UserId: Joi.number().required(),
					GameSystemId: Joi.number().required(),
					FactionId: Joi.number().required(),
                    totalWins: Joi.number().required(),
                    totalDraws: Joi.number().required(),
                    totalLosses: Joi.number().required()
                }
            }
        }
    },
	{
        method: 'POST',
        path: '/api/search/userRankings',
        config: {
			handler: userRankings.search,
            tags: ['api'],
            description: 'Return ranking search results',
            notes: 'Return ranking search results',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
            },
			validate: {
				payload: {
                    maxResults: Joi.number().optional(),
                    GameSystemId: Joi.number().required(),
                    FactionId: Joi.number().required()
				}
			}
        }
    }
];
