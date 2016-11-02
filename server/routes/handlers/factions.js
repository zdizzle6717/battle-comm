'use strict';

let models = require('../../models');

// Product Route Configs
let factions = {
    create: function(request, reply) {
        models.Faction.create({
            GameSystemId: request.payload.GameSystemId,
            name: request.payload.name,
            })
            .then(function(response) {
                reply(response).code(200);
            });
    },
	update: function(request, reply) {
        models.Faction.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(faction) {
                if (faction) {
                    faction.updateAttributes({
			            name: request.payload.name,
                    }).then(function(response) {
                        reply(response).code(200);
                    });
                }
                else {
                    reply().code(404);
                }
            });
    },
    delete: function(request, reply) {
        models.Faction.destroy({
                where: {
                    id: request.params.id
                }
            })
            .then(function(response) {
                if (response) {
                    reply().code(200);
                }
                else {
                    reply().code(404);
                }
            });
    }
};


module.exports = factions;
