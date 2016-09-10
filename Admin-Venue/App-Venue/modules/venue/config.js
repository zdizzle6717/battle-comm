'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider', 'LoadingServiceProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider, LoadingServiceProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    // Loading
    $httpProvider.interceptors.push(LoadingServiceProvider.interceptor);

    $stateProvider
        .state('venueAdmin', {
          url: "/",
          template: require('./views/adminDashboard.php'),
          controller: 'DashboardController as Dashboard'
        })
        .state('assignPoints', {
          url: "/assign-points",
          template: require('./views/assignPoints.php'),
          controller: 'PointAssignmentController as Points'
        });

}

module.exports = config;
