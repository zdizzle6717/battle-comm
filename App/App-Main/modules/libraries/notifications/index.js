'use strict';

const moduleName = 'notifications';
const angular = require('angular');

let mod = angular.module(moduleName, []);

// Directives
mod.directive('notification', require('./directives/notification'));

module.exports = moduleName;
