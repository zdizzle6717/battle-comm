'use strict';

let models = require('../models');

// Product Route Configs
let userNotifications = {
    create: function(request, reply) {
        models.UserNotification.create({
            UserId: request.payload.UserId,
            type: request.payload.type,
            status: request.payload.status,
            fromId: request.payload.fromId,
            fromName: request.payload.fromName
            })
            .then(function(response) {
                reply(response).code(200);
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
                }
                else {
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
                }
                else {
                    reply().code(404);
                }
            });
    }
};


module.exports = userNotifications;
