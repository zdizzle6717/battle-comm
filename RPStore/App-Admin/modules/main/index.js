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

    // Libraries
    require('../libraries/loading')
]);

// Run
mod.run(require('./run'));

// Config
mod.config(require('./config'));

// Routes
mod.constant('apiRoutes', require('./constants/apiRoutes'));

// Constants
mod.constant('manufacturers', require('./constants/manufacturers'));


// Controllers
mod.controller('OrderListController', require('./controllers/OrderListController'));
mod.controller('OrderController', require('./controllers/OrderController'));
mod.controller('ProductListController', require('./controllers/ProductListController'));
mod.controller('ProductController', require('./controllers/ProductController'));


// Directives
mod.directive('fileUpload', require('./directives/FileUpload'));

// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));


// Services
mod.service('AdminService', require('./services/AdminService'));
mod.service('FileService', require('./services/FileService'));



module.exports = moduleName;
