'use strict';

require('babel-polyfill');

const angular = require('angular');

const appName = 'Battle-Comm Players';
const appVersion = '1.0.0';

let app = angular.module(appName, [
    require('./modules/main'),
    require('./modules/dashboard'),
    require('./modules/profile')
]);

// Constants
app.constant('appTitle', appName);

angular.bootstrap(document, [appName]);
