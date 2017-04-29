'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// Product Route Configs
var gameSystems = {
  get: function get(request, reply) {
    _models2.default.GameSystem.find({
      'where': {
        'id': request.params.id
      },
      'include': [{
        'model': _models2.default.Manufacturer
      }, {
        'model': _models2.default.Faction
      }, {
        'model': _models2.default.File
      }]
    }).then(function (response) {
      if (response) {
        reply(response).code(200);
      } else {
        reply().code(404);
      }
    });
  },
  getAll: function getAll(request, reply) {
    _models2.default.GameSystem.findAll({
      'include': [{
        'model': _models2.default.Manufacturer
      }, {
        'model': _models2.default.Faction
      }],
      'order': [['name', 'ASC']]
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  create: function create(request, reply) {
    _models2.default.GameSystem.create({
      'ManufacturerId': request.payload.ManufacturerId,
      'name': request.payload.name,
      'description': request.payload.description,
      'url': request.payload.url
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  update: function update(request, reply) {
    _models2.default.GameSystem.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (newsPost) {
      if (newsPost) {
        newsPost.updateAttributes({
          'ManufacturerId': request.payload.ManufacturerId,
          'name': request.payload.name,
          'description': request.payload.description,
          'url': request.payload.url
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
    var pageSize = parseInt(request.payload.pageSize, 10) || 20;
    var searchQuery = request.payload.searchQuery || '';
    var offset = (request.payload.pageNumber - 1) * pageSize;
    var orderBy = request.payload.orderBy ? request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC'] : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? _defineProperty({}, request.payload.searchBy, {
        '$iLike': '%' + searchQuery + '%'
      }) : {
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
      searchByConfig = {};
    }
    _models2.default.GameSystem.findAndCountAll({
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
    _models2.default.GameSystem.destroy({
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

exports.default = gameSystems;