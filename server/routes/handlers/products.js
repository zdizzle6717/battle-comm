'use strict';

import models from '../../models';
import Boom from 'boom';

// Product Route Configs
let products = {
    get: (request, reply) => {
        models.Product.find({
                'where': {
                    'id': request.params.id
                },
                'include': [{
                    'model': models.File
                }]
            })
            .then((response) => {
                if (response) {
                    reply(response).code(200);
                } else {
                    reply().code(404);
                }
            });
    },
    getAll: (request, reply) => {
        models.Product.findAll()
            .then((response) => {
                reply(response).code(200);
            });
    },
    create: (request, reply) => {
        models.Product.create({
                'FactionId': request.payload.FactionId,
                'GameSystemId': request.payload.GameSystemId,
                'ManufacturerId': request.payload.ManufacturerId,
                'SKU': request.payload.SKU,
                'name': request.payload.name,
                'price': request.payload.price,
                'shippingCost': request.payload.shippingCost,
                'description': request.payload.description,
                'manufacturerId': request.payload.manufacturerId,
                'gameSystem': request.payload.gameSystem,
                'color': request.payload.color,
                'tags': request.payload.tags,
                'category': request.payload.category,
                'stockQty': request.payload.stockQty,
                'isInStock': request.payload.isInStock,
                'filterVal': request.payload.filterVal,
                'isDisplayed': request.payload.isDisplayed,
                'isFeatured': request.payload.isFeatured,
                'isNew': request.payload.isNew,
                'isOnSale': request.payload.isOnSale
            })
            .then((response) => {
                reply(response).code(200);
            });
    },
    update: (request, reply) => {
        models.Product.find({
                'where': {
                    'id': request.params.id
                }
            })
            .then((response) => {
                if (response) {
                    response.updateAttributes({
                        'FactionId': request.payload.FactionId,
                        'GameSystemId': request.payload.GameSystemId,
                        'ManufacturerId': request.payload.ManufacturerId,
                        'SKU': request.payload.SKU,
                        'name': request.payload.name,
                        'price': request.payload.price,
                        'shippingCost': request.payload.shippingCost,
                        'description': request.payload.description,
                        'manufacturerId': request.payload.manufacturerId,
                        'gameSystem': request.payload.gameSystem,
                        'color': request.payload.color,
                        'tags': request.payload.tags,
                        'category': request.payload.category,
                        'stockQty': request.payload.stockQty,
                        'isInStock': request.payload.isInStock,
                        'filterVal': request.payload.filterVal,
                        'isDisplayed': request.payload.isDisplayed,
                        'isFeatured': request.payload.isFeatured,
                        'isNew': request.payload.isNew,
                        'isOnSale': request.payload.isOnSale
                    }).then((response) => {
                        reply(response).code(200);
                    });
                } else {
                    reply().code(404);
                }
            });
    },
    updateStock: (request, reply) => {
        let products = request.payload.products;
        let findConfig = {
            '$or': []
        };
        products.forEach((product) => {
            findConfig['$or'].push({
                'id': product.id
            });
        });
        let promises = [];
        models.Product.findAll({
            'where': findConfig
        }).then((matchingProducts) => {
            if (request.payload.direction === 'increment') {
                matchingProducts.forEach((matchingProduct) => {
                    let qtyValue = products.find((product) => matchingProduct.id === product.id).qty;
                    promises.push(matchingProduct.increment({
                        'stockQty': qtyValue
                    }));
                });
                Promise.all(promises).then((updatedProducts) => {
                    reply(updatedProducts).code(200);
                });
            } else {
                let failResponse = [];
                let outOfStockCount = 0;
                matchingProducts.forEach((matchingProduct) => {
                    let outOfStock = matchingProduct.stockQty - products.find((product) => matchingProduct.id === product.id).qty < 0;
                    outOfStockCount += outOfStock ? 1 : 0;
                    failResponse.push({
                        'id': matchingProduct.id,
                        'outOfStock': outOfStock
                    });
                });
                if (outOfStockCount === 0) {
                    matchingProducts.forEach((matchingProduct) => {
                        let qtyValue = products.find((product) => matchingProduct.id === product.id).qty;
                        promises.push(matchingProduct.decrement({
                            'stockQty': qtyValue
                        }));
                    });
                    Promise.all(promises).then((updatedProducts) => {
                        reply({
                            'success': true,
                            'products': updatedProducts
                        }).code(200);
                    })
                } else {
                    reply({
                        'success': false,
                        'products': failResponse
                    });
                }
            }
        });
    },
    search: (request, reply) => {
        let searchByConfig;
        let pageSize = parseInt(request.payload.pageSize, 10) || 20;
        let searchQuery = request.payload.searchQuery || '';
        let offset = (request.payload.pageNumber - 1) * pageSize;
        let orderBy = request.payload.orderBy ? (request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC']) : undefined;
        if (searchQuery) {
            searchByConfig = request.payload.searchBy ? {
                [request.payload.searchBy]: {
                    '$iLike': '%' + searchQuery + '%'
                }
            } : {
                '$or': [{
                        'name': {
                            '$iLike': '%' + searchQuery + '%'
                        }
                    },
                    {
                        'description': {
                            '$iLike': '%' + searchQuery + '%'
                        }
                    }
                ]
            };
        } else {
            searchByConfig = {};
        }
        if (request.payload.minPrice >= 0 && request.payload.maxPrice) {
            searchByConfig.price = {
                '$between': [request.payload.minPrice, request.payload.maxPrice]
            };
        }
        if (request.payload.manufacturerId) {
            searchByConfig.ManufacturerId = request.payload.manufacturerId;
        }
        if (request.payload.gameSystemId) {
            searchByConfig.GameSystemId = request.payload.gameSystemId;
        }
        if (request.payload.storeView) {
            searchByConfig['$and'] = [{
                'stockQty': {
                    '$gt': 0
                }
            }, {
                'isDisplayed': true
            }]
        }
        models.Product.findAll({
            'where': searchByConfig,
            'order': orderBy ? [orderBy] : [],
            'offset': offset,
            'limit': pageSize,
            'include': {
                'model': models.File
            }
        }).then((response) => {
            let results = response;

            models.Product.findAll({
                'where': searchByConfig
            }).then((products) => {
                let count = products.length;
                let totalPages = Math.ceil(count === 0 ? 1 : (count / pageSize));

                reply({
                    'pagination': {
                        'pageNumber': request.payload.pageNumber,
                        'pageSize': pageSize,
                        'totalPages': totalPages,
                        'totalResults': count
                    },
                    'results': results
                }).code(200);
            });

        });
    },
    delete: (request, reply) => {
        models.Product.destroy({
                'where': {
                    'id': request.params.id
                }
            })
            .then((response) => {
                if (response) {
                    reply().code(200);
                } else {
                    reply().code(404);
                }
            });
    }
};


export default products;
