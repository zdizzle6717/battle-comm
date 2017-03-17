'use strict';

// TODO: Generate a better secret
// Set correct serverUID and serverGID

module.exports = {
	// Development
	'name': 'development',
	'baseApiRoute': 'http://localhost:9290/api/',
	'baseUrl': 'http://localhost',
	'clientPort': 9200,
	'apiPort': 9290,
	'chatPort': 9291,
	'cors': {
		'origin': ['*']
	},

	// Production
	// 'name': 'production',
	// 'baseApiRoute': 'http://www.treemachinerecords.com:3030/api/',
	// 'baseUrl': 'http://www.treemachinerecords.com/',
	// 'clientPort': 3000,
	// 'port': 3030,
	// 'cors': {
	// 		'origin': ['https://www.react.battle-comm.net','https://react.battle-comm.net', 'https://52.26.195.10']
	// },

	'swagger': {
			'documentationPage': false
	},
	'googleAnalyticsKey': 'UA-48987915-2',
	'uploadPath': '/dist/uploads/',
	'serverUID': 501,
	'serverGID': 20,
	'secret': 'BC_SECRETS_SECRETS_ARE_NO_FUN',
	'email': {
		'user': 'BattleCommVault@gmail.com',
		'pass': 'BryceMan43',
		'XOAuth2': {
			'user': 'BattleCommVault@gmail.com',
			'clientId': '318512140643-jliekra11he3mnkaql8ei5q2li9p6vv4.apps.googleusercontent.com',
			'clientSecret': 'LSm6mfy5aGUqrnTu517L8xtz',
			'refreshToken': '1/vqRHMe7J3Bt_A-mh-nS_h1HP4wcoAMfiHJw6-IoSxcw'
		}
	}
}
