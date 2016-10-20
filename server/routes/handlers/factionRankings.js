'use strict';

let models = require('../../models');
const Boom = require('boom');

// Product Route Configs
let fationRankings = {
	search: function(request, reply) {
        models.FactionRanking.findAll({
			where: {
				$and: [
				    {
				      FactionId: request.payload.FactionId
				    }
				  ]
			},
			include: [
				{ model: models.Faction, attributes: ['name'] },
				{ model: models.GameSystemRanking, attributes: ['UserId'], include: [
					{ model: models.GameSystem, attributes: ['name', 'id'] },
					{ model: models.User, attributes: ['username'] }
				] }
			],
			limit: request.payload.maxResults || 20
		})
        .then(function(rankings) {
            reply(rankings).code(200);
        });
    }
};


module.exports = fationRankings;
