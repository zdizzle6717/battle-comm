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
		let pageSize = request.payload.pageSize || 20;
    let offset = (request.payload.pageNumber - 1) * pageSize;

    models.GameSystemRanking.findAndCountAll({
        'where': {
          'GameSystemId': request.payload.GameSystemId
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
        'offset': offset,
				'limit': request.payload.pageSize,
        'order': [
          ['totalWins', 'DESC']
        ]
      })
      .then((response) => {
				let count = response.count;
	      let results = response.rows;
	      let totalPages = Math.ceil(count === 0 ? 1 : (count / pageSize));

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

export default gameSystemRankings;
