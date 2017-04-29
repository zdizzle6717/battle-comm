'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

var _boom = require('boom');

var _boom2 = _interopRequireDefault(_boom);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// Product Route Configs
var userNotifications = {
  get: function get(request, reply) {
    _models2.default.UserNotification.find({
      'where': {
        'UserId': request.params.id
      }
    }).then(function (response) {
      if (response) {
        reply(response).code(200);
      } else {
        reply().code(404);
      }
    });
  },
  create: function create(request, reply) {
    _models2.default.UserNotification.findOrCreate({
      'where': {
        '$and': [{
          'UserId': request.payload.UserId
        }, {
          'type': request.payload.type
        }, {
          'fromId': request.payload.fromId
        }]
      },
      'defaults': {
        'UserId': request.payload.UserId,
        'type': request.payload.type,
        'status': request.payload.status,
        'fromId': request.payload.fromId,
        'fromUsername': request.payload.fromUsername,
        'fromName': request.payload.fromName
      }
    }).then(function (response) {
      var created = response[1];
      if (created) {
        reply(response).code(200);
      } else {
        reply(_boom2.default.badRequest('Request already sent'));
      }
    });
  },
  update: function update(request, reply) {
    _models2.default.UserNotification.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (userNotification) {
      if (userNotification) {
        userNotification.updateAttributes({
          'UserId': request.payload.UserId,
          'type': request.payload.type,
          'status': request.payload.status
        }).then(function (response) {
          reply(response).code(200);
        });
      } else {
        reply().code(404);
      }
    });
  },
  'search': function search(request, reply) {
    var searchByConfig = void 0;
    var pageSize = request.payload.pageSize || 20;
    var searchQuery = request.payload.searchQuery || '';
    var offset = (request.payload.pageNumber - 1) * pageSize;
    var orderBy = request.payload.orderBy ? request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC'] : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? _defineProperty({
        'UserId': request.payload.UserId
      }, request.payload.searchBy, {
        '$iLike': '%' + searchQuery + '%'
      }) : {
        'UserId': request.payload.UserId,
        '$or': [{
          'name': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'description': {
            '$iLike': '%' + searchQuery + '%'
          }
        }]
      };
    } else {
      searchByConfig = {
        'UserId': request.payload.UserId
      };
    }
    _models2.default.UserNotification.findAndCountAll({
      'where': searchByConfig,
      'order': orderBy ? [orderBy] : [],
      'offset': offset,
      'limit': pageSize
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
    _models2.default.UserNotification.destroy({
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

exports.default = userNotifications;