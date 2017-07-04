'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// Achievement Route Configs
var achievements = {
  secret: function secret(request, reply) {
    _models2.default.File.findAll().then(function (allFiles) {
      allFiles.forEach(function (file) {
        console.log(file.locationUrl);
        if (file.locationUrl.indexOf('/uploads') === -1) {
          if (file.locationUrl[0] === '/') {
            file.updateAttributes({
              'locationUrl': '/uploads' + file.locationUrl
            });
          } else {
            file.updateAttributes({
              'locationUrl': '/uploads/' + file.locationUrl
            });
          }
        }
      });
      _models2.default.UserPhoto.findAll().then(function (allUserPhotos) {
        allUserPhotos.forEach(function (photo) {
          console.log(photo.locationUrl);
          if (photo.locationUrl.indexOf('/uploads') === -1) {
            if (photo.locationUrl[0] === '/') {
              photo.updateAttributes({
                'locationUrl': '/uploads' + photo.locationUrl
              });
            } else {
              photo.updateAttributes({
                'locationUrl': '/uploads/' + photo.locationUrl
              });
            }
          }
        });
        reply(allFiles, allUserPhotos).code(200);
      });
    });
  },
  get: function get(request, reply) {
    _models2.default.Achievement.find({
      'where': {
        'id': request.params.id
      },
      'include': [{
        'model': _models2.default.File
      }, {
        'model': _models2.default.User,
        'attributes': ['id', 'username']
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
    _models2.default.Achievement.findAll({
      'include': [{
        'model': _models2.default.File
      }],
      'order': [['priority', 'DESC']]
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  create: function create(request, reply) {
    _models2.default.Achievement.create({
      'title': request.payload.title,
      'category': request.payload.category,
      'description': request.payload.description,
      'priority': request.payload.priority || 100,
      'rpValue': request.payload.rpValue || 0
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  update: function update(request, reply) {
    _models2.default.Achievement.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (achievement) {
      if (achievement) {
        achievement.updateAttributes({
          'title': request.payload.title,
          'category': request.payload.category,
          'description': request.payload.description,
          'priority': request.payload.priority,
          'rpValue': request.payload.rpValue
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
    var orderBy = request.payload.orderBy ? request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC'] : ['priority', 'DESC'];
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? _defineProperty({}, request.payload.searchBy, {
        '$iLike': '%' + searchQuery + '%'
      }) : {
        '$or': [{
          'title': {
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
    _models2.default.Achievement.findAndCountAll({
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
    _models2.default.Achievement.destroy({
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

exports.default = achievements;