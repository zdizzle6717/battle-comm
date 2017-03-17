'use strict';

import env from '../../../envVariables';
import models from '../../models';
import nodemailer from 'nodemailer';
import buildOrderSuccessEmail from '../../email-templates/orderSuccess';
import xoauth2 from 'xoauth2';

let generator = xoauth2.createXOAuth2Generator(env.email.XOAuth2);

// listen for token updates
// you probably want to store these to a db
generator.on('token', (token) => {});

// Product Route Configs
let productOrders = {
  get: (request, reply) => {
    models.ProductOrder.find({
        'where': {
          'id': request.params.id
        }
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
    models.ProductOrder.findAll()
      .then((products) => {
        reply(products).code(200);
      });
  },
  create: (request, reply) => {
    let transporter = nodemailer.createTransport(({
      'service': 'Gmail',
      'auth': {
        'xoauth2': generator
      }
    }));

    models.ProductOrder.create({
        'status': request.payload.status,
        'orderDetails': request.payload.orderDetails,
        'orderTotal': request.payload.orderTotal,
        'UserId': request.payload.UserId,
        'customerFullName': request.payload.customerFullName,
        'customerEmail': request.payload.customerEmail,
        'phone': request.payload.phone,
        'shippingStreet': request.payload.shippingStreet,
        'shippingAppartment': request.payload.shippingAppartment,
        'shippingCity': request.payload.shippingCity,
        'shippingState': request.payload.shippingState,
        'shippingZip': request.payload.shippingZip,
        'shippingCountry': request.payload.shippingCountry
      })
      .then((response) => {
        let customerMailConfig = {
          'from': env.email.user,
          'to': response.customerEmail,
          'subject': `Order Confirmation: Battle-Comm, Order #${response.id}`,
          'html': buildOrderSuccessEmail(response) // You can choose to send an HTML body instead
        };

        let adminMailConfig = {
          'from': env.email.user,
          'to': env.email.user,
          'subject': `New Order: #${response.id}, ${response.customerFullName}`,
          'html': buildOrderSuccessEmail(response) // You can choose to send an HTML body instead
        };

        transporter.sendMail(customerMailConfig, (error, info) => {
          if (error) {
            console.log(error);
            reply('Somthing went wrong');
          } else {
            transporter.sendMail(adminMailConfig);
            reply(response).code(200);
          }
        });
      });
  },
  update: (request, reply) => {
    models.ProductOrder.find({
        'where': {
          'id': request.params.id
        }
      })
      .then((response) => {
        if (response) {
          response.updateAttributes({
            'status': request.payload.status,
            'orderDetails': request.payload.orderDetails,
            'orderTotal': request.payload.orderTotal,
            'UserId': request.payload.UserId,
            'customerFullName': request.payload.customerFullName,
            'customerEmail': request.payload.customerEmail,
            'phone': request.payload.phone,
            'shippingStreet': request.payload.shippingStreet,
            'shippingAppartment': request.payload.shippingAppartment,
            'shippingCity': request.payload.shippingCity,
            'shippingState': request.payload.shippingState,
            'shippingZip': request.payload.shippingZip,
            'shippingCountry': request.payload.shippingCountry
          }).then((response) => {
            reply(response).code(200);
          });
        } else {
          reply().code(404);
        }
      });
  },
  delete: (request, reply) => {
    models.ProductOrder.destroy({
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


export default productOrders;
