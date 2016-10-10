'use strict';

let port = require('./port');

let routes = {
	'users': {
		'register': `http://52.26.195.10:${port}/api/users`,
		'authenticate': `http://52.26.195.10:${port}/api/users/authenticate`
	},
	'players': {
		'get': `http://52.26.195.10:${port}/api/users/`,
		'getAll': `http://52.26.195.10:${port}/api/users`,
		'update': `http://52.26.195.10:${port}/api/users/`,
		'search': `http://52.26.195.10:${port}/api/search/users`
	},
	'friends': {
		'create': `http://52.26.195.10:${port}/api/friends`,
		'remove': `http://52.26.195.10:${port}/api/friends`
	},
	'notifications': {
		'create': `http://52.26.195.10:${port}/api/userNotifications`,
		'update': `http://52.26.195.10:${port}/api/userNotifications/`,
		'remove': `http://52.26.195.10:${port}/api/userNotifications/`
	},
	'userPhotos': {
		'create': `http://52.26.195.10:${port}/api/userPhotos`
	},
	'files': {
		'create': `http://52.26.195.10:${port}/api/files/`
	},
	'products': {
		'get': `http://52.26.195.10:${port}/api/products/`,
		'getAll': `http://52.26.195.10:${port}/api/products`,
		'create': `http://52.26.195.10:${port}/api/products`,
		'update': `http://52.26.195.10:${port}/api/products/`,
		'remove': `http://52.26.195.10:${port}/api/products/`
	},
	'orders': {
		'get': `http://52.26.195.10:${port}/api/productOrders/`,
		'getAll': `http://52.26.195.10:${port}/api/productOrders`,
		'create': `http://52.26.195.10:${port}/api/productOrders`,
		'update': `http://52.26.195.10:${port}/api/productOrders/`,
		'remove': `http://52.26.195.10:${port}/api/productOrders/`
	},
	'venue': {
		'assign': `http://52.26.195.10:${port}/api/venues/assignPoints`,
	},
	'news': {
		'get': `http://52.26.195.10:${port}/api/newsPosts/`,
		'getAll': `http://52.26.195.10:${port}/api/newsPosts`,
		'create': `http://52.26.195.10:${port}/api/newsPosts`,
		'update': `http://52.26.195.10:${port}/api/newsPosts/`,
		'remove': `http://52.26.195.10:${port}/api/newsPosts/`
	}
};

module.exports = routes;
