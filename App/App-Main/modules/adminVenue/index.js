'use strict';

const moduleName = 'adminVenue';
const angular = require('angular');

let mod = angular.module(moduleName, [
]);

// Config
mod.config(require('./config'));

// Routes
mod.constant('API_ROUTES', require('../../constants/apiRoutes'));

// Controllers
mod.controller('PointAssignmentController', require('./controllers/PointAssignmentController'));

// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));


// Services
mod.service('VenueService', require('./services/VenueService'));



module.exports = moduleName;
