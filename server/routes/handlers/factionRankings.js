'use strict';

import models from '../../models';

// Product Route Configs
let factionRankings = {
  search: (request, reply) => {
    models.FactionRanking.findAll({
        'where': {
          '$and': [{
            'FactionId': request.payload.FactionId
          }]
        },
        'include': [{
            'model': models.Faction,
            'attributes': ['name']
          },
          {
            'model': models.GameSystemRanking,
            'attributes': ['UserId'],
            'include': [{
                'model': models.GameSystem,
                'attributes': ['name', 'id']
              },
              {
                'model': models.User,
                'attributes': ['username']
              }
            ]
          }
        ],
        'limit': request.payload.maxResults || 20,
        'order': [
          ['totalWins', 'DESC']
        ]
      })
      .then((rankings) => {
        reply(rankings).code(200);
      });
  }
};

export default factionRankings;
