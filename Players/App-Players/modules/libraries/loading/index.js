'use strict';

const moduleName = 'loading';
const angular = require('angular');

let mod = angular.module(moduleName, []);

// Directives
mod.directive('loading', require('./directives/loading'));

// Services
mod.provider('LoadingService', require('./services/LoadingService'));

module.exports = moduleName;
