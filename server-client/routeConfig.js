'use strict';

export default [
	{
		'route': '/',
		'view': 'index'
	},
	{
		'route': '/admin*',
		'view': 'admin'
	},
	{
		'route': '/forgot-password',
		'view': 'forgotPassword'
	},
	{
		'route': '/login',
		'view': 'login'
	},
	{
		'route': '/news*',
		'view': 'news'
	},
	{
		'route': '/password-reset',
		'view': 'passwordReset'
	},
	{
		'route': '/players*',
		'view': 'players'
	},
	{
		'route': '/register',
		'view': 'register'
	},
	{
		'route': '/store*',
		'view': 'store'
	}
];
