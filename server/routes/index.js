'use strict';

let api = require('./api');
let Joi = require('joi');
let models = require('../models');

module.exports = [


    // Base Route
    {
        method: 'GET',
        path: '/api',
        handler: function(req, res) {
            res({
                'api': 'Hello world!'
            });
        }
    },

    // Directors
    {
        config: {
            tags: ['api'],
            description: 'Get one product by id',
            notes: 'Get one product by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            },
            cors: {
                origin: ['*']
            }
        },
        method: 'GET',
        path: '/api/products/{id}',
        handler: api.products.get
    },
    {
        config: {
            tags: ['api'],
            description: 'Get all products',
            notes: 'Get all products',
            cors: {
                origin: ['*']
            }
        },
        method: 'GET',
        path: '/api/products',
        handler: api.products.getAll
    },
    {
        config: {
            tags: ['api'],
            description: 'Add a new product',
            notes: 'Add a new product',
            validate: {
                payload: {
                    firstName: Joi.string().required(),
                    SKU: Joi.string().required(),
                    name: Joi.string().required(),
                    price: Joi.string().required(),
                    description: Joi.string().required(),
                    manufacturerId: Joi.string().required(),
                    gameSystem: Joi.string().required(),
                    color: Joi.string(),
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
                    imgTwoFront: Joi.string(),
                    imgTwoBack: Joi.string(),
                    imgThreeFront: Joi.string(),
                    imgThreeBack: Joi.string(),
                    imgFourFront: Joi.string(),
                    imgFourBack: Joi.string()
                }
            },
            cors: {
                origin: ['*']
            }
        },
        method: 'POST',
        path: '/api/products',
        handler: api.products.create
    },
    {
        config: {
            tags: ['api'],
            description: 'Update a product by id',
            notes: 'Update a product by id',
            validate: {
                params: {
                    id: Joi.number().required()
                },
                payload: {
                    firstName: Joi.string().required(),
                    SKU: Joi.string().required(),
                    name: Joi.string().required(),
                    price: Joi.string().required(),
                    description: Joi.string().required(),
                    manufacturerId: Joi.string().required(),
                    gameSystem: Joi.string().required(),
                    color: Joi.string(),
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
                    imgTwoFront: Joi.string(),
                    imgTwoBack: Joi.string(),
                    imgThreeFront: Joi.string(),
                    imgThreeBack: Joi.string(),
                    imgFourFront: Joi.string(),
                    imgFourBack: Joi.string()
                }
            },
            cors: {
                origin: ['*']
            }
        },
        method: 'PUT',
        path: '/api/products/{id}',
        handler: api.products.update
    },
    {
        config: {
            tags: ['api'],
            description: 'Delete a product by id',
            notes: 'Delete a product by id',
            validate: {
                params: {
                    id: Joi.number().required()
                }
            },
            cors: {
                origin: ['*']
            }
        },
        method: 'DELETE',
        path: '/api/products/{id}',
        handler: api.products.delete
    }

];
