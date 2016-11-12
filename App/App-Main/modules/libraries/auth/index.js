'use strict';

const moduleName = 'auth';
const angular = require('angular');

let mod = angular.module(moduleName, [
	// Angular
	require('angular-animate'),
	require('angular-ui-router'),
]);

// Run
mod.run(require('./run'));

// Controllers
mod.controller('LoginController', require('./controllers/LoginController'));
mod.controller('RegisterController', require('./controllers/RegisterController'));
mod.controller('SetNewPasswordController', require('./controllers/SetNewPasswordController'));

// Services
mod.service('AuthService', require('./services/AuthService'));

// Providers
mod.provider('AuthInterceptor', require('./providers/AuthInterceptor'));

// Directives
mod.directive('accessLevel', require('./directives/accessLevel'));

module.exports = moduleName;
