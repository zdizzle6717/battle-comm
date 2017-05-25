'use strict';

import Joi from 'joi';
import { factionRankings } from '../handlers';
import { gameSystemRankings } from '../handlers';


module.exports = [
  // Faction Rankings
  {
    'method': 'POST',
    'path': '/api/search/factionRankings/{id}',
    'config': {
      'handler': factionRankings.search,
      'tags': ['api'],
      'description': 'Return ranking search results',
      'notes': 'Return ranking search results',
      'validate': {
				'params': {
					'id': Joi.number().required()
				},
        'payload': {
					'orderBy': Joi.optional(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    }
  },

  // Game System Rankings
  {
    'method': 'POST',
    'path': '/api/gameSystemRankings',
    'config': {
      'handler': gameSystemRankings.createOrUpdate,
      'tags': ['api'],
      'description': 'Create a new ranking with game system and faction',
      'notes': 'Create a new ranking with game system and faction',
      'auth': {
        'strategy': 'jsonWebToken',
        'scope': ['member', 'subscriber', 'eventAdminSubscriber', 'systemAdmin']
      },
      'validate': {
        'payload': {
          'UserId': Joi.number().required(),
          'GameSystemId': Joi.number().required(),
          'FactionId': Joi.number().required(),
          'totalWins': Joi.number().required(),
          'totalDraws': Joi.number().required(),
          'totalLosses': Joi.number().required()
        }
      }
    }
  },
  {
    'method': 'POST',
    'path': '/api/search/gameSystemRankings/{id}',
    'config': {
      'handler': gameSystemRankings.search,
      'tags': ['api'],
      'description': 'Return ranking search results',
      'notes': 'Return ranking search results',
      'validate': {
				'params': {
					'id': Joi.number().required()
				},
        'payload': {
					'orderBy': Joi.optional(),
					'pageNumber': Joi.number().required(),
					'pageSize': Joi.optional()
        }
      }
    }
  }
];
