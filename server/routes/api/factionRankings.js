'use strict';

import factionRankings from '../handlers/factionRankings';
import Joi from 'joi';
import models from '../../models';

module.exports = [
  // Faction Rankings
  {
    'method': 'POST',
    'path': '/api/search/factionRankings',
    'config': {
      'handler': factionRankings.search,
      'tags': ['api'],
      'description': 'Return ranking search results',
      'notes': 'Return ranking search results',
      'validate': {
        'payload': {
          'maxResults': Joi.number().optional(),
          'FactionId': Joi.number().required()
        }
      }
    }
  }
];
