'use strict';

const moduleName = 'main';
const angular = require('angular');


let mod = angular.module(moduleName, [
    // Angular
    require('angular-animate'),
    require('angular-ui-router'),
    require('angular-sanitize'),
    require('angular-utils-pagination'),
    require('angular-scroll'),
    require('angular-ui-mask'),
    require('ng-file-upload'),

	// Modules
	require('../profile'),
	require('../dashboard'),
	require('../cart'),
	require('../store'),
	require('../adminNews'),
	require('../adminPlayers'),
	require('../adminStore'),
	require('../adminVenue'),

	// Libraries
    require('../libraries/auth'),
    require('../libraries/loading'),
    require('../libraries/notifications'),
    require('../libraries/file-upload'),
    require('../libraries/delete-record')
]);

// Run
mod.run(require('./run'));

// Config
mod.config(require('./config'));

// Routes
mod.constant('API_ROUTES', require('../../constants/apiRoutes'));

// Directives
mod.directive('userNav', require('./directives/userNav'));
mod.directive('accountNav', require('./directives/accountNav'));
mod.directive('adminNav', require('./directives/adminNav'));


// Controllers




module.exports = moduleName;
