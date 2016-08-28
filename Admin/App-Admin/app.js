'use strict';

require('babel-polyfill');

const angular = require('angular');

const appName = 'Battle-Comm Site Admin';
const appVersion = '1.0.0';

let app = angular.module(appName, [
    require('./modules/main'),
    require('./modules/rpstore'),
    require('./modules/news'),
    require('./modules/players'),
]);

// Constants
app.constant('appTitle', appName);

angular.bootstrap(document, [appName]);
