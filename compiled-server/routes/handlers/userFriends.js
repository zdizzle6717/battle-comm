'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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
    var pageSize = parseInt(request.payload.pageSize, 10) || 20;
    var offset = (request.payload.pageNumber - 1) * pageSize;

    _models2.default.User.find({
      'where': {
        'username': request.payload.username
      },
      'include': [{
        'model': _models2.default.User,
        'as': 'Friends',
        'attributes': ['id', 'firstName', 'lastName', 'username']
      }]
    }).then(function (user) {
      user = user.get({
        'plain': true
      });
      var results = user.Friends;
      var totalPages = Math.ceil(results.length === 0 ? 1 : results.length / pageSize);
      reply({
        'pagination': {
          'pageNumber': request.payload.pageNumber,
          'pageSize': pageSize,
          'totalPages': totalPages,
          'totalResults': results.length
        },
        'results': user.Friends.splice(offset, offset + pageSize)
      }).code(200);
    });
  }
};

exports.default = userFriends;