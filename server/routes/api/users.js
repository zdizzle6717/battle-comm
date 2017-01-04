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
                    password: Joi.string().min(8).required(),
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
                        password: Joi.string().min(8).required()

                    }),
                    Joi.object({
                        username: Joi.string().email().required(),
                        password: Joi.string().min(8).required()
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
        method: 'PUT',
        path: '/api/users/changePassword/{id}',
        config: {
            tags: ['api'],
            description: 'Update User Password from Account Dashboard',
            notes: 'Update User Password from Account Dashboard',
			auth: {
                strategy: 'jsonWebToken',
                scope: ['subscriber']
            },
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
					username: Joi.string().required(),
					password: Joi.string().min(8).required(),
					newPassword: Joi.string().required()
                }
            },
			pre: [{
				method: userFunctions.verifyCredentials
			}],
	        handler: users.changePassword
        }
    },
    {
        method: 'POST',
        path: '/api/users/resetPassword/',
        config: {
            tags: ['api'],
            description: 'Send E-mail to Reset Password',
            notes: 'Send E-mail to Reset Password',
            validate: {
                payload: {
					email: Joi.string().required()
                }
            },
			pre: [{
				method: userFunctions.verifyUserExists,
				assign: 'user'
			}],
	        handler: users.resetPassword
        }
    },
    {
        method: 'POST',
        path: '/api/users/verifyResetToken/{token}',
        config: {
            tags: ['api'],
            description: 'Verify Reset Token is Valid',
            notes: 'Verify Reset Token is Valid',
            validate: {
				params: {
                    token: Joi.string().required()
                }
            },
	        handler: users.verifyResetToken
        }
    },
    {
        method: 'POST',
        path: '/api/users/setNewPassword/{token}',
        config: {
            tags: ['api'],
            description: 'Update Password After Forgot E-mail Password Confirmation',
            notes: 'Update Password After Forgot E-mail Password Confirmation',
            validate: {
				params: {
                    token: Joi.string().required()
                },
				payload: {
					email: Joi.string().required(),
					password: Joi.string().min(8).required()
				}
            },
	        handler: users.setNewPassword
        }
    },
	{
        method: 'POST',
        path: '/api/search/users',
        config: {
            tags: ['api'],
            description: 'Return User/Player search results',
            notes: 'Return User/Player search results',
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
