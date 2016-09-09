'use strict';

let env = require('../config/environmentVariables');
let models = require('../models');
let nodemailer = require('nodemailer');
var generator = require('xoauth2').createXOAuth2Generator(env.email.XOAuth2);
let buildRPUpdateEmail = require('../email-templates/rpUpdate');
// listen for token updates
// you probably want to store these to a db
generator.on('token', function(token){
    console.log('New token for %s: %s', token.user, token.accessToken);
});

// Product Route Configs
let userLogins = {
    get: function(request, reply) {
        models.user_login.find({
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
        models.user_login.findAll()
            .then(function(products) {
                reply(products).code(200);
            });
    },
    // create: function(request, reply) {
    //     models.user_login.create({
    //         })
    //         .then(function(response) {
    //             reply(response).code(200);
    //         });
    // },
    updatePartial: function(request, reply) {
		let transporter = nodemailer.createTransport(({
			service: 'Gmail',
			auth: {
				xoauth2: generator
			}
		}));

        models.user_login.find({
                where: {
                    id: request.params.id
                }
            })
            .then(function(response) {
                if (response) {
					let sendEmail = false;
					let previousUserData = {};
					if (request.payload.user_points !== response.user_points) {
						sendEmail = true;
						previousUserData = response;
					}
                    response.updateAttributes({
                        // email: request.payload.email,
                        // password: request.payload.password,
                        // activation_key: request.payload.activation_key,
                        // activation_state: request.payload.activation_state,
                        firstName: request.payload.firstName,
                        lastName: request.payload.lastName,
                        // join_date: request.payload.join_date,
                        tourneyAdmin: request.payload.tourneyAdmin,
                        EventAdmin: request.payload.EventAdmin,
                        // NewsContributor: request.payload.NewsContributor,
                        venueAdmin: request.payload.venueAdmin,
                        clubAdmin: request.payload.clubAdmin,
                        systemAdmin: request.payload.systemAdmin,
                        user_handle: request.payload.user_handle,
                        // user_club: request.payload.user_club,
                        user_main_phone: request.payload.user_main_phone,
                        // user_mobile_phone: request.payload.user_mobile_phone,
                        // user_work_phone: request.payload.user_work_phone,
                        user_street_address: request.payload.user_street_address,
                        user_apt_suite: request.payload.user_apt_suite,
                        user_city: request.payload.user_city,
                        user_state: request.payload.user_state,
                        user_zip: request.payload.user_zip,
                        // user_Date_of_Birth: request.payload.user_Date_of_Birth,
                        user_bio: request.payload.user_bio,
                        user_facebook: request.payload.user_facebook,
                        user_twitter: request.payload.user_twitter,
                        user_instagram: request.payload.user_instagram,
                        // user_google_plus: request.payload.user_google_plus,
                        // user_youtube: request.payload.user_youtube,
                        user_twitch: request.payload.user_twitch,
                        user_website: request.payload.user_website,
                        user_points: request.payload.user_points,
                        // user_visibility: request.payload.user_visibility,
                        // user_share_contact: request.payload.user_share_contact,
                        // user_share_name: request.payload.user_share_name,
                        // user_share_status: request.payload.user_share_status,
                        // user_newsletter: request.payload.user_newsletter,
                        // user_marketing: request.payload.user_marketing,
                        // user_sms: request.payload.user_sms,
                        // user_allow_play: request.payload.user_allow_play,
                        user_icon: request.payload.user_icon
                        // totalWins: request.payload.totalWins,
                        // totalLoss: request.payload.totalLoss,
                        // totalDraw: request.payload.totalDraw,
                        // totalPoints: request.payload.totalPoints,
                        // accountActive: request.payload.accountActive
                    }).then(function(response) {
						if (sendEmail === true) {
							let customerMailConfig = {
							    from: env.email.user,
							    to: response.email,
							    subject: `Reward Point Update: New Total of ${response.user_points}`,
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


module.exports = userLogins;
