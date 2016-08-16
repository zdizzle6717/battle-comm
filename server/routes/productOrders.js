'use strict';

let models = require('../models');

// Product Route Configs
let productOrders = {
    get: function(req, res) {
        models.ProductOrder.find({
                where: {
                    id: req.params.id
                }
            })
            .then(function(productOrder) {
                if (productOrder) {
                    res(productOrder).code(200);
                }
                else {
                    res().code(404);
                }

            });
    },
    getAll: function(req, res) {
        models.ProductOrder.findAll()
            .then(function(products) {
                res(products).code(200);
            });
    },
    create: function(req, res) {
        models.ProductOrder.create({
            status: req.payload.status,
            orderDetails: req.payload.orderDetails,
            orderTotal: req.payload.orderTotal,
            CustomerId: req.payload.CustomerId,
            customerFullName: req.payload.customerFullName,
            customerEmail: req.payload.customerFullEmail,
            phone: req.payload.phone,
            shippingStreet: req.payload.shippingStreet,
            shippingAppartment: req.payload.shippingAppartment,
            shippingCity: req.payload.shippingCity,
            shippingState: req.payload.shippingState,
            shippingZip: req.payload.shippingZip,
            shippingCountry: req.payload.shippingCountry
            })
            .then(function(productOrder) {
                res(productOrder).code(200);
            });
    },
    update: function(req, res) {
        models.ProductOrder.find({
                where: {
                    id: req.params.id
                }
            })
            .then(function(productOrder) {
                if (productOrder) {
                    productOrder.updateAttributes({
                        status: req.payload.status,
                        orderDetails: req.payload.orderDetails,
                        orderTotal: req.payload.orderTotal,
                        CustomerId: req.payload.CustomerId,
                        customerFullName: req.payload.customerFullName,
                        customerEmail: req.payload.customerFullEmail,
                        phone: req.payload.phone,
                        shippingStreet: req.payload.shippingStreet,
                        shippingAppartment: req.payload.shippingAppartment,
                        shippingCity: req.payload.shippingCity,
                        shippingState: req.payload.shippingState,
                        shippingZip: req.payload.shippingZip,
                        shippingCountry: req.payload.shippingCountry
                    }).then(function(productOrder) {
                        res(productOrder).code(200);
                    });
                }
                else {
                    res().code(404);
                }
            });
    },
    delete: function(req, res) {
        models.ProductOrder.destroy({
                where: {
                    id: req.params.id
                }
            })
            .then(function(productOrder) {
                if (productOrder) {
                    res().code(200);
                }
                else {
                    res().code(404);
                }
            });
    }
};


module.exports = productOrders;
