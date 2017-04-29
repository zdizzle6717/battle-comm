'use strict';

Object.defineProperty(exports, "__esModule", {
	value: true
});
var databaseConfig = {
	'development': {
		'username': 'bcadmin',
		'password': 'Xdxn9zX5s',
		'database': 'bcStaging',
		'host': '127.0.0.1',
		'dialect': 'postgres',
		'omitNull': true,
		'options': {
			'quoteIdentifiers': true
		}
	}
};

exports.default = databaseConfig;