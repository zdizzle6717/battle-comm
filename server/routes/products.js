'use strict';

let models = require('../models');

// Product Route Configs
let products = {
    get: function(req, res) {
        models.Product.find({
                where: {
                    id: req.params.id
                }
            })
            .then(function(product) {
                if (product) {
                    res(product).code(200);
                }
                else {
                    res().code(404);
                }

            });
    },
    getAll: function(req, res) {
        models.Product.findAll()
            .then(function(products) {
                res(products).code(200);
            });
    },
    create: function(req, res) {
        models.Product.create({
            SKU: req.payload.SKU,
            name: req.payload.name,
            price: req.payload.price,
            description: req.payload.description,
            manufacturerId: req.payload.manufacturerId,
            gameSystem: req.payload.gameSystem,
            color: req.payload.color,
            tags: req.payload.tags,
            category: req.payload.category,
            stockQty: req.payload.stockQty,
            inStock: req.payload.inStock,
            filterVal: req.payload.filterVal,
            displayStatus: req.payload.displayStatus,
            featured: req.payload.featured,
            new: req.payload.new,
            onSale: req.payload.onSale,
            imgAlt: req.payload.imgAlt,
            imgOneFront: req.payload.imgOneFront,
            imgOneBack: req.payload.imgOneBack,
            imgTwoFront: req.payload.imgTwoFront,
            imgTwoBack: req.payload.imgTwoBack,
            imgThreeFront: req.payload.imgThreeFront,
            imgThreeBack: req.payload.imgThreeBack,
            imgFourFront: req.payload.imgFourFront,
            imgFourBack: req.payload.imgFourBack
            })
            .then(function(product) {
                res(product).code(200);
            });
    },
    update: function(req, res) {
        models.Product.find({
                where: {
                    id: req.params.id
                }
            })
            .then(function(product) {
                if (product) {
                    product.updateAttributes({
                        SKU: req.payload.SKU,
                        name: req.payload.name,
                        price: req.payload.price,
                        description: req.payload.description,
                        manufacturerId: req.payload.manufacturerId,
                        gameSystem: req.payload.gameSystem,
                        color: req.payload.color,
                        tags: req.payload.tags,
                        category: req.payload.category,
                        stockQty: req.payload.stockQty,
                        inStock: req.payload.inStock,
                        filterVal: req.payload.filterVal,
                        displayStatus: req.payload.displayStatus,
                        featured: req.payload.featured,
                        new: req.payload.new,
                        onSale: req.payload.onSale,
                        imgAlt: req.payload.imgAlt,
                        imgOneFront: req.payload.imgOneFront,
                        imgOneBack: req.payload.imgOneBack,
                        imgTwoFront: req.payload.imgTwoFront,
                        imgTwoBack: req.payload.imgTwoBack,
                        imgThreeFront: req.payload.imgThreeFront,
                        imgThreeBack: req.payload.imgThreeBack,
                        imgFourFront: req.payload.imgFourFront,
                        imgFourBack: req.payload.imgFourBack
                    }).then(function(product) {
                        res(product).code(200);
                    });
                }
                else {
                    res().code(404);
                }
            });
    },
    delete: function(req, res) {
        models.Product.destroy({
                where: {
                    id: req.params.id
                }
            })
            .then(function(product) {
                if (product) {
                    res().code(200);
                }
                else {
                    res().code(404);
                }
            });
    }
};


module.exports = products;
