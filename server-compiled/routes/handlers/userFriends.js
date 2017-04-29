'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

// Product Route Configs
var userFriends = {
  create: function create(request, reply) {
    _models2.default.User.find({
      'where': {
        'id': request.payload.UserId
      }
    }).then(function (user1) {
      _models2.default.User.find({
        'where': {
          'id': request.payload.InviteeId
        }
      }).then(function (user2) {
        user1.addFriend(user2).then(function (user1Response) {
          user2.addFriend(user1).then(function (user2Response) {
            reply(user1Response).code(200);
          });
        });
      }).catch(function (response) {
        reply(response).code(404);
      });
    }).catch(function (response) {
      reply(response).code(404);
    });
  },
  remove: function remove(request, reply) {
    _models2.default.User.find({
      'where': {
        'id': request.params.UserId
      }
    }).then(function (user1) {
      _models2.default.User.find({
        'where': {
          'id': request.params.InviteeId
        }
      }).then(function (user2) {
        user1.removeFriend(user2).then(function (user1Response) {
          user2.removeFriend(user1).then(function (user2Response) {
            reply(user1Response).code(200);
          });
        });
      }).catch(function (response) {
        reply(response).code(404);
      });
    }).catch(function (response) {
      reply(response).code(404);
    });
  },
  'search': function search(request, reply) {
    var searchByConfig = void 0;
    var pageSize = parseInt(request.payload.pageSize, 10) || 20;
    var searchQuery = request.payload.searchQuery || '';
    var offset = (request.payload.pageNumber - 1) * pageSize;
    var orderBy = request.payload.orderBy ? request.payload.orderBy === 'updatedAt' || request.payload.orderBy === 'createdAt' ? [request.payload.orderBy, 'DESC'] : [request.payload.orderBy, 'ASC'] : undefined;
    if (searchQuery) {
      searchByConfig = request.payload.searchBy ? _defineProperty({
        'UserId': request.params.UserId
      }, request.payload.searchBy, {
        '$iLike': '%' + searchQuery + '%'
      }) : {
        'UserId': request.params.UserId,
        '$or': [{
          'username': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'email': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'firstName': {
            '$iLike': '%' + searchQuery + '%'
          }
        }, {
          'lastName': {
            '$iLike': '%' + searchQuery + '%'
          }
        }]
      };
    } else {
      searchByConfig = {};
    }
    // TODO: Make sure this search actually works and searches the join table "userHasFriends"
    _models2.default.Friend.findAndCountAll({
      'where': searchByConfig,
      'order': orderBy ? [orderBy] : [],
      'offset': offset,
      'limit': request.payload.pageSize,
      'include': [{
        'model': _models2.default.UserPhoto
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
  }
};

exports.default = userFriends;