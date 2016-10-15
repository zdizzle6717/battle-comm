'use strict';

let users = require('../handlers/users');
let Joi = require('joi');
let models = require('../../models');
const userFunctions = require('../../utils/userFunctions');

module.exports = [
	// User Logins
	{
        method: 'POST',
        path: '/api/users',
        config: {
            pre: [{
                method: userFunctions.verifyUniqueUser
            }],
            handler: users.create,
            tags: ['api'],
            description: 'Register a new user',
            notes: 'Register a new user',
            validate: {
                payload: {
                    username: Joi.string().min(4).max(50).required(),
                    email: Joi.string().email().required(),
                    password: Joi.string().required(),
					firstName: Joi.string().optional(),
					lastName: Joi.string().optional()
                }
            }
        }
    },
	{
        method: 'POST',
        path: '/api/users/authenticate',
        config: {
            pre: [{
                method: userFunctions.verifyCredentials,
                assign: 'user'
            }],
            handler: users.authenticate,
            tags: ['api'],
            description: 'Authenticate an existing user',
            notes: 'Authenticate an existing user',
            validate: {
                payload: Joi.alternatives().try(
                    Joi.object({
                        username: Joi.string().min(4).max(50).required(),
                        password: Joi.string().required()

                    }),
                    Joi.object({
                        username: Joi.string().email().required(),
                        password: Joi.string().required()
                    })
                )
            }
        }
    },
	{
        method: 'GET',
        path: '/api/users/{id}',
        config: {
            tags: ['api'],
            description: 'Get one player by id',
            notes: 'Get one player by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: users.get
    },
    {
        method: 'GET',
        path: '/api/users',
        config: {
            tags: ['api'],
            description: 'Get all players',
            notes: 'Get all players'
        },
        handler: users.getAll
    },
    {
        method: 'PATCH',
        path: '/api/users/{id}',
        config: {
            tags: ['api'],
            description: 'Patch a User Login by id',
            notes: 'Patch a User Login by id',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
            },
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
					email: Joi.optional(),
                    rewardPoints: Joi.number(),
                    icon: Joi.optional(),
					firstName: Joi.optional(),
					lastName: Joi.optional(),
					bio: Joi.optional(),
					subscriber: Joi.optional(),
					tourneyAdmin: Joi.optional(),
					eventAdmin: Joi.optional(),
					newsContributor: Joi.optional(),
					venueAdmin: Joi.optional(),
					clubAdmin: Joi.optional(),
					systemAdmin: Joi.optional(),
					mainPhone: Joi.optional(),
					mobilePhone: Joi.optional(),
					streetAddress: Joi.optional(),
					aptSuite: Joi.optional(),
					city: Joi.optional(),
					state: Joi.optional(),
					zip: Joi.optional(),
					facebook: Joi.optional(),
					twitter: Joi.optional(),
					instagram: Joi.optional(),
					googlePlus: Joi.optional(),
					twitch: Joi.optional(),
					website: Joi.optional(),
					username: Joi.optional(),
					totalWins: Joi.optional(),
					totalLosses: Joi.optional(),
					totalDraws: Joi.optional(),
					totalPoints: Joi.optional(),
					eloRanking: Joi.optional()
                }
            }
        },
        handler: users.updatePartial
    },
	{
        method: 'POST',
        path: '/api/search/users',
        config: {
            tags: ['api'],
            description: 'Return User/Player search results',
            notes: 'Return User/Player search results',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber', 'tourneyAdmin', 'eventAdmin', 'venueAdmin', 'clubAdmin', 'systemAdmin']
            },
			validate: {
				payload: {
                    maxResults: Joi.number().optional(),
                    query: Joi.string().required()
				}
			}
        },
        handler: users.search
    }
];
