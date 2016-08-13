'use strict';

const moduleName = 'main';
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

    require('../cart'),
    'rzModule'
]);

// Run
mod.run(require('./run'));

// Config
mod.config(require('./config'));

// Constants
mod.constant('manufacturersSchema', require('./schema/manufacturers'));


// Controllers
mod.controller('StoreController', require('./controllers/StoreController'));
mod.controller('ProductController', require('./controllers/ProductController'));
mod.controller('CheckoutController', require('./controllers/CheckoutController'));

// Directives
// mod.directive('header', require('./directives/Header'));

// Services
mod.service('StoreService', require('./services/StoreService'));
mod.service('CheckoutService', require('./services/CheckoutService'));


module.exports = moduleName;
