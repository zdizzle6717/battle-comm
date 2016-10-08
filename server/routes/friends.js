'use strict';

let models = require('../models');
const Boom = require('boom');

// Product Route Configs
let friends = {
    create: function(request, reply) {
		models.User.find({
			where: {
				id: request.payload.UserId
			}
		})
        .then(function(user1) {
			models.User.find({
				where: {
					id: request.payload.InviteeId
				}
			})
			.then(function(user2) {
				user1.addFriend(user2).then(function(user1Response) {
					user2.addFriend(user1).then(function(user2Response) {
						let response = [];
						response.push(user1Response);
						response.push(user2Response);
						reply(response).code(200);
					})
				});
			})
			.catch(function(response) {
				reply(response).code(404);
			})
        })
		.catch(function(response) {
			reply(response).code(404);
		});
    }
};


module.exports = friends;
