'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});

var _memberRegistration = require('./memberRegistration');

var _memberRegistration2 = _interopRequireDefault(_memberRegistration);

var _subscriberRegistration = require('./subscriberRegistration');

var _subscriberRegistration2 = _interopRequireDefault(_subscriberRegistration);

var _tourneyAdminRegistration = require('./tourneyAdminRegistration');

var _tourneyAdminRegistration2 = _interopRequireDefault(_tourneyAdminRegistration);

var _eventAdminRegistration = require('./eventAdminRegistration');

var _eventAdminRegistration2 = _interopRequireDefault(_eventAdminRegistration);

var _newsContributorRegistration = require('./newsContributorRegistration');

var _newsContributorRegistration2 = _interopRequireDefault(_newsContributorRegistration);

var _venueAdminRegistration = require('./venueAdminRegistration');

var _venueAdminRegistration2 = _interopRequireDefault(_venueAdminRegistration);

var _clubAdminRegistration = require('./clubAdminRegistration');

var _clubAdminRegistration2 = _interopRequireDefault(_clubAdminRegistration);

var _systemAdminRegistration = require('./systemAdminRegistration');

var _systemAdminRegistration2 = _interopRequireDefault(_systemAdminRegistration);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

function buildRegistrationEmail(role, user) {
	switch (role) {
		case 'member':
			return (0, _memberRegistration2.default)(user);
		case 'subscriber':
			return (0, _subscriberRegistration2.default)(user);
		case 'tourneyAdmin':
			return (0, _tourneyAdminRegistration2.default)(user);
		case 'eventAdmin':
			return (0, _eventAdminRegistration2.default)(user);
		case 'newsContributor':
			return (0, _newsContributorRegistration2.default)(user);
		case 'venueAdmin':
			return (0, _venueAdminRegistration2.default)(user);
		case 'clubAdmin':
			return (0, _clubAdminRegistration2.default)(user);
		case 'systemAdmin':
			return (0, _systemAdminRegistration2.default)(user);
		default:
			throw new Error('No e-mail template exists for the supplied user role!');
	}
}

exports.default = buildRegistrationEmail;