'use strict';

let port = require('./port').api;

let routes = {
	'files': {
		'create': `https://www.battle-comm.net:${port}/api/files/`
	},
	'friends': {
		'create': `https://www.battle-comm.net:${port}/api/friends`,
		'remove': `https://www.battle-comm.net:${port}/api/friends`
	},
	'factions': {
		'create': `https://www.battle-comm.net:${port}/api/factions`,
		'update': `https://www.battle-comm.net:${port}/api/factions/`
	},
	'gameSystems': {
		'get': `https://www.battle-comm.net:${port}/api/gameSystems/`,
		'getAll': `https://www.battle-comm.net:${port}/api/gameSystems`,
		'create': `https://www.battle-comm.net:${port}/api/gameSystems`,
		'update': `https://www.battle-comm.net:${port}/api/gameSystems/`,
		'remove': `https://www.battle-comm.net:${port}/api/gameSystems/`
	},
	'manufacturers': {
		'get': `https://www.battle-comm.net:${port}/api/manufacturers/`,
		'getAll': `https://www.battle-comm.net:${port}/api/manufacturers`,
		'create': `https://www.battle-comm.net:${port}/api/manufacturers`,
		'update': `https://www.battle-comm.net:${port}/api/manufacturers/`,
		'remove': `https://www.battle-comm.net:${port}/api/manufacturers/`
	},
	'news': {
		'get': `https://www.battle-comm.net:${port}/api/newsPosts/`,
		'getAll': `https://www.battle-comm.net:${port}/api/newsPosts`,
		'create': `https://www.battle-comm.net:${port}/api/newsPosts`,
		'update': `https://www.battle-comm.net:${port}/api/newsPosts/`,
		'remove': `https://www.battle-comm.net:${port}/api/newsPosts/`
	},
	'notifications': {
		'create': `https://www.battle-comm.net:${port}/api/userNotifications`,
		'update': `https://www.battle-comm.net:${port}/api/userNotifications/`,
		'remove': `https://www.battle-comm.net:${port}/api/userNotifications/`
	},
	'orders': {
		'get': `https://www.battle-comm.net:${port}/api/productOrders/`,
		'getAll': `https://www.battle-comm.net:${port}/api/productOrders`,
		'create': `https://www.battle-comm.net:${port}/api/productOrders`,
		'update': `https://www.battle-comm.net:${port}/api/productOrders/`,
		'remove': `https://www.battle-comm.net:${port}/api/productOrders/`
	},
	'players': {
		'get': `https://www.battle-comm.net:${port}/api/users/`,
		'getAll': `https://www.battle-comm.net:${port}/api/users`,
		'update': `https://www.battle-comm.net:${port}/api/users/`,
		'search': `https://www.battle-comm.net:${port}/api/search/users`
	},
	'products': {
		'get': `https://www.battle-comm.net:${port}/api/products/`,
		'getAll': `https://www.battle-comm.net:${port}/api/products`,
		'create': `https://www.battle-comm.net:${port}/api/products`,
		'update': `https://www.battle-comm.net:${port}/api/products/`,
		'remove': `https://www.battle-comm.net:${port}/api/products/`
	},
	'rankings': {
		'createOrUpdate': `https://www.battle-comm.net:${port}/api/gameSystemRankings`,
		'searchByGameSystem': `https://www.battle-comm.net:${port}/api/search/gameSystemRankings`,
		'searchByFaction': `https://www.battle-comm.net:${port}/api/search/factionRankings`,
	},
	'userPhotos': {
		'create': `https://www.battle-comm.net:${port}/api/userPhotos`
	},
	'users': {
		'register': `https://www.battle-comm.net:${port}/api/users`,
		'authenticate': `https://www.battle-comm.net:${port}/api/users/authenticate`,
		'changePassword': `https://www.battle-comm.net:${port}/api/users/changePassword/`,
		'resetPassword': `https://www.battle-comm.net:${port}/api/users/resetPassword/`,
		'verifyResetToken': `https://www.battle-comm.net:${port}/api/users/verifyResetToken/`,
		'setNewPassword': `https://www.battle-comm.net:${port}/api/users/setNewPassword/`,
	},
	'venue': {
		'assign': `https://www.battle-comm.net:${port}/api/venues/assignPoints`,
	}
};

module.exports = routes;
