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

var _xoauth = require('xoauth2');

var _xoauth2 = _interopRequireDefault(_xoauth);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var generator = _xoauth2.default.createXOAuth2Generator(_envVariables2.default.email.XOAuth2);

// listen for token updates
// you probably want to store these to a db


// TODO: IMPORTANT - xoauth2 and nodemailer packages were updated, check API and documentation
generator.on('token', function (token) {});

// Product Route Configs
var venues = {
  create: function create(request, reply) {
    request.payload.venueEvent.eventDate = (0, _formatJSONDate2.default)(request.payload.venueEvent.eventDate);
    var transporter = _nodemailer2.default.createTransport({
      'service': 'Gmail',
      'auth': {
        'xoauth2': generator
      }
    });

    var adminMailConfig = {
      'from': _envVariables2.default.email.user,
      'to': _envVariables2.default.email.user,
      'subject': 'Venue RP Assignment: ' + request.payload.venueEvent.venueName + ', ' + request.payload.venueEvent.eventDate,
      'html': (0, _pointAssignment2.default)(request.payload)
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