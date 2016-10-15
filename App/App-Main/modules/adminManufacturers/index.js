'use strict';

const moduleName = 'manufacturers';
const angular = require('angular');


let mod = angular.module(moduleName, [
]);

// Config
mod.config(require('./config'));

// Routes
mod.constant('API_ROUTES', require('../../constants/apiRoutes'));

// Constants

// Controllers
mod.controller('ManufacturerListController', require('./controllers/ManufacturerListController'));
mod.controller('ManufacturerController', require('./controllers/ManufacturerController'));

// Services



module.exports = moduleName;
