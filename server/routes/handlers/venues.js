'use strict';

import models from '../../models';
import env from '../../../envVariables';
import nodemailer from 'nodemailer';
import formatJSONDate from '../../utils/formatJSONDate';
import buildPointAssignmentEmail from '../../email-templates/pointAssignment';

let transporter = nodemailer.createTransport(({
    'service': 'Gmail',
    'auth': {
        'type': 'OAuth2',
        'clientId': env.email.OAuth2.clientId,
        'clientSecret': env.email.OAuth2.clientSecret
    }
}));

// Product Route Configs
let venues = {
    create: (request, reply) => {
        request.payload.venueEvent.eventDate = formatJSONDate(request.payload.venueEvent.eventDate);
        let totalPoints = 0;
        request.payload.players.forEach((player) => {
            totalPoints += player.pointsEarned;
        });

        models.User.find({
            'where': {
                'username': request.payload.venueEvent.adminUsername
            }
        }).then((user) => {
            user.decrement({
                'rpPool': totalPoints
            }).then((user) => {
                let adminMailConfig = {
                    'from': env.email.user,
                    'to': env.email.user,
                    'subject': `Venue RP Assignment: ${request.payload.venueEvent.venueName}, ${request.payload.venueEvent.eventDate}`,
                    'html': buildPointAssignmentEmail(request.payload, user.rpPool),
                    'service': 'Gmail',
                    'auth': {
                        'user': env.email.user,
                        'refreshToken': env.email.OAuth2.refreshToken
                    }
                };

                transporter.sendMail(adminMailConfig, (error, info) => {
                    if (error) {
                        console.log(error);
                        reply('E-mail failed to send. Check server configuration.').code(400);
                    } else {
                        // Forward mail to venueAdmin
                        adminMailConfig.to = request.payload.venueEvent.returnEmail;
                        adminMailConfig.subject = 'BC: Copy of RP Submission';
                        transporter.sendMail(adminMailConfig, (error, info) => {
                            if (error) {
                                console.log(error);
                            }
                            reply({
                                'rpPool': user.rpPool
                            }).code(200);
                        });

                    }
                });
            })
        });

    }
};


export default venues;
