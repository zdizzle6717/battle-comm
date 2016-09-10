'use strict';

require('babel-polyfill');

const angular = require('angular');

const appName = 'Battle-Comm Venue Admin';
const appVersion = '1.0.0';

let app = angular.module(appName, [
    require('./modules/venue'),
]);

// Constants
app.constant('appTitle', appName);

angular.bootstrap(document, [appName]);
