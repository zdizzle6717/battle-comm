'use strict';

Object.defineProperty(exports, "__esModule", {
		value: true
});

var _envVariables = require('../../../envVariables');

var _envVariables2 = _interopRequireDefault(_envVariables);

var _nodemailer = require('nodemailer');

var _nodemailer2 = _interopRequireDefault(_nodemailer);

var _formatJSONDate = require('../../utils/formatJSONDate');

var _formatJSONDate2 = _interopRequireDefault(_formatJSONDate);

var _pointAssignment = require('../../email-templates/pointAssignment');

var _pointAssignment2 = _interopRequireDefault(_pointAssignment);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var transporter = _nodemailer2.default.createTransport({
		'service': 'Gmail',
		'auth': {
				'type': 'OAuth2',
				'clientId': _envVariables2.default.email.OAuth2.clientId,
				'clientSecret': _envVariables2.default.email.OAuth2.clientSecret
		}
});

// Product Route Configs
var venues = {
		create: function create(request, reply) {
				request.payload.venueEvent.eventDate = (0, _formatJSONDate2.default)(request.payload.venueEvent.eventDate);

				var adminMailConfig = {
						'from': _envVariables2.default.email.user,
						'to': _envVariables2.default.email.user,
						'subject': 'Venue RP Assignment: ' + request.payload.venueEvent.venueName + ', ' + request.payload.venueEvent.eventDate,
						'html': (0, _pointAssignment2.default)(request.payload),
						'service': 'Gmail',
						'auth': {
								'user': _envVariables2.default.email.user,
								'refreshToken': _envVariables2.default.email.OAuth2.refreshToken
						}
				};

				transporter.sendMail(adminMailConfig, function (error, info) {
						if (error) {
								console.log(error);
								reply('E-mail failed to send. Check server configuration.').code(400);
						} else {
								// Forward mail to venueAdmin
								adminMailConfig.to = request.payload.venueEvent.returnEmail;
								adminMailConfig.subject = 'BC: Copy of RP Submission';
								transporter.sendMail(adminMailConfig, function (error, info) {
										if (error) {
												console.log(error);
										}
										reply('This point assignment has been successfully delivered to the BC site admin. Contact BattleCommVault@gmail.com for further questions.').code(200);
								});
						}
				});
		}
};

exports.default = venues;