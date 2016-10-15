'use strict';

let models = require('../../models');
const Boom = require('boom');

// Product Route Configs
let userNotifications = {
    create: function(request, reply) {
        models.UserNotification.findOrCreate({
                where: {
					$and: [
						{ UserId: request.payload.UserId },
						{ type: request.payload.type },
						{ fromId: request.payload.fromId }
					]
                },
                defaults: {
                    UserId: request.payload.UserId,
                    type: request.payload.type,
                    status: request.payload.status,
                    fromId: request.payload.fromId,
                    fromUsername: request.payload.fromUsername,
                    fromName: request.payload.fromName
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
        models.UserNotification.find({
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
    },
    delete: function(request, reply) {
        models.UserNotification.destroy({
                where: {
                    id: request.params.id
                }
            })
            .then(function(response) {
                if (response) {
                    reply().code(200);
                } else {
                    reply().code(404);
                }
            });
    }
};


module.exports = userNotifications;
