'use strict';

const moduleName = 'cart';
const angular = require('angular');


let mod = angular.module(moduleName, [

]);

// Run
mod.run(require('./run'));

// Config
mod.config(require('./config'));

// Controllers
mod.controller('CartController', require('./controllers/CartController'));


// Directives
mod.directive('ngcartAddtocart', require('./directives/ngcartAddtocart'));
mod.directive('ngcartCart', require('./directives/ngcartCart'));
mod.directive('ngcartSummary', require('./directives/ngcartSummary'));
mod.directive('ngcartCheckout', require('./directives/ngcartCheckout'));


// Factories
mod.factory('ngCartItem', require('./factories/ngCartItemFactory'))


// Services
mod.provider('$ngCart', require('./services/ngCartProvider'));
mod.service('ngCart', require('./services/ngCartService'));
mod.service('store', require('./services/storeService'));




module.exports = moduleName;
