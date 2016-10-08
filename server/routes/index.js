'use strict';

let users = require('./users');
let userNotifications = require('./userNotifications');
let userPhotos = require('./userPhotos');
let friends = require('./friends');

let files = require('./files');
let products = require('./products');
let productOrders = require('./productOrders');
let newsPosts = require('./newsPosts');
let venues = require('./venues')
let Joi = require('joi');
let models = require('../models');
const userFunctions = require('../utils/userFunctions');

module.exports = [

    // Base Route
    {
        method: 'GET',
        path: '/api/test',
        handler: function(req, res) {
            res({
                'api': 'Hello world!'
            });
        }
    },

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
			validate: {
				payload: {
                    maxResults: Joi.number().optional(),
                    query: Joi.string().required()
				}
			}
        },
        handler: users.search
    },

	// User Notifications
    {
        method: 'POST',
        path: '/api/userNotifications',
        config: {
            tags: ['api'],
            description: 'Add a new userNotification',
            notes: 'Add a new userNotification',
            validate: {
                payload: {
                    UserId: Joi.number().required(),
                    type: Joi.string().required(),
                    status: Joi.string(),
                    fromId: Joi.number().required(),
                    fromUsername: Joi.string().required(),
                    fromName: Joi.string().required()
                }
            }
        },
        handler: userNotifications.create
    },
    {
        method: 'PUT',
        path: '/api/userNotifications/{id}',
        config: {
            tags: ['api'],
            description: 'Update a user notification by id',
            notes: 'Update a user notification by id',
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
					UserId: Joi.number().required(),
                    type: Joi.string().required(),
                    status: Joi.string().required(),
                    fromId: Joi.number().required(),
                    fromName: Joi.string().required()
                }
            }
        },
        handler: userNotifications.update
    },
    {
        method: 'DELETE',
        path: '/api/userNotifications/{id}',
        config: {
            tags: ['api'],
            description: 'Delete a user notification by id',
            notes: 'Delete a user notification by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: userNotifications.delete
    },

	// User photos
	{
        method: 'POST',
        path: '/api/friends',
        config: {
            handler: friends.create,
            tags: ['api'],
            description: 'Create a new user friend',
            notes: 'Create a new user friend',
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
            validate: {
                payload: {
                    UserId: Joi.number().required(),
                    InviteeId: Joi.number().required(),
                }
            }
        }
    },

	// User photos
	{
        method: 'POST',
        path: '/api/userPhotos',
        config: {
            handler: userPhotos.create,
            tags: ['api'],
            description: 'Create a new user photo',
            notes: 'Create a new user photo',
            validate: {
                payload: {
                    UserId: Joi.number().required(),
                    url: Joi.string().required(),
                }
            }
        }
    },


    // File Upload
    {
        method: 'POST',
        path: '/api/files/{path*}',
        config: {
            payload: {
                output: 'stream',
                maxBytes: 209715200,
                parse: true,
                allow: 'multipart/form-data'
            },
            tags: ['api'],
            description: 'Upload a new file',
            notes: 'Upload a new file',
        },
        handler: files.create
    },

    // Products
    {
        method: 'GET',
        path: '/api/products/{id}',
        config: {
            tags: ['api'],
            description: 'Get one product by id',
            notes: 'Get one product by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: products.get
    },
    {
        method: 'GET',
        path: '/api/products',
        config: {
            tags: ['api'],
            description: 'Get all products',
            notes: 'Get all products'
        },
        handler: products.getAll
    },
    {
        method: 'POST',
        path: '/api/products',
        config: {
            tags: ['api'],
            description: 'Add a new product',
            notes: 'Add a new product',
            validate: {
                payload: {
                    SKU: Joi.string().required(),
                    name: Joi.string().required(),
                    price: Joi.number().required(),
                    description: Joi.string().required(),
                    manufacturerId: Joi.string().required(),
                    gameSystem: Joi.string().required(),
                    color: Joi.optional(),
                    tags: Joi.string(),
                    category: Joi.string(),
                    stockQty: Joi.number().required(),
                    inStock: Joi.boolean().required(),
                    filterVal: Joi.string().required(),
                    displayStatus: Joi.boolean().required(),
                    featured: Joi.boolean().required(),
                    new: Joi.boolean().required(),
                    onSale: Joi.boolean().required(),
                    imgAlt: Joi.string().required(),
                    imgOneFront: Joi.string().required(),
                    imgOneBack: Joi.string().required(),
                    imgTwoFront: Joi.optional(),
                    imgTwoBack: Joi.optional(),
                    imgThreeFront: Joi.optional(),
                    imgThreeBack: Joi.optional(),
                    imgFourFront: Joi.optional(),
                    imgFourBack: Joi.optional()
                }
            }
        },
        handler: products.create
    },
    {
        method: 'PUT',
        path: '/api/products/{id}',
        config: {
            tags: ['api'],
            description: 'Update a product by id',
            notes: 'Update a product by id',
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
                    SKU: Joi.string().required(),
                    name: Joi.string().required(),
                    price: Joi.number().required(),
                    description: Joi.string().required(),
                    manufacturerId: Joi.string().required(),
                    gameSystem: Joi.string().required(),
                    color: Joi.optional(),
                    tags: Joi.string(),
                    category: Joi.string(),
                    stockQty: Joi.number().required(),
                    inStock: Joi.boolean().required(),
                    filterVal: Joi.string().required(),
                    displayStatus: Joi.boolean().required(),
                    featured: Joi.boolean().required(),
                    new: Joi.boolean().required(),
                    onSale: Joi.boolean().required(),
                    imgAlt: Joi.string().required(),
                    imgOneFront: Joi.string().required(),
                    imgOneBack: Joi.string().required(),
                    imgTwoFront: Joi.optional(),
                    imgTwoBack: Joi.optional(),
                    imgThreeFront: Joi.optional(),
                    imgThreeBack: Joi.optional(),
                    imgFourFront: Joi.optional(),
                    imgFourBack: Joi.optional()
                }
            }
        },
        handler: products.update
    },
    {
        method: 'DELETE',
        path: '/api/products/{id}',
        config: {
            tags: ['api'],
            description: 'Delete a product by id',
            notes: 'Delete a product by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: products.delete
    },


    // Product Orders
    {
        method: 'GET',
        path: '/api/productOrders/{id}',
        config: {
            tags: ['api'],
            description: 'Get one productOrder by id',
            notes: 'Get one productOrder by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: productOrders.get
    },
    {
        method: 'GET',
        path: '/api/productOrders',
        config: {
            tags: ['api'],
            description: 'Get all productOrders',
            notes: 'Get all productOrders'
        },
        handler: productOrders.getAll
    },
    {
        method: 'POST',
        path: '/api/productOrders',
        config: {
            tags: ['api'],
            description: 'Add a new productOrder',
            notes: 'Add a new productOrder',
            validate: {
                payload: {
                    status: Joi.string().required(),
                    orderDetails: Joi.string().required(),
                    orderTotal: Joi.number().required(),
                    UserId: Joi.number().required(),
                    customerFullName: Joi.string().required(),
                    customerEmail: Joi.string().email().required(),
                    phone: Joi.optional(),
                    shippingStreet: Joi.string().required(),
                    shippingAppartment: Joi.optional(),
                    shippingCity: Joi.string().required(),
                    shippingState: Joi.string().required(),
                    shippingZip: Joi.string().required(),
                    shippingCountry: Joi.string().required()
                }
            }
        },
        handler: productOrders.create
    },
    {
        method: 'PUT',
        path: '/api/productOrders/{id}',
        config: {
            tags: ['api'],
            description: 'Update a productOrder by id',
            notes: 'Update a productOrder by id',
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
                    status: Joi.string().required(),
                    orderDetails: Joi.string().required(),
                    orderTotal: Joi.number().required(),
                    UserId: Joi.number().required(),
                    customerFullName: Joi.string().required(),
                    customerEmail: Joi.string().email().required(),
                    phone: Joi.optional(),
                    shippingStreet: Joi.string().required(),
                    shippingAppartment: Joi.optional(),
                    shippingCity: Joi.string().required(),
                    shippingState: Joi.string().required(),
                    shippingZip: Joi.string().required(),
                    shippingCountry: Joi.string().required()
                }
            }
        },
        handler: productOrders.update
    },
    {
        method: 'DELETE',
        path: '/api/productOrders/{id}',
        config: {
            tags: ['api'],
            description: 'Delete a productOrder by id',
            notes: 'Delete a productOrder by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: productOrders.delete
    },


    // News Posts
    {
        method: 'GET',
        path: '/api/newsPosts/{id}',
        config: {
            tags: ['api'],
            description: 'Get one newsPost by id',
            notes: 'Get one newsPost by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: newsPosts.get
    },
    {
        method: 'GET',
        path: '/api/newsPosts',
        config: {
            tags: ['api'],
            description: 'Get all newsPosts',
            notes: 'Get all newsPosts'
        },
        handler: newsPosts.getAll
    },
    {
        method: 'POST',
        path: '/api/newsPosts',
        config: {
            tags: ['api'],
            description: 'Add a new newsPost',
            notes: 'Add a new newsPost',
            validate: {
                payload: {
                    UserId: Joi.number().required(),
                    title: Joi.string().required(),
                    image: Joi.string().required(),
                    callout: Joi.string().required(),
                    body: Joi.string().required(),
                    published: Joi.boolean().required(),
                    featured: Joi.boolean().required(),
                    tags: Joi.optional(),
                    manufacturerId: Joi.optional(),
                    gameSystem: Joi.optional(),
                    category: Joi.string().required()
                }
            }
        },
        handler: newsPosts.create
    },
    {
        method: 'PUT',
        path: '/api/newsPosts/{id}',
        config: {
            tags: ['api'],
            description: 'Update a newsPost by id',
            notes: 'Update a newsPost by id',
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
                    UserId: Joi.number().required(),
                    title: Joi.string().required(),
                    image: Joi.string().required(),
                    callout: Joi.string().required(),
                    body: Joi.string().required(),
                    published: Joi.boolean().required(),
                    featured: Joi.boolean().required(),
                    tags: Joi.optional(),
                    manufacturerId: Joi.optional(),
                    gameSystem: Joi.optional(),
                    category: Joi.string().required()
                }
            }
        },
        handler: newsPosts.update
    },
    {
        method: 'DELETE',
        path: '/api/newsPosts/{id}',
        config: {
            tags: ['api'],
            description: 'Delete a newsPost by id',
            notes: 'Delete a newsPost by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            }
        },
        handler: newsPosts.delete
    },

	// Venues
	{
        method: 'POST',
        path: '/api/venues/assignPoints',
        config: {
            tags: ['api'],
            description: 'Add new points assignment',
            notes: 'Add new points assignment by e-mail',
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
    },

];
