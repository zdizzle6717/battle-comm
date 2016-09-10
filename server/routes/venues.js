'use strict';

let env = require('../config/environmentVariables');
let models = require('../models');
let nodemailer = require('nodemailer');
var generator = require('xoauth2').createXOAuth2Generator(env.email.XOAuth2);
let buildPointAssignmentEmail = require('../email-templates/pointAssignment');
// listen for token updates
// you probably want to store these to a db
generator.on('token', function(token){
});

// Product Route Configs
let venues = {
    create: function(request, reply) {
		let transporter = nodemailer.createTransport(({
			service: 'Gmail',
			auth: {
				xoauth2: generator
			}
		}));

		let adminMailConfig = {
		    from: env.email.user,
		    to: env.email.user,
		    subject: `Venue RP Assignment: ${request.payload.venueEvent.venueName}, ${request.payload.venueEvent.eventDate}`,
		    html: buildPointAssignmentEmail(request.payload)
		};

		transporter.sendMail(adminMailConfig, function(error, info){
		    if(error){
		        console.log(error);
		        reply('Somthing went wrong');
		    } else{
		        reply('This point assignment has been successfully delivered to the BC site admin. Contact BattleCommVault@gmail.com for further questions.').code(200);
		    };
		});
    }
};


module.exports = venues;
