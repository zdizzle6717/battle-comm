'use strict';

const moduleName = 'file-upload';
const angular = require('angular');

let mod = angular.module(moduleName, []);

// Directives
mod.directive('fileUpload', require('./directives/FileUpload'));

// Services
mod.service('FileService', require('./services/FileService'));

module.exports = moduleName;
