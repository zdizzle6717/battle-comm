'use strict';

const moduleName = 'store';
const angular = require('angular');
require('angularjs-slider');


let mod = angular.module(moduleName, [
    // Angular
    require('angular-animate'),
    require('angular-ui-router'),
    require('angular-sanitize'),
    require('angular-utils-pagination'),
    require('angular-scroll'),
    require('angular-ui-mask'),

    require('../libraries/loading'),
    'rzModule'
]);

// Config
mod.config(require('./config'));

// Routes
mod.constant('apiRoutes', require('./constants/apiRoutes'));

// Constants
mod.constant('manufacturersSchema', require('./schema/manufacturers'));


// Controllers
mod.controller('StoreController', require('./controllers/StoreController'));
mod.controller('ProductController', require('./controllers/ProductController'));
mod.controller('CheckoutController', require('./controllers/CheckoutController'));

// Directives
mod.directive('userDetails', require('./directives/userDetails'));

// Services
mod.service('StoreService', require('./services/StoreService'));
mod.service('CheckoutService', require('./services/CheckoutService'));


module.exports = moduleName;
