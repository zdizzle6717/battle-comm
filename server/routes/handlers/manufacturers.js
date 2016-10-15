'use strict';

let models = require('../../models');

// Product Route Configs
let manufacturers = {
    get: function(request, reply) {
        models.Manufacturer.find({
                where: {
                    id: request.params.id
                },
				include: [{
					model: models.GameSystem
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
        models.Manufacturer.findAll({
				include: [{
					model: models.GameSystem
				}]
			})
            .then(function(response) {
                reply(response).code(200);
            });
    },
    create: function(request, reply) {
        models.Manufacturer.create({
			name: request.payload.name,
			searchKey: request.payload.searchKey,
            description: request.payload.description,
            photo: request.payload.photo,
            url: request.payload.url
            })
            .then(function(response) {
                reply(response).code(200);
            });
    },
    update: function(request, reply) {
        models.Manufacturer.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(newsPost) {
                if (newsPost) {
                    newsPost.updateAttributes({
						name: request.payload.name,
						searchKey: request.payload.searchKey,
			            description: request.payload.description,
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
        models.Manufacturer.destroy({
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


module.exports = manufacturers;
