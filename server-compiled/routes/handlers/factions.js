'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _models = require('../../models');

var _models2 = _interopRequireDefault(_models);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

// Product Route Configs
var factions = {
  create: function create(request, reply) {
    _models2.default.Faction.create({
      'GameSystemId': request.payload.GameSystemId,
      'name': request.payload.name
    }).then(function (response) {
      reply(response).code(200);
    });
  },
  update: function update(request, reply) {
    _models2.default.Faction.find({
      'where': {
        'id': request.params.id
      }
    }).then(function (faction) {
      if (faction) {
        faction.updateAttributes({
          'name': request.payload.name
        }).then(function (response) {
          reply(response).code(200);
        });
      } else {
        reply().code(404);
      }
    });
  },
  delete: function _delete(request, reply) {
    _models2.default.Faction.destroy({
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

exports.default = factions;