'use strict';

const moduleName = 'profile';
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

    // Libraries
    require('../libraries/loading'),
    require('../libraries/notifications')
]);

// Run
mod.run(require('./run'));

// Config
mod.config(require('./config'));

// Controllers
mod.controller('ProfileController', require('./controllers/ProfileController'));

// Filters
mod.filter('jsonDate', require('./filters/jsonDate'));


// Services
mod.service('ProfileService', require('./services/ProfileService'));



module.exports = moduleName;
