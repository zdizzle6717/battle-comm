'use strict';

let siteUrl = require('./envConfig').siteUrl;
let port = require('./envConfig').port.api;

let routes = {
	'files': {
		'create': `${siteUrl}:${port}/api/files/`
	},
	'friends': {
		'create': `${siteUrl}:${port}/api/friends`,
		'remove': `${siteUrl}:${port}/api/friends`
	},
	'factions': {
		'create': `${siteUrl}:${port}/api/factions`,
		'update': `${siteUrl}:${port}/api/factions/`
	},
	'gameSystems': {
		'get': `${siteUrl}:${port}/api/gameSystems/`,
		'getAll': `${siteUrl}:${port}/api/gameSystems`,
		'create': `${siteUrl}:${port}/api/gameSystems`,
		'update': `${siteUrl}:${port}/api/gameSystems/`,
		'remove': `${siteUrl}:${port}/api/gameSystems/`
	},
	'manufacturers': {
		'get': `${siteUrl}:${port}/api/manufacturers/`,
		'getAll': `${siteUrl}:${port}/api/manufacturers`,
		'create': `${siteUrl}:${port}/api/manufacturers`,
		'update': `${siteUrl}:${port}/api/manufacturers/`,
		'remove': `${siteUrl}:${port}/api/manufacturers/`
	},
	'news': {
		'get': `${siteUrl}:${port}/api/newsPosts/`,
		'getAll': `${siteUrl}:${port}/api/newsPosts`,
		'create': `${siteUrl}:${port}/api/newsPosts`,
		'update': `${siteUrl}:${port}/api/newsPosts/`,
		'remove': `${siteUrl}:${port}/api/newsPosts/`
	},
	'notifications': {
		'create': `${siteUrl}:${port}/api/userNotifications`,
		'update': `${siteUrl}:${port}/api/userNotifications/`,
		'remove': `${siteUrl}:${port}/api/userNotifications/`
	},
	'orders': {
		'get': `${siteUrl}:${port}/api/productOrders/`,
		'getAll': `${siteUrl}:${port}/api/productOrders`,
		'create': `${siteUrl}:${port}/api/productOrders`,
		'update': `${siteUrl}:${port}/api/productOrders/`,
		'remove': `${siteUrl}:${port}/api/productOrders/`
	},
	'players': {
		'get': `${siteUrl}:${port}/api/users/`,
		'getAll': `${siteUrl}:${port}/api/users`,
		'update': `${siteUrl}:${port}/api/users/`,
		'search': `${siteUrl}:${port}/api/search/users`
	},
	'products': {
		'get': `${siteUrl}:${port}/api/products/`,
		'getAll': `${siteUrl}:${port}/api/products`,
		'create': `${siteUrl}:${port}/api/products`,
		'update': `${siteUrl}:${port}/api/products/`,
		'remove': `${siteUrl}:${port}/api/products/`
	},
	'rankings': {
		'createOrUpdate': `${siteUrl}:${port}/api/gameSystemRankings`,
		'searchByGameSystem': `${siteUrl}:${port}/api/search/gameSystemRankings`,
		'searchByFaction': `${siteUrl}:${port}/api/search/factionRankings`,
	},
	'userPhotos': {
		'create': `${siteUrl}:${port}/api/userPhotos`
	},
	'users': {
		'register': `${siteUrl}:${port}/api/users`,
		'authenticate': `${siteUrl}:${port}/api/users/authenticate`,
		'changePassword': `${siteUrl}:${port}/api/users/changePassword/`,
		'resetPassword': `${siteUrl}:${port}/api/users/resetPassword/`,
		'verifyResetToken': `${siteUrl}:${port}/api/users/verifyResetToken/`,
		'setNewPassword': `${siteUrl}:${port}/api/users/setNewPassword/`,
	},
	'venue': {
		'assign': `${siteUrl}:${port}/api/venues/assignPoints`,
	}
};

module.exports = routes;
