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
            handler: userRankings.create,
            tags: ['api'],
            description: 'Create a new user ranking',
            notes: 'Create a new user ranking',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'systemAdmin']
            },
            validate: {
                payload: {
					GameSystem: Joi.object({
							  searchKey: Joi.string().required(),
						  }),
                    totalWins: Joi.number().required(),
                    totalDraws: Joi.number().required(),
                    totalLosses: Joi.number().required(),
                }
            }
        }
    }
];
