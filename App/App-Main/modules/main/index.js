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
	require('../adminGameSystems'),
	require('../adminManufacturers'),
	require('../adminNews'),
	require('../adminPlayers'),
	require('../adminStore'),
	require('../adminVenue'),
	require('../cart'),
	require('../dashboard'),
	require('../profile'),
	require('../store'),

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
mod.directive('accountNav', require('./directives/accountNav'));
mod.directive('adminNav', require('./directives/adminNav'));
mod.directive('popup', require('./directives/popup'));
mod.directive('chatBox', require('./directives/chatBox'));

// Controllers
mod.controller('PlayerSearchController', require('./controllers/PlayerSearchController'));

// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));

// Services
mod.service('PlayerService', require('./services/PlayerService'));
mod.service('FriendService', require('./services/FriendService'));
mod.service('NotificationService', require('./services/NotificationService'));
mod.service('UserPhotoService', require('./services/UserPhotoService'));
mod.service('RankingService', require('./services/RankingService'));

// Factories
mod.factory('socket', require('./factories/socket'));


module.exports = moduleName;
