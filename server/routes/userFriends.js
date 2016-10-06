'use strict';

let models = require('../models');
const Boom = require('boom');

// Product Route Configs
let userFriends = {
    create: function(request, reply) {
		let UserId = request.payload.UserId;
		let InviteeId = request.payload.InviteeId;
		models.UserFriend.findOrCreate({
			where: {
				UserId: request.payload.InviteeId
			},
			defaults: {
				UserId: request.payload.InviteeId,
				friendId: request.payload.UserId,
				iconUrl: request.payload.userIcon
			}
		})
        .spread(function(response, created) {
			if (!created) {
				console.log('Already exists');
				reply(response).code(202);
			} else {
				models.User.find({
		                where: {
		                    id: request.payload.InviteeId
		                },
						attributes: ['icon']
		            })
		            .then(function(response) {
						console.log(request.icon);
						models.UserFriend.findOrCreate({
							where: {
								UserId: UserId
							},
							defaults: {
								UserId: UserId,
								friendId: InviteeId,
								iconUrl: request.icon
							}
						}).then(function(response) {
							reply(response[0]).code(200);
						})
					});
			}
        })
		.catch(function(response) {
			reply(response).code(202);
		});
    }
};


module.exports = userFriends;
