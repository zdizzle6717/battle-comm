'use strict';

import models from '../../models';
import Boom from 'boom';

// Product Route Configs
let gameSystemRankings = {
  createOrUpdate: (request, reply) => {
    models.GameSystemRanking.findOrCreate({
      'where': {
        '$and': [{
            'GameSystemId': request.payload.GameSystemId
          },
          {
            'UserId': request.payload.UserId
          }
        ]
      },
      'defaults': {
        'UserId': request.payload.UserId,
        'GameSystemId': request.payload.GameSystemId,
        'totalWins': request.payload.totalWins,
        'totalDraws': request.payload.totalDraws,
        'totalLosses': request.payload.totalLosses
      }
    }).spread((gameSystemRanking, created) => {
      if (created) {
        models.FactionRanking.findOrCreate({
          'where': {
            '$and': [{
                'FactionId': request.payload.FactionId
              },
              {
                'GameSystemRankingId': gameSystemRanking.id
              }
            ]
          },
          'defaults': {
            'FactionId': request.payload.FactionId,
            'GameSystemRankingId': gameSystemRanking.id,
            'totalWins': request.payload.totalWins,
            'totalDraws': request.payload.totalDraws,
            'totalLosses': request.payload.totalLosses
          }
        }).spread((factionRanking, created) => {
          if (created) {
            reply(factionRanking).code(200);
          } else {
            factionRanking.increment({
              'totalWins': request.payload.totalWins,
              'totalDraws': request.payload.totalDraws,
              'totalLosses': request.payload.totalLosses
            }).then((response) => {
              reply(response).code(200);
            });
          }
        });
      } else {
        gameSystemRanking.increment({
            'totalWins': request.payload.totalWins,
            'totalDraws': request.payload.totalDraws,
            'totalLosses': request.payload.totalLosses
          })
          .then((gameSystemRanking) => {
            models.FactionRanking.findOrCreate({
              'where': {
                '$and': [{
                    'FactionId': request.payload.FactionId
                  },
                  {
                    'GameSystemRankingId': gameSystemRanking.id
                  }
                ]
              },
              'defaults': {
                'FactionId': request.payload.FactionId,
                'GameSystemRankingId': gameSystemRanking.id,
                'totalWins': request.payload.totalWins,
                'totalDraws': request.payload.totalDraws,
                'totalLosses': request.payload.totalLosses
              }
            }).spread((factionRanking, created) => {
              if (created) {
                reply(factionRanking).code(200);
              } else {
                factionRanking.increment({
                  'totalWins': request.payload.totalWins,
                  'totalDraws': request.payload.totalDraws,
                  'totalLosses': request.payload.totalLosses
                }).then((response) => {
                  reply(response).code(200);
                });
              }
            });
          });
      }
    }).catch((err) => {
      throw Boom.badRequest(err);
    });
  },
  search: (request, reply) => {
    models.GameSystemRanking.findAll({
        'where': {
          '$and': [{
            'GameSystemId': request.payload.GameSystemId
          }]
        },
        'include': [{
            'model': models.User,
            'attributes': ['username', 'id']
          },
          {
            'model': models.GameSystem,
            'attributes': ['name']
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

export default gameSystemRankings;
