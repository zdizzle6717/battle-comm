'use strict';

let files = require('./files');
let products = require('./products');
let productOrders = require('./productOrders');
let newsPosts = require('./newsPosts');
let userLogins = require('./userLogins');
let Joi = require('joi');
let models = require('../models');

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

    // File Upload
    {
        method: 'POST',
        path: '/api/files',
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
                    userLoginId: Joi.number().required(),
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
                    userLoginId: Joi.number().required(),
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
                    userLoginId: Joi.number().required(),
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
                    userLoginId: Joi.number().required(),
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


    // User Logins
    {
        method: 'PATCH',
        path: '/api/userLogins/{id}',
        config: {
            tags: ['api'],
            description: 'Patch a User Login by id',
            notes: 'Patch a User Login by id',
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
                    user_points: Joi.number().required(),
                }
            }
        },
        handler: userLogins.updatePartial
    },

];
