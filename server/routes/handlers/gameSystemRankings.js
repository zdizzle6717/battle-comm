'use strict';

let models = require('../../models');
const Boom = require('boom');

// Product Route Configs
let gameSystemRankings = {
    createOrUpdate: function(request, reply) {
        models.GameSystemRanking.findOrCreate({
                where: {
					$and: [
					   {
						   GameSystemId: request.payload.GameSystemId
					   },
					   {
						   UserId: request.payload.UserId
					   }
					 ]
                },
                defaults: {
                    UserId: request.payload.UserId,
                    GameSystemId: request.payload.GameSystemId,
					totalWins: request.payload.totalWins,
					totalDraws: request.payload.totalDraws,
					totalLosses: request.payload.totalLosses
                }
            })
            .then(function(response) {
                let created = response[1];
                if (created) {
					models.FactionRanking.findOrCreate({
						where: {
							$and: [
							   {
								   FactionId: request.payload.FactionId
							   },
							   {
								   GameSystemRankingId: response[0].id
							   }
							 ]
		                },
						defaults: {
							FactionId: request.payload.FactionId,
		                    GameSystemRankingId: response[0].id,
							totalWins: request.payload.totalWins,
							totalDraws: request.payload.totalDraws,
							totalLosses: request.payload.totalLosses
		                }
					}).then((response) => {
						let created = response[1];
						if (created) {
							reply(response).code(200);
						} else {
							response[0].increment({
								'totalWins': request.payload.totalWins,
								'totalDraws': request.payload.totalDraws,
								'totalLosses': request.payload.totalLosses
							}).then(function(response) {
								reply(response).code(200);
							});
						}
					});
                } else {
					response[0].increment({
						'totalWins': request.payload.totalWins,
						'totalDraws': request.payload.totalDraws,
						'totalLosses': request.payload.totalLosses
					})
					.then(function(response) {
						models.FactionRanking.findOrCreate({
							where: {
								$and: [
								   {
									   FactionId: request.payload.FactionId
								   },
								   {
									   GameSystemRankingId: response.id
								   }
								 ]
			                },
							defaults: {
								FactionId: request.payload.FactionId,
			                    GameSystemRankingId: response.id,
								totalWins: request.payload.totalWins,
								totalDraws: request.payload.totalDraws,
								totalLosses: request.payload.totalLosses
			                }
						}).then((response) => {
							let created = response[1];
							if (created) {
								reply(response).code(200);
							} else {
								response[0].increment({
									'totalWins': request.payload.totalWins,
									'totalDraws': request.payload.totalDraws,
									'totalLosses': request.payload.totalLosses
								}).then(function(response) {
									reply(response).code(200);
								});
							}
						});
                    });
                }
            }).catch((respone) => {
				throw Boom.badRequest(response);
			});
    },
	search: function(request, reply) {
        models.GameSystemRanking.findAll({
			where: {
				$and: [
				    {
				      GameSystemId: request.payload.GameSystemId
				    }
				  ]
			},
			include: [
				{ model: models.User, attributes: ['username', 'id'] },
				{ model: models.GameSystem, attributes: ['name'] }
			],
			limit: request.payload.maxResults || 20,
			order: [['totalWins', 'DESC']]
		})
        .then(function(rankings) {
            reply(rankings).code(200);
        });
    }
};


module.exports = gameSystemRankings;
