'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// Venues
{
  'method': 'POST',
  'path': '/api/venues/assignPoints',
  'config': {
    'tags': ['api'],
    'description': 'Add new points assignment',
    'notes': 'Add new points assignment by e-mail',
    'auth': {
      'strategy': 'jsonWebToken',
      'scope': ['member', 'subscriber', 'tourneyAdmin', 'eventAdmin', 'eventAdminSubscriber', 'venueAdmin', 'clubAdmin', 'systemAdmin']
    },
    'validate': {
      'payload': {
        'venueEvent': {
          'adminUsername': _joi2.default.string().required(),
          'venueName': _joi2.default.string().required(),
          'eventName': _joi2.default.string().required(),
          'venueAdmin': _joi2.default.string().required(),
          'eventDate': _joi2.default.string().required(),
          'returnEmail': _joi2.default.string().required()
        },
        'players': _joi2.default.array().items(_joi2.default.object({
          'fullName': _joi2.default.string().required(),
          'email': _joi2.default.string().required(),
          'pointsEarned': _joi2.default.number().required(),
          'gameSystem': _joi2.default.string().required(),
          'faction': _joi2.default.optional(),
          'totalWins': _joi2.default.number().optional(),
          'totalDraws': _joi2.default.number().optional(),
          'totalLosses': _joi2.default.number().optional(),
          'achievementsList': _joi2.default.optional()
        }))
      }
    }
  },
  handler: _handlers.venues.create
}];