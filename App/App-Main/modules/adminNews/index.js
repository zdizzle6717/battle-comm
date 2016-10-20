'use strict';

const moduleName = 'adminNews';
const angular = require('angular');


let mod = angular.module(moduleName, [
]);

// Config
mod.config(require('./config'));

// Routes
mod.constant('API_ROUTES', require('../../constants/apiRoutes'));

// Constants
mod.constant('manufacturers', require('./constants/manufacturers'));


// Controllers
mod.controller('NewsListController', require('./controllers/NewsListController'));
mod.controller('PostController', require('./controllers/PostController'));

// Services
mod.service('NewsService', require('./services/NewsService'));



module.exports = moduleName;
