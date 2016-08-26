'use strict';

const moduleName = 'main';
const angular = require('angular');


let mod = angular.module(moduleName, [
    // Angular
    require('angular-animate'),
    require('angular-ui-router'),
    require('angular-sanitize'),
    require('angular-utils-pagination'),
    require('angular-scroll'),
    require('angular-ui-mask'),
    require('ng-file-upload'),
]);

// Run
mod.run(require('./run'));

// Config
mod.config(require('./config'));

// Routes
mod.constant('apiRoutes', require('./constants/apiRoutes'));


// Controllers
mod.controller('AdminController', require('./controllers/AdminController'));




module.exports = moduleName;
