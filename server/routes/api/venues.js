'use strict';

let venues = require('../handlers/venues');
let Joi = require('joi');
let models = require('../../models');

module.exports = [
	// Venues
	{
		method: 'POST',
		path: '/api/venues/assignPoints',
		config: {
			tags: ['api'],
			description: 'Add new points assignment',
			notes: 'Add new points assignment by e-mail',
			auth: {
				strategy: 'jsonWebToken',
				scope: ['tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			validate: {
				payload: {
					venueEvent: {
						venueName: Joi.string().required(),
						eventName: Joi.string().required(),
						venueAdmin: Joi.string().required(),
						eventDate: Joi.string().required(),
						returnEmail: Joi.string().required(),
					},
					players: Joi.array().items(Joi.object({
							  fullName: Joi.string().required(),
							  email: Joi.string().required(),
							  pointsEarned: Joi.number().required(),
							  totalWins: Joi.number().optional(),
							  totalDraws: Joi.number().optional(),
							  totalLosses: Joi.number().optional(),
							}))
				}
			}
		},
		handler: venues.create
	}
];
