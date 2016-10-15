'use strict';

let friends = require('../handlers/userFriends');
let Joi = require('joi');
let models = require('../../models');


module.exports = [
	// User Friends
	{
		method: 'POST',
		path: '/api/friends',
		config: {
			handler: friends.create,
			tags: ['api'],
			description: 'Create a new user friend',
			notes: 'Create a new user friend',
			auth: {
				strategy: 'jsonWebToken',
				scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			validate: {
				payload: {
					UserId: Joi.number().required(),
					InviteeId: Joi.number().required(),
				}
			}
		}
	},
	{
		method: 'DELETE',
		path: '/api/friends',
		config: {
			handler: friends.remove,
			tags: ['api'],
			description: 'Remove a friend association',
			notes: 'Remove a friend association',
			auth: {
				strategy: 'jsonWebToken',
				scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
			},
			validate: {
				payload: {
					UserId: Joi.number().required(),
					InviteeId: Joi.number().required(),
				}
			}
		}
	}
];
