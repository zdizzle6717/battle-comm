'use strict';

let gameSystemRankings = require('../handlers/gameSystemRankings');
let Joi = require('joi');
let models = require('../../models');

module.exports = [
	// Game System Rankings
	{
        method: 'POST',
        path: '/api/gameSystemRankings',
        config: {
            handler: gameSystemRankings.createOrUpdate,
            tags: ['api'],
            description: 'Create a new ranking with game system and faction',
            notes: 'Create a new ranking with game system and faction',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['member', 'subscriber', 'systemAdmin']
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
        path: '/api/search/gameSystemRankings',
        config: {
			handler: gameSystemRankings.search,
            tags: ['api'],
            description: 'Return ranking search results',
            notes: 'Return ranking search results',
			validate: {
				payload: {
                    maxResults: Joi.number().optional(),
                    GameSystemId: Joi.number().required()
				}
			}
        }
    }
];
