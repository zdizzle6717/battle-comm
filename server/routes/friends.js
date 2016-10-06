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
        .then(function(user) {
			models.User.find({
				where: {
					id: request.payload.InviteeId
				}
			})
			.then(function(invitee) {
				user.setFriends(invitee).then(function(newFriend) {
					invitee.setFriends(user).then(function(response) {
						reply(newFriend).code(200);
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
