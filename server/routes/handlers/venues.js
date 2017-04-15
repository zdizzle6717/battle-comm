'use strict';

import env from '../../../envVariables';
import nodemailer from 'nodemailer';
import formatJSONDate from '../../utils/formatJSONDate';
import buildPointAssignmentEmail from '../../email-templates/pointAssignment';
import xoauth2 from 'xoauth2';
let generator = xoauth2.createXOAuth2Generator(env.email.XOAuth2);

// listen for token updates
// you probably want to store these to a db
generator.on('token', (token) => {});

// Product Route Configs
let venues = {
  create: (request, reply) => {
		request.payload.venueEvent.eventDate = formatJSONDate(request.payload.venueEvent.eventDate);
    let transporter = nodemailer.createTransport(({
      'service': 'Gmail',
      'auth': {
        'xoauth2': generator
      }
    }));

    let adminMailConfig = {
      'from': env.email.user,
      'to': env.email.user,
      'subject': `Venue RP Assignment: ${request.payload.venueEvent.venueName}, ${request.payload.venueEvent.eventDate}`,
      'html': buildPointAssignmentEmail(request.payload)
    };

    transporter.sendMail(adminMailConfig, (error, info) => {
      if (error) {
        console.log(error);
        reply('Somthing went wrong');
      } else {
				// Forward mail to venueAdmin
				adminMailConfig.to = request.payload.venueEvent.returnEmail;
				adminMailConfig.subject = 'BC: Copy of RP Submission';
				transporter.sendMail(adminMailConfig, (error, info) => {
					if (error) {
		        console.log(error);
					}
					reply('This point assignment has been successfully delivered to the BC site admin. Contact BattleCommVault@gmail.com for further questions.').code(200);
				});

      }
    });
  }
};


export default venues;
