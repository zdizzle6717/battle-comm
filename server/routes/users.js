'use strict';

const env = require('../config/environmentVariables');
const models = require('../models');
const fs = require('fs-extra');
const nodemailer = require('nodemailer');
const generator = require('xoauth2').createXOAuth2Generator(env.email.XOAuth2);
const buildRPUpdateEmail = require('../email-templates/rpUpdate');
const buildRegistrationEmail = require('../email-templates/registrationSuccess');
const Boom = require('boom');
const createToken = require('../utils/createToken');
const userFunctions = require('../utils/userFunctions');

// listen for token updates
// you probably want to store these to a db
generator.on('token', function(token){
});

let transporter = nodemailer.createTransport(({
	service: 'Gmail',
	auth: {
		xoauth2: generator
	}
}));

// Product Route Configs
let users = {
    get: function(request, reply) {
        models.User.find({
                where: {
                    id: request.params.id
                },
				attributes: { exclude: ['password'] },
				include: [
				     { model: models.UserNotification },
					 { model: models.UserPhoto },
					 { model: models.User, as: 'Friends' },
				  ],
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
        models.User.findAll()
            .then(function(products) {
                reply(products).code(200);
            });
    },
	create: function(request, reply) {
		userFunctions.hashPassword(request.payload.password, (err, hash) => {
			models.User.create({
	                email: request.payload.email,
	                firstName: request.payload.firstName,
	                lastName: request.payload.lastName,
	                username: request.payload.username,
					password: hash
	            })
				.then(function(user) {
					let customerMailConfig = {
						from: env.email.user,
						to: user.email,
						subject: `Welcome to Battle-Comm!`,
						html: buildRegistrationEmail(user)
					};

					transporter.sendMail(customerMailConfig, function(error, info){
						if(error) {
							console.log(error);
							reply('Somthing went wrong');
						} else{
							reply({
								id_token: createToken(user),
								id: user.id,
								firstName: user.firstName,
								lastName: user.lastName,
								subscriber: user.subscriber,
								tourneyAdmin: user.tourneyAdmin,
								eventAdmin: user.eventAdmin,
								newsContributor: user.newsContributor,
								venueAdmin: user.venueAdmin,
								clubAdmin: user.clubAdmin,
								systemAdmin: user.systemAdmin
							}).code(201);
						};
					});
				})
				.catch(function(response) {
					throw Boom.badRequest(response);
				})
		});
	},
	authenticate: function(request, reply) {
		reply({
			id_token: createToken(request.pre.user),
			id: request.pre.user.id,
			firstName: request.pre.user.firstName,
			lastName: request.pre.user.lastName,
			subscriber: request.pre.user.subscriber,
			tourneyAdmin: request.pre.user.tourneyAdmin,
			eventAdmin: request.pre.user.eventAdmin,
			newsContributor: request.pre.user.newsContributor,
			venueAdmin: request.pre.user.venueAdmin,
			clubAdmin: request.pre.user.clubAdmin,
			systemAdmin: request.pre.user.systemAdmin
		}).code(201);
	},
    updatePartial: function(request, reply) {
        models.User.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(user) {
                if (user) {
					let sendEmail = false;
					if (request.payload.rewardPoints && request.payload.rewardPoints !== user.rewardPoints) {
						sendEmail = true;
					}
                    user.updateAttributes({
                        // email: request.payload.email,
                        // password: request.payload.password,
                        firstName: request.payload.firstName,
                        lastName: request.payload.lastName,
                        tourneyAdmin: request.payload.tourneyAdmin,
                        subscriber: request.payload.subscriber,
                        eventAdmin: request.payload.eventAdmin,
                        newsContributor: request.payload.NewsContributor,
                        venueAdmin: request.payload.venueAdmin,
                        clubAdmin: request.payload.clubAdmin,
                        systemAdmin: request.payload.systemAdmin,
                        username: request.payload.username,
                        club: request.payload.club,
                        mainPhone: request.payload.mainPhone,
                        mobilePhone: request.payload.mobilePhone,
                        streetAddress: request.payload.streetAddress,
                        aptSuite: request.payload.aptSuite,
                        city: request.payload.city,
                        state: request.payload.state,
                        zip: request.payload.zip,
                        dob: request.payload.dob,
                        bio: request.payload.bio,
                        facebook: request.payload.facebook,
                        twitter: request.payload.twitter,
                        instagram: request.payload.instagram,
                        googlePlus: request.payload.googlePlus,
                        youtube: request.payload.youtube,
                        twitch: request.payload.twitch,
                        website: request.payload.website,
                        rewardPoints: request.payload.rewardPoints,
                        visibility: request.payload.visibility,
                        shareContact: request.payload.shareContact,
                        shareName: request.payload.shareName,
                        shareStatus: request.payload.shareStatus,
                        newsletter: request.payload.newsletter,
                        marketing: request.payload.marketing,
                        sms: request.payload.sms,
                        allowPlay: request.payload.allowPlay,
                        icon: request.payload.icon,
                        totalWins: request.payload.totalWins,
                        totalLoss: request.payload.totalLoss,
                        totalDraw: request.payload.totalDraw,
                        totalPoints: request.payload.totalPoints,
                        eloRanking: request.payload.eloRanking,
                        accountActive: request.payload.accountActive
                    }).then(function(response) {
						if (sendEmail === true) {
							let customerMailConfig = {
							    from: env.email.user,
							    to: response.email,
							    subject: `Reward Point Update: New Total of ${response.rewardPoints}`,
							    html: buildRPUpdateEmail(response)
							};

							transporter.sendMail(customerMailConfig, function(error, info){
							    if(error) {
							        console.log(error);
							        reply('Somthing went wrong');
							    } else{
							        reply(response).code(200);
							    };
							});
						} else {
						    reply(response).code(200);
						}
                    });
                }
                else {
                    reply().code(404);
                }
            }).catch(function(err) {
				console.log(err);
			});
    },
    // delete: function(request, reply) {
    //     models.UserLogin.destroy({
    //             where: {
    //                 id: request.params.id
    //             }
    //         })
    //         .then(function(response) {
    //             if (response) {
    //                 reply().code(200);
    //             }
    //             else {
    //                 reply().code(404);
    //             }
    //         });
    // },
	search: function(request, reply) {
        models.User.findAll({
			where: {
				$or: [
				    {
				      firstName: {
				        $like: '%' + request.payload.query + '%'
				      }
				    },
				    {
				      lastName: {
				        $like: '%' + request.payload.query + '%'
				      }
				    },
				    {
				      username: {
				        $like: '%' + request.payload.query + '%'
				      }
				    },
				  ]
			},
			attributes: ['id', 'firstName', 'lastName', 'username', 'icon'],
			limit: request.payload.maxResults || 20
		})
        .then(function(products) {
            reply(products).code(200);
        });
    },
};


module.exports = users;
