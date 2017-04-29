'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// Product Route Configs
var products = {
  get: function get(request, reply) {
    _models2.default.Product.find({
      'where': {
        'id': request.params.id
      },
      'include': [{
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
    _models2.default.Product.findAll().then(function (response) {
      reply(response).code(200);
    });
  },
  create: function create(request, reply) {
    _models2.default.Product.create({
      'FactionId': request.payload.FactionId,
      'GameSystemId': request.payload.GameSystemId,
      'ManufacturerId': request.payload.ManufacturerId,
      'SKU': request.payload.SKU,
      'name': request.payload.name,
      'price': request.payload.price,
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
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  update: function update(request, reply) {
    _models2.default.Product.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (response) {
      if (response) {
        response.updateAttributes({
          'FactionId': request.payload.FactionId,
          'GameSystemId': request.payload.GameSystemId,
          'ManufacturerId': request.payload.ManufacturerId,
          'SKU': request.payload.SKU,
          'name': request.payload.name,
          'price': request.payload.price,
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
    if (request.payload.minPrice && request.payload.maxPrice) {
      searchByConfig.price = {
        '$between': [request.payload.minPrice, request.payload.maxPrice]
      };
    }
    _models2.default.Product.findAndCountAll({
      'where': searchByConfig,
      'order': orderBy ? [orderBy] : [],
      'offset': offset,
      'limit': pageSize,
      'include': {
        'model': _models2.default.File
      }
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
    _models2.default.Product.destroy({
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

exports.default = products;