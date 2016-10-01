'use strict';

const moduleName = 'dashboard';
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

    // Libraries
    require('../libraries/loading'),
    require('../libraries/notifications')
]);

// Config
mod.config(require('./config'));

// Controllers
mod.controller('DashboardController', require('./controllers/DashboardController'));

// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));


// Services
mod.service('PlayerService', require('./services/PlayerService'));



module.exports = moduleName;
