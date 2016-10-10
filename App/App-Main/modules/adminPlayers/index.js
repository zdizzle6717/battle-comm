'use strict';

const moduleName = 'players';
const angular = require('angular');


let mod = angular.module(moduleName, [
]);

// Config
mod.config(require('./config'));

// Routes
mod.constant('API_ROUTES', require('../../constants/apiRoutes'));

// Controllers
mod.controller('PlayerListController', require('./controllers/PlayerListController'));
mod.controller('PlayerEditController', require('./controllers/PlayerEditController'));

// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));


// Services



module.exports = moduleName;
