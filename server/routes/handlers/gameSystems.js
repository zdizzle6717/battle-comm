'use strict';

let models = require('../../models');

// Product Route Configs
let gameSystems = {
    get: function(request, reply) {
        models.GameSystem.find({
                where: {
                    id: request.params.id
                },
				include: [{
					model: models.Manufacturer
				}]
            })
            .then(function(response) {
                if (response) {
                    reply(response).code(200);
                }
                else {
                    reply().code(404);
                }

            });
    },
    getAll: function(request, reply) {
        models.GameSystem.findAll()
            .then(function(response) {
                reply(response).code(200);
            });
    },
    create: function(request, reply) {
        models.GameSystem.create({
            ManufacturerId: request.payload.ManufacturerId,
            description: request.payload.description,
            searchKey: request.payload.searchKey,
            photo: request.payload.photo,
            url: request.payload.url
            })
            .then(function(response) {
                reply(response).code(200);
            });
    },
    update: function(request, reply) {
        models.GameSystem.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(newsPost) {
                if (newsPost) {
                    newsPost.updateAttributes({
						ManufacturerId: request.payload.ManufacturerId,
			            description: request.payload.description,
			            searchKey: request.payload.searchKey,
			            photo: request.payload.photo,
			            url: request.payload.url
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
        models.GameSystem.destroy({
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


module.exports = gameSystems;
