'use strict';

const moduleName = 'gameSystems';
const angular = require('angular');


let mod = angular.module(moduleName, [
]);

// Config
mod.config(require('./config'));

// Routes
mod.constant('API_ROUTES', require('../../constants/apiRoutes'));

// Constants

// Controllers
mod.controller('GameSystemListController', require('./controllers/GameSystemListController'));
mod.controller('GameSystemController', require('./controllers/GameSystemController'));

// Services



module.exports = moduleName;
