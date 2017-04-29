'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// Product Route Configs
var newsPosts = {
  get: function get(request, reply) {
    _models2.default.NewsPost.find({
      'where': {
        'id': request.params.id
      },
      'include': [{
        'model': _models2.default.User,
        'attributes': ['firstName', 'lastName']
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
    _models2.default.NewsPost.findAll({
      'include': [{
        'model': _models2.default.User,
        'attributes': ['firstName', 'lastName']
      }, {
        'model': _models2.default.File
      }]
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  create: function create(request, reply) {
    _models2.default.NewsPost.create({
      'UserId': request.payload.UserId,
      'GameSystemId': request.payload.GameSystemId,
      'ManufacturerId': request.payload.ManufacturerId,
      'FactionId': request.payload.FactionId,
      'title': request.payload.title,
      'callout': request.payload.callout,
      'body': request.payload.body,
      'published': request.payload.published,
      'featured': request.payload.featured,
      'tags': request.payload.tags,
      'manufacturerId': request.payload.manufacturerId,
      'gameSystemId': request.payload.gameSystemId,
      'category': request.payload.category
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  update: function update(request, reply) {
    _models2.default.NewsPost.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (newsPost) {
      if (newsPost) {
        newsPost.updateAttributes({
          'UserId': request.payload.UserId,
          'GameSystemId': request.payload.GameSystemId,
          'ManufacturerId': request.payload.ManufacturerId,
          'FactionId': request.payload.FactionId,
          'title': request.payload.title,
          'callout': request.payload.callout,
          'body': request.payload.body,
          'published': request.payload.published,
          'featured': request.payload.featured,
          'tags': request.payload.tags,
          'manufacturerId': request.payload.manufacturerId,
          'gameSystemId': request.payload.gameSystemId,
          'category': request.payload.category
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
    var orderBy = void 0;
    if (request.payload.orderBy === 'author') {
      orderBy = [_models2.default.User, 'lastName', 'DESC'];
    } else {
      orderBy = request.payload.orderBy ? request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC'] : undefined;
    }
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? _defineProperty({}, request.payload.searchBy, {
        '$iLike': '%' + searchQuery + '%'
      }) : {
        '$or': [{
          'title': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'tags': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'body': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'category': {
            '$iLike': '%' + searchQuery + '%'
          }
        }]
      };
    } else {
      searchByConfig = {};
    }
    if (request.payload.published) {
      searchByConfig.published = true;
    }
    _models2.default.NewsPost.findAndCountAll({
      'where': searchByConfig,
      'order': orderBy ? [orderBy] : [],
      'offset': offset,
      'limit': pageSize,
      'include': [{
        'model': _models2.default.User
      }, {
        'model': _models2.default.File
      }]
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
    _models2.default.NewsPost.destroy({
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

exports.default = newsPosts;