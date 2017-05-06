'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _envVariables = require('../../../envVariables');

var _envVariables2 = _interopRequireDefault(_envVariables);

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

var _nodemailer = require('nodemailer');

var _nodemailer2 = _interopRequireDefault(_nodemailer);

var _orderSuccess = require('../../email-templates/orderSuccess');

var _orderSuccess2 = _interopRequireDefault(_orderSuccess);

var _xoauth = require('xoauth2');

var _xoauth2 = _interopRequireDefault(_xoauth);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var generator = _xoauth2.default.createXOAuth2Generator(_envVariables2.default.email.XOAuth2);

// listen for token updates
// you probably want to store these to a db
generator.on('token', function (token) {});

// Product Route Configs
var productOrders = {
  get: function get(request, reply) {
    _models2.default.ProductOrder.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (response) {
      if (response) {
        reply(response).code(200);
      } else {
        reply().code(404);
      }
    });
  },
  getAll: function getAll(request, reply) {
    _models2.default.ProductOrder.findAll().then(function (products) {
      reply(products).code(200);
    });
  },
  create: function create(request, reply) {
    var transporter = _nodemailer2.default.createTransport({
      'service': 'Gmail',
      'auth': {
        'xoauth2': generator
      }
    });

    _models2.default.User.find({
      'where': {
        'id': request.payload.UserId
      }
    }).then(function (user) {
      if (user) {
        user.decrement({
          'rewardPoints': request.payload.orderTotal
        }).then(function (user) {
          _models2.default.ProductOrder.create({
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
          }).then(function (order) {
            order = order.get({ 'plain': true });
            var customerMailConfig = {
              'from': _envVariables2.default.email.user,
              'to': order.customerEmail,
              'subject': 'Order Confirmation: Battle-Comm, Order #' + order.id,
              'html': (0, _orderSuccess2.default)(order) // You can choose to send an HTML body instead
            };

            var adminMailConfig = {
              'from': _envVariables2.default.email.user,
              'to': _envVariables2.default.email.user,
              'subject': 'New Order: #' + order.id + ', ' + order.customerFullName,
              'html': (0, _orderSuccess2.default)(order) // You can choose to send an HTML body instead
            };

            transporter.sendMail(customerMailConfig, function (error, info) {
              if (error) {
                console.log(error);
                reply('Somthing went wrong');
              } else {
                transporter.sendMail(adminMailConfig);
                reply(order).code(200);
              }
            });
          });
        });
      } else {
        reply(Boom.notFound('User not found'));
      }
    });
  },
  update: function update(request, reply) {
    var transporter = _nodemailer2.default.createTransport({
      'service': 'Gmail',
      'auth': {
        'xoauth2': generator
      }
    });

    _models2.default.ProductOrder.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (response) {
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
        }).then(function (order) {
          order = order.get({ 'plain': true });
          var customerMailConfig = {
            'from': _envVariables2.default.email.user,
            'to': order.customerEmail,
            'subject': 'Order Confirmation: Battle-Comm, Order #' + order.id,
            'html': (0, _orderSuccess2.default)(order) // You can choose to send an HTML body instead
          };

          var adminMailConfig = {
            'from': _envVariables2.default.email.user,
            'to': _envVariables2.default.email.user,
            'subject': 'Order Updated: #' + order.id + ', ' + order.customerFullName,
            'html': (0, _orderSuccess2.default)(order) // You can choose to send an HTML body instead
          };

          transporter.sendMail(adminMailConfig, function (error, info) {
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
  'search': function search(request, reply) {
    var searchByConfig = void 0;
    var pageSize = parseInt(request.payload.pageSize, 10) || 20;
    var searchQuery = request.payload.searchQuery || '';
    var offset = (request.payload.pageNumber - 1) * pageSize;
    var orderBy = request.payload.orderBy ? [request.payload.orderBy, 'DESC'] : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? _defineProperty({}, request.payload.searchBy, {
        '$iLike': '%' + searchQuery + '%'
      }) : {
        '$or': [{
          'customerFullName': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'customerEmail': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'shippingCity': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'shippingStreet': {
            '$iLike': '%' + searchQuery + '%'
          }
        }]
      };
    } else {
      searchByConfig = {};
    }
    _models2.default.ProductOrder.findAndCountAll({
      'where': searchByConfig,
      'offset': offset,
      'limit': pageSize,
      'order': orderBy ? [orderBy] : []
    }).then(function (response) {
      var count = response.count;
      var results = response.rows;
      var totalPages = Math.ceil(count === 0 ? 1 : count / pageSize);

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
  delete: function _delete(request, reply) {
    _models2.default.ProductOrder.destroy({
      'where': {
        'id': request.params.id
      }
    }).then(function (response) {
      if (response) {
        reply().code(200);
      } else {
        reply().code(404);
      }
    });
  }
};

exports.default = productOrders;