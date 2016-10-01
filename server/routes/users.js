'use strict';

const env = require('../config/environmentVariables');
const models = require('../models');
const fs = require('fs-extra');
const nodemailer = require('nodemailer');
const generator = require('xoauth2').createXOAuth2Generator(env.email.XOAuth2);
const buildRPUpdateEmail = require('../email-templates/rpUpdate');
const Boom = require('boom');
const createToken = require('../utils/createToken');
const userFunctions = require('../utils/userFunctions');

// listen for token updates
// you probably want to store these to a db
generator.on('token', function(token){
});

// Product Route Configs
let users = {
    get: function(request, reply) {
        models.User.find({
                where: {
                    id: request.params.id
                }
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
	create: function(req, res) {
		userFunctions.hashPassword(req.payload.password, (err, hash) => {
			models.User.create({
	                email: req.payload.email,
	                username: req.payload.username,
					password: hash
	            })
				.then(function(user) {
					res({
						id_token: createToken(user),
						id: user.id,
						subscriber: user.subscriber,
						tourneyAdmin: user.tourneyAdmin,
						eventAdmin: user.eventAdmin,
						newsContributor: user.newsContributor,
						venueAdmin: user.venueAdmin,
						clubAdmin: user.clubAdmin,
						systemAdmin: user.systemAdmin
					}).code(201);
				})
				.catch(function(response) {
					throw Boom.badRequest(response);
				})
		});
	},
	authenticate: function(req, res) {
		res({
			id_token: createToken(req.pre.user),
			id: req.pre.user.id,
			subscriber: req.pre.user.subscriber,
			tourneyAdmin: req.pre.user.tourneyAdmin,
			eventAdmin: req.pre.user.eventAdmin,
			newsContributor: req.pre.user.newsContributor,
			venueAdmin: req.pre.user.venueAdmin,
			clubAdmin: req.pre.user.clubAdmin,
			systemAdmin: req.pre.user.systemAdmin
		}).code(201);
	},
    updatePartial: function(request, reply) {
		let transporter = nodemailer.createTransport(({
			service: 'Gmail',
			auth: {
				xoauth2: generator
			}
		}));

        models.User.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(response) {
                if (response) {
					let sendEmail = false;
					let previousUserData = {};
					if (request.payload.rewardPoints && request.payload.rewardPoints !== response.rewardPoints) {
						sendEmail = true;
						previousUserData = response;
					}
                    response.updateAttributes({
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
                        main_phone: request.payload.main_phone,
                        mobilePhone: request.payload.mobilePhone,
                        streetAddress: request.payload.streetAddress,
                        aptSuite: request.payload.aptSuite,
                        city: request.payload.city,
                        state: request.payload.state,
                        zip: request.payload.zip,
                        // dob: request.payload.dob,
                        bio: request.payload.bio,
                        facebook: request.payload.facebook,
                        twitter: request.payload.twitter,
                        instagram: request.payload.instagram,
                        googlePlus: request.payload.googlePlus,
                        youtube: request.payload.youtube,
                        twitch: request.payload.twitch,
                        website: request.payload.website,
                        rewardPoints: request.payload.rewardPoints,
                        // visibility: request.payload.visibility,
                        // shareContact: request.payload.shareContact,
                        // shareName: request.payload.shareName,
                        // shareStatus: request.payload.shareStatus,
                        // newsletter: request.payload.newsletter,
                        // marketing: request.payload.marketing,
                        // sms: request.payload.sms,
                        // allowPlay: request.payload.allowPlay,
                        icon: request.payload.icon,
                        totalWins: request.payload.totalWins,
                        totalLoss: request.payload.totalLoss,
                        totalDraw: request.payload.totalDraw,
                        totalPoints: request.payload.totalPoints,
                        eloRanking: request.payload.eloRanking,
                        // accountActive: request.payload.accountActive
                    }).then(function(response) {
						if (sendEmail === true) {
							let customerMailConfig = {
							    from: env.email.user,
							    to: response.email,
							    subject: `Reward Point Update: New Total of ${response.rewardPoints}`,
							    html: buildRPUpdateEmail(response) // You can choose to send an HTML body instead
							};

							transporter.sendMail(customerMailConfig, function(error, info){
							    if(error){
							        console.log(error);
							        reply('Somthing went wrong');
							    } else{
							        reply(response).code(200);
							    };
							});
						} else{
						    reply(response).code(200);
						}
                    });
                }
                else {
                    reply().code(404);
                }
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
    // }
};


module.exports = users;
