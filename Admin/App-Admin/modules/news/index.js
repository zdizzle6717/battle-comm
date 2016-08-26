'use strict';

const moduleName = 'news';
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
    require('../libraries/notifications'),
    require('../libraries/file-upload'),
    require('../libraries/delete-record')
]);

// Run
mod.run(require('./run'));

// Config
mod.config(require('./config'));

// Routes
mod.constant('API_ROUTES', require('./constants/apiRoutes'));

// Constants
mod.constant('manufacturers', require('./constants/manufacturers'));


// Controllers
mod.controller('NewsListController', require('./controllers/NewsListController'));
mod.controller('PostController', require('./controllers/PostController'));

// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));


// Services
mod.service('NewsService', require('./services/NewsService'));
mod.service('FileService', require('./services/FileService'));



module.exports = moduleName;
