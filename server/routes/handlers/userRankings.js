'use strict';

let models = require('../../models');
const Boom = require('boom');

// Product Route Configs
let userRankings = {
    createOrUpdate: function(request, reply) {
        models.UserRanking.findOrCreate({
                where: {
					$and: [
					   {
						 GameSystemId: request.payload.GameSystemId
					   },
					   {
							 FactionId: request.payload.FactionId
					   },
					   {
							 UserId: request.payload.UserId
					   },
					 ]
                },
                defaults: {
                    UserId: request.payload.UserId,
                    GameSystemId: request.payload.GameSystemId,
					FactionId: request.payload.FactionId,
					totalWins: request.payload.totalWins,
					totalDraws: request.payload.totalDraws,
					totalLosses: request.payload.totalLosses
                }
            })
            .then(function(response) {
                let created = response[1];
                if (created) {
                    reply(response).code(200);
                } else {
					response[0].increment({
						'totalWins': request.payload.totalWins,
						'totalDraws': request.payload.totalDraws,
						'totalLosses': request.payload.totalLosses
					})
					.then(function(response) {
                        reply(response).code(200);
                    });
                }
            }).catch((respone) => {
				throw Boom.badRequest(response);
			});
    },
	search: function(request, reply) {
        models.UserRanking.findAll({
			where: {
				$and: [
				    {
				      GameSystemId: request.payload.GameSystemId
				    },
				    {
				      FactionId: request.payload.FactionId
				    }
				  ]
			},
			include: [
				{ model: models.User, attributes: ['username', 'id'] },
				{ model: models.GameSystem, attributes: ['name'] },
				{ model: models.Faction, attributes: ['name'] },
			],
			limit: request.payload.maxResults || 20
		})
        .then(function(rankings) {
            reply(rankings).code(200);
        });
    }
};


module.exports = userRankings;
