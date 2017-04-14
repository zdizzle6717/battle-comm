'use strict';

// TODO: Improve accuracy of path comparison regex

module.exports = [
	{
		'name': 'adminDashboard',
		'path': '/admin',
		'accessControl': ['tourneyAdmin', 'eventAdmin', 'venueAdmin', 'newsContributor'],
		'children': [
			{
				'name': 'gameSystems',
				'path': '/admin/game-systems**',
				'accessControl': ['systemAdmin']
			},
			{
				'name': 'manufacturers',
				'path': '/admin/manufacturers**',
				'accessControl': ['systemAdmin']
			},
			{
				'name': 'news',
				'path': '/admin/news**',
				'accessControl': ['newsContributor']
			},
			{
				'name': 'users',
				'path': '/admin/users**',
				'accessControl': ['systemAdmin']
			},
			{
				'name': 'store',
				'path': '/admin/store**',
				'accessControl': ['systemAdmin']
			},
			{
				'name': 'venue',
				'path': '/admin/venue**',
				'accessControl': ['venueAdmin']
			}
		]
	},
	{
		'name': 'playerDashboard',
		'path': '/players/dashboard**',
		'accessControl': ['member']
	}
];
