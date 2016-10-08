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
						reply(user1Response).code(200);
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
    },
	remove: function(request, reply) {
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
				user1.removeFriend(user2).then(function(user1Response) {
					user2.removeFriend(user1).then(function(user2Response) {
						reply(user1Response).code(200);
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
