'use strict';

require('babel-polyfill');
require('./ThirdParty/prefix.min.js')

const angular = require('angular');

const appName = 'Battle-Comm';
const appVersion = '1.0.0';

let app = angular.module(appName, [
    require('./modules/main')
]);

// Constants
app.constant('appTitle', appName);

angular.bootstrap(document, [appName]);
