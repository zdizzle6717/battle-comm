'use strict';

const moduleName = 'file-upload';
const angular = require('angular');

let mod = angular.module(moduleName, []);

// Directives
mod.directive('fileUpload', require('./directives/FileUpload'));

module.exports = moduleName;
