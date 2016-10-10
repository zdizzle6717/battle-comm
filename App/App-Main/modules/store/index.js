'use strict';

const moduleName = 'store';
const angular = require('angular');
require('angularjs-slider');


let mod = angular.module(moduleName, [
    'rzModule'
]);

// Config
mod.config(require('./config'));

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
