'use strict';

let port = require('./port').api;

let routes = {
	'files': {
		'create': `http://52.26.195.10:${port}/api/files/`
	},
	'friends': {
		'create': `http://52.26.195.10:${port}/api/friends`,
		'remove': `http://52.26.195.10:${port}/api/friends`
	},
	'factions': {
		'create': `http://52.26.195.10:${port}/api/factions`,
		'update': `http://52.26.195.10:${port}/api/factions/`
	},
	'gameSystems': {
		'get': `http://52.26.195.10:${port}/api/gameSystems/`,
		'getAll': `http://52.26.195.10:${port}/api/gameSystems`,
		'create': `http://52.26.195.10:${port}/api/gameSystems`,
		'update': `http://52.26.195.10:${port}/api/gameSystems/`,
		'remove': `http://52.26.195.10:${port}/api/gameSystems/`
	},
	'manufacturers': {
		'get': `http://52.26.195.10:${port}/api/manufacturers/`,
		'getAll': `http://52.26.195.10:${port}/api/manufacturers`,
		'create': `http://52.26.195.10:${port}/api/manufacturers`,
		'update': `http://52.26.195.10:${port}/api/manufacturers/`,
		'remove': `http://52.26.195.10:${port}/api/manufacturers/`
	},
	'news': {
		'get': `http://52.26.195.10:${port}/api/newsPosts/`,
		'getAll': `http://52.26.195.10:${port}/api/newsPosts`,
		'create': `http://52.26.195.10:${port}/api/newsPosts`,
		'update': `http://52.26.195.10:${port}/api/newsPosts/`,
		'remove': `http://52.26.195.10:${port}/api/newsPosts/`
	},
	'notifications': {
		'create': `http://52.26.195.10:${port}/api/userNotifications`,
		'update': `http://52.26.195.10:${port}/api/userNotifications/`,
		'remove': `http://52.26.195.10:${port}/api/userNotifications/`
	},
	'orders': {
		'get': `http://52.26.195.10:${port}/api/productOrders/`,
		'getAll': `http://52.26.195.10:${port}/api/productOrders`,
		'create': `http://52.26.195.10:${port}/api/productOrders`,
		'update': `http://52.26.195.10:${port}/api/productOrders/`,
		'remove': `http://52.26.195.10:${port}/api/productOrders/`
	},
	'players': {
		'get': `http://52.26.195.10:${port}/api/users/`,
		'getAll': `http://52.26.195.10:${port}/api/users`,
		'update': `http://52.26.195.10:${port}/api/users/`,
		'search': `http://52.26.195.10:${port}/api/search/users`
	},
	'products': {
		'get': `http://52.26.195.10:${port}/api/products/`,
		'getAll': `http://52.26.195.10:${port}/api/products`,
		'create': `http://52.26.195.10:${port}/api/products`,
		'update': `http://52.26.195.10:${port}/api/products/`,
		'remove': `http://52.26.195.10:${port}/api/products/`
	},
	'rankings': {
		'createOrUpdate': `http://52.26.195.10:${port}/api/gameSystemRankings`,
		'searchByGameSystem': `http://52.26.195.10:${port}/api/search/gameSystemRankings`,
		'searchByFaction': `http://52.26.195.10:${port}/api/search/factionRankings`,
	},
	'userPhotos': {
		'create': `http://52.26.195.10:${port}/api/userPhotos`
	},
	'users': {
		'register': `http://52.26.195.10:${port}/api/users`,
		'authenticate': `http://52.26.195.10:${port}/api/users/authenticate`,
		'changePassword': `http://52.26.195.10:${port}/api/users/changePassword/`
	},
	'venue': {
		'assign': `http://52.26.195.10:${port}/api/venues/assignPoints`,
	}
};

module.exports = routes;
