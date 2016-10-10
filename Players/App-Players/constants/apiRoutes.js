'use strict';

let routes = {
	files: {
		create: 'http://beta.battle-comm.net:3000/api/files/'
	},
	orders: {
		get: 'http://beta.battle-comm.net:3000/api/productOrders/',
		getAll: 'http://beta.battle-comm.net:3000/api/productOrders',
		create: 'http://beta.battle-comm.net:3000/api/productOrders',
		update: 'http://beta.battle-comm.net:3000/api/productOrders/',
		remove: 'http://beta.battle-comm.net:3000/api/productOrders/'
	},
	players: {
		get: 'http://beta.battle-comm.net:3000/api/userLogins/',
		getAll: 'http://beta.battle-comm.net:3000/api/userLogins',
		update: 'http://beta.battle-comm.net:3000/api/userLogins/'
	}
};

module.exports = routes;
