'use strict';

let models = require('../models');

// Product Route Configs
let productOrders = {
    get: function(request, reply) {
        models.ProductOrder.find({
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
        models.ProductOrder.findAll()
            .then(function(products) {
                reply(products).code(200);
            });
    },
    create: function(request, reply) {
        models.ProductOrder.create({
            status: request.payload.status,
            orderDetails: request.payload.orderDetails,
            orderTotal: request.payload.orderTotal,
            userLoginId: request.payload.userLoginId,
            customerFullName: request.payload.customerFullName,
            customerEmail: request.payload.customerEmail,
            phone: request.payload.phone,
            shippingStreet: request.payload.shippingStreet,
            shippingAppartment: request.payload.shippingAppartment,
            shippingCity: request.payload.shippingCity,
            shippingState: request.payload.shippingState,
            shippingZip: request.payload.shippingZip,
            shippingCountry: request.payload.shippingCountry
            })
            .then(function(response) {
                reply(response).code(200);
            });
    },
    update: function(request, reply) {
        models.ProductOrder.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(response) {
                if (response) {
                    response.updateAttributes({
                        status: request.payload.status,
                        orderDetails: request.payload.orderDetails,
                        orderTotal: request.payload.orderTotal,
                        userLoginId: request.payload.userLoginId,
                        customerFullName: request.payload.customerFullName,
                        customerEmail: request.payload.customerEmail,
                        phone: request.payload.phone,
                        shippingStreet: request.payload.shippingStreet,
                        shippingAppartment: request.payload.shippingAppartment,
                        shippingCity: request.payload.shippingCity,
                        shippingState: request.payload.shippingState,
                        shippingZip: request.payload.shippingZip,
                        shippingCountry: request.payload.shippingCountry
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
        models.ProductOrder.destroy({
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


module.exports = productOrders;
