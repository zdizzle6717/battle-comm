'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// Faction Rankings
{
  'method': 'POST',
  'path': '/api/search/factionRankings/{id}',
  'config': {
    'handler': _handlers.factionRankings.search,
    'tags': ['api'],
    'description': 'Return ranking search results',
    'notes': 'Return ranking search results',
    'validate': {
      'params': {
        'id': _joi2.default.number().required()
      },
      'payload': {
        'orderBy': _joi2.default.optional(),
        'pageNumber': _joi2.default.number().required(),
        'pageSize': _joi2.default.optional()
      }
    }
  }
},

// Game System Rankings
{
  'method': 'POST',
  'path': '/api/gameSystemRankings',
  'config': {
    'handler': _handlers.gameSystemRankings.createOrUpdate,
    'tags': ['api'],
    'description': 'Create a new ranking with game system and faction',
    'notes': 'Create a new ranking with game system and faction',
    'auth': {
      'strategy': 'jsonWebToken',
      'scope': ['member', 'subscriber', 'eventAdminSubscriber', 'systemAdmin']
    },
    'validate': {
      'payload': {
        'UserId': _joi2.default.number().required(),
        'GameSystemId': _joi2.default.number().required(),
        'FactionId': _joi2.default.number().required(),
        'totalWins': _joi2.default.number().required(),
        'totalDraws': _joi2.default.number().required(),
        'totalLosses': _joi2.default.number().required()
      }
    }
  }
}, {
  'method': 'POST',
  'path': '/api/search/gameSystemRankings/{id}',
  'config': {
    'handler': _handlers.gameSystemRankings.search,
    'tags': ['api'],
    'description': 'Return ranking search results',
    'notes': 'Return ranking search results',
    'validate': {
      'params': {
        'id': _joi2.default.number().required()
      },
      'payload': {
        'orderBy': _joi2.default.optional(),
        'pageNumber': _joi2.default.number().required(),
        'pageSize': _joi2.default.optional()
      }
    }
  }
}];