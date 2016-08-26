'use strict';

const moduleName = 'delete-record';
const angular = require('angular');

let mod = angular.module(moduleName, []);

// Directives
mod.directive('deleteRecordModal', require('./directives/deleteRecordModal'));

module.exports = moduleName;
