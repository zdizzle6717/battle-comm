'use strict';

const moduleName = 'profile';
const angular = require('angular');


let mod = angular.module(moduleName, [

    // Libraries
    require('../libraries/loading'),
    require('../libraries/notifications')
]);

// Config
mod.config(require('./config'));

// Controllers
mod.controller('ProfileController', require('./controllers/ProfileController'));


module.exports = moduleName;
