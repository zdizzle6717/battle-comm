'use strict';

var _joi = require('joi');

var _joi2 = _interopRequireDefault(_joi);

var _handlers = require('../handlers');

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

module.exports = [
// Payments
{
	'method': 'POST',
	'path': '/api/payments/oneTimeCharge',
	'config': {
		'tags': ['api'],
		'description': 'Request new purchase',
		'notes': 'Request new purchase',
		'auth': {
			'strategy': 'jsonWebToken',
			'scope': ['eventAdmin', 'venueAdmin', 'systemAdmin']
		},
		'validate': {
			'payload': {
				'token': _joi2.default.string().required(),
				'details': _joi2.default.object().keys({
					'amount': _joi2.default.number().required(),
					'description': _joi2.default.string().required(),
					'email': _joi2.default.string().required()
				})
			}
		}
	},
	'handler': _handlers.payments.oneTimeCharge
}];