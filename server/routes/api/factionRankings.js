'use strict';

let factionRankings = require('../handlers/factionRankings');
let Joi = require('joi');
let models = require('../../models');

module.exports = [
	// Faction Rankings
	{
        method: 'POST',
        path: '/api/search/factionRankings',
        config: {
			handler: factionRankings.search,
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
                    FactionId: Joi.number().required()
				}
			}
        }
    }
];
