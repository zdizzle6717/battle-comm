'use strict';

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
	},
	{
		'name': 'store',
		'path': '/store',
		'accessControl': ['member'],
		'children': [
			{
				'name': 'cart',
				'path': '/store/cart',
				'accessControl': ['subscriber']
			},
			{
				'name': 'checkout',
				'path': '/store/checkout',
				'accessControl': ['subscriber']
			},
			{
				'name': 'order-success',
				'path': '/store/order-success',
				'accessControl': ['subscriber']
			},
			{
				'name': 'products',
				'path': '/store/products/*',
				'accessControl': ['member']
			},
		]
	}
];
