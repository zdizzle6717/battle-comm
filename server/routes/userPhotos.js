'use strict';

let models = require('../models');
const Boom = require('boom');

// Product Route Configs
let userPhotos = {
    create: function(request, reply) {
        models.UserPhoto.create({
			UserId: request.payload.UserId,
			url: request.payload.url
		})
        .then(function(response) {
			reply(response).code(200);
        })
		.catch(function(response) {
			reply(Boom.badRequest(response));
		});
    }
};


module.exports = userPhotos;
