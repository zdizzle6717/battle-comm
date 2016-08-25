'use strict';

let models = require('../models');

// Product Route Configs
let products = {
    get: function(request, reply) {
        models.Product.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(response) {
                if (response) {
                    reply(response).code(200);
                }
                else {
                    reply().code(404);
                }

            });
    },
    getAll: function(request, reply) {
        models.Product.findAll()
            .then(function(response) {
                reply(response).code(200);
            });
    },
    create: function(request, reply) {
        models.Product.create({
            SKU: request.payload.SKU,
            name: request.payload.name,
            price: request.payload.price,
            description: request.payload.description,
            manufacturerId: request.payload.manufacturerId,
            gameSystem: request.payload.gameSystem,
            color: request.payload.color,
            tags: request.payload.tags,
            category: request.payload.category,
            stockQty: request.payload.stockQty,
            inStock: request.payload.inStock,
            filterVal: request.payload.filterVal,
            displayStatus: request.payload.displayStatus,
            featured: request.payload.featured,
            new: request.payload.new,
            onSale: request.payload.onSale,
            imgAlt: request.payload.imgAlt,
            imgOneFront: request.payload.imgOneFront,
            imgOneBack: request.payload.imgOneBack,
            imgTwoFront: request.payload.imgTwoFront,
            imgTwoBack: request.payload.imgTwoBack,
            imgThreeFront: request.payload.imgThreeFront,
            imgThreeBack: request.payload.imgThreeBack,
            imgFourFront: request.payload.imgFourFront,
            imgFourBack: request.payload.imgFourBack
            })
            .then(function(response) {
                reply(response).code(200);
            });
    },
    update: function(request, reply) {
        models.Product.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(response) {
                if (response) {
                    response.updateAttributes({
                        SKU: request.payload.SKU,
                        name: request.payload.name,
                        price: request.payload.price,
                        description: request.payload.description,
                        manufacturerId: request.payload.manufacturerId,
                        gameSystem: request.payload.gameSystem,
                        color: request.payload.color,
                        tags: request.payload.tags,
                        category: request.payload.category,
                        stockQty: request.payload.stockQty,
                        inStock: request.payload.inStock,
                        filterVal: request.payload.filterVal,
                        displayStatus: request.payload.displayStatus,
                        featured: request.payload.featured,
                        new: request.payload.new,
                        onSale: request.payload.onSale,
                        imgAlt: request.payload.imgAlt,
                        imgOneFront: request.payload.imgOneFront,
                        imgOneBack: request.payload.imgOneBack,
                        imgTwoFront: request.payload.imgTwoFront,
                        imgTwoBack: request.payload.imgTwoBack,
                        imgThreeFront: request.payload.imgThreeFront,
                        imgThreeBack: request.payload.imgThreeBack,
                        imgFourFront: request.payload.imgFourFront,
                        imgFourBack: request.payload.imgFourBack
                    }).then(function(response) {
                        reply(response).code(200);
                    });
                }
                else {
                    reply().code(404);
                }
            });
    },
    delete: function(request, reply) {
        models.Product.destroy({
                where: {
                    id: request.params.id
                }
            })
            .then(function(response) {
                if (response) {
                    reply().code(200);
                }
                else {
                    reply().code(404);
                }
            });
    }
};


module.exports = products;
