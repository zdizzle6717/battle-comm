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

		models.User.find({
      'where': {
        'id': request.payload.UserId
      }
    }).then((user) => {
      if (user) {
        user.decrement({
					'rewardPoints': request.payload.orderTotal
				}).then((user) => {
					models.ProductOrder.create({
			        'status': request.payload.status,
			        'orderDetails': request.payload.orderDetails,
			        'productDetails': request.payload.productDetails,
			        'orderTotal': request.payload.orderTotal,
			        'UserId': request.payload.UserId,
			        'customerFullName': request.payload.customerFullName,
			        'customerEmail': request.payload.customerEmail,
			        'phone': request.payload.phone,
			        'shippingStreet': request.payload.shippingStreet,
			        'shippingApartment': request.payload.shippingApartment,
			        'shippingCity': request.payload.shippingCity,
			        'shippingState': request.payload.shippingState,
			        'shippingZip': request.payload.shippingZip,
			        'shippingCountry': request.payload.shippingCountry
			      })
			      .then((order) => {
							order = order.get({'plain': true});
			        let customerMailConfig = {
			          'from': env.email.user,
			          'to': order.customerEmail,
			          'subject': `Order Confirmation: Battle-Comm, Order #${order.id}`,
			          'html': buildOrderSuccessEmail(order) // You can choose to send an HTML body instead
			        };

			        let adminMailConfig = {
			          'from': env.email.user,
			          'to': env.email.user,
			          'subject': `New Order: #${order.id}, ${order.customerFullName}`,
			          'html': buildOrderSuccessEmail(order) // You can choose to send an HTML body instead
			        };

			        transporter.sendMail(customerMailConfig, (error, info) => {
			          if (error) {
			            console.log(error);
			            reply('Somthing went wrong');
			          } else {
			            transporter.sendMail(adminMailConfig);
			            reply(order).code(200);
			          }
			        });
			      });
				})
			} else {
				reply(Boom.notFound('User not found'));
			}
		});
  },
  update: (request, reply) => {
		let transporter = nodemailer.createTransport(({
      'service': 'Gmail',
      'auth': {
        'xoauth2': generator
      }
    }));

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
            'shippingApartment': request.payload.shippingApartment,
            'shippingCity': request.payload.shippingCity,
            'shippingState': request.payload.shippingState,
            'shippingZip': request.payload.shippingZip,
            'shippingCountry': request.payload.shippingCountry
          }).then((order) => {
						order = order.get({'plain': true});
		        let customerMailConfig = {
		          'from': env.email.user,
		          'to': order.customerEmail,
		          'subject': `Order Confirmation: Battle-Comm, Order #${order.id}`,
		          'html': buildOrderSuccessEmail(order) // You can choose to send an HTML body instead
		        };

		        let adminMailConfig = {
		          'from': env.email.user,
		          'to': env.email.user,
		          'subject': `Order Updated: #${order.id}, ${order.customerFullName}`,
		          'html': buildOrderSuccessEmail(order) // You can choose to send an HTML body instead
		        };

		        transporter.sendMail(adminMailConfig, (error, info) => {
		          if (error) {
		            console.log(error);
		            reply('Somthing went wrong');
		          } else {
								if (order.status === 'shipped') {
									transporter.sendMail(customerMailConfig);
								}
		            reply(order).code(200);
		          }
		        });
          });
        } else {
          reply().code(404);
        }
      });
  },
	'search': (request, reply) => {
    let searchByConfig;
    let pageSize = parseInt(request.payload.pageSize, 10) || 20;
    let searchQuery = request.payload.searchQuery || '';
    let offset = (request.payload.pageNumber - 1) * pageSize;
		let orderBy = request.payload.orderBy ? [request.payload.orderBy, 'DESC'] : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? {
        [request.payload.searchBy]: {
          '$iLike': '%' + searchQuery + '%'
        }
      } : {
        '$or': [{
            'customerFullName': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'customerEmail': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'shippingCity': {
              '$iLike': '%' + searchQuery + '%'
            }
          },
          {
            'shippingStreet': {
              '$iLike': '%' + searchQuery + '%'
            }
          }
        ]
      };
    } else {
      searchByConfig = {};
    }
    models.ProductOrder.findAndCountAll({
      'where': searchByConfig,
      'offset': offset,
      'limit': pageSize,
			'order': orderBy ? [orderBy] : []
    }).then((response) => {
      let count = response.count;
      let results = response.rows;
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
