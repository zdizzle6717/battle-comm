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

    // Libraries
    require('../libraries/loading')
]);

// Run
mod.run(require('./run'));

// Config
mod.config(require('./config'));

// Routes
mod.constant('API_ROUTES', require('./constants/apiRoutes'));

// Constants

// Controllers
mod.controller('NewsController', require('./controllers/NewsController'));

// Directives


// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));


// Services
mod.service('NewsService', require('./services/NewsService'));



module.exports = moduleName;
