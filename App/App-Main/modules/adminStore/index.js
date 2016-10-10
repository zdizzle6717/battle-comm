'use strict';

const moduleName = 'adminStore';
const angular = require('angular');


let mod = angular.module(moduleName, [
]);

// Config
mod.config(require('./config'));

// Routes
mod.constant('apiRoutes', require('../../constants/apiRoutes'));

// Constants
mod.constant('manufacturers', require('./constants/manufacturers'));


// Controllers
mod.controller('OrderListController', require('./controllers/OrderListController'));
mod.controller('OrderController', require('./controllers/OrderController'));
mod.controller('ProductListController', require('./controllers/ProductListController'));
mod.controller('ProductEditController', require('./controllers/ProductEditController'));


// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));


// Services
mod.service('AdminService', require('./services/AdminService'));



module.exports = moduleName;
