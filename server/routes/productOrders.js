'use strict';

let env = require('../config/environmentVariables');
let models = require('../models');
let nodemailer = require('nodemailer');
var generator = require('xoauth2').createXOAuth2Generator(env.email.XOAuth2);
let buildOrderSuccessEmail = require('../email-templates/orderSuccess');
// listen for token updates
// you probably want to store these to a db
generator.on('token', function(token){
});

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
		let transporter = nodemailer.createTransport(({
			service: 'Gmail',
			auth: {
				xoauth2: generator
			}
		}));

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
				let customerMailConfig = {
				    from: env.email.user,
				    to: response.customerEmail,
				    subject: `Order Confirmation: Battle-Comm, Order #${response.id}`,
				    html: buildOrderSuccessEmail(response) // You can choose to send an HTML body instead
				};

				let adminMailConfig = {
				    from: env.email.user,
				    to: env.email.user,
				    subject: `New Order: #${response.id}, ${response.customerFullName}`,
				    html: buildOrderSuccessEmail(response) // You can choose to send an HTML body instead
				};

				transporter.sendMail(customerMailConfig, function(error, info){
				    if(error){
				        console.log(error);
				        reply('Somthing went wrong');
				    } else{
						transporter.sendMail(adminMailConfig);
				        reply(response).code(200);
				    };
				});
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
