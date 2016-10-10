'use strict';

const moduleName = 'dashboard';
const angular = require('angular');


let mod = angular.module(moduleName, [
]);

// Config
mod.config(require('./config'));

// Controllers
mod.controller('DashboardController', require('./controllers/DashboardController'));
mod.controller('NotificationsController', require('./controllers/NotificationsController'));

// Services


module.exports = moduleName;
