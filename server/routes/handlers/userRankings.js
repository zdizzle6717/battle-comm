'use strict';

let models = require('../../models');
const Boom = require('boom');

// Product Route Configs
let userRankings = {
    create: function(request, reply) {
        models.UserRanking.findOrCreate({
                where: {
					 GameSystem: {
						 searchKey: request.payload.GameSystem.searchKey
					 }
                },
                defaults: {
                    GameSystem: {
						searchKey: request.payload.GameSystem.searchKey
					},
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
                    reply(Boom.badRequest('Request already sent'));
                }
            });
    },
    update: function(request, reply) {
        models.UserRanking.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(newsPost) {
                if (newsPost) {
                    newsPost.updateAttributes({
                        UserId: request.payload.UserId,
                        type: request.payload.type,
                        status: request.payload.status,
                    }).then(function(response) {
                        reply(response).code(200);
                    });
                } else {
                    reply().code(404);
                }
            });
    }
};


module.exports = userRankings;
