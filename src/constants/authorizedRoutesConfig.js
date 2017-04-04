'use strict';

// TODO: Improve accuracy of path comparison regex

module.exports = [
	{
		'name': 'assignPoints',
		'path': '/admin/venue/assign-points',
		'accessControl': ['venueAdmin']
	},
	{
		'name': 'playerDashboard',
		'path': '/players/dashboard',
		'accessControl': ['member']
	}
];
