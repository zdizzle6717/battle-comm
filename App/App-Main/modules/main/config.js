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
        // RP Store
        .state('login', {
          url: "/login",
          template: require('./views/login.php'),
          controller: 'LoginController as Login'
        })
        .state('register', {
          url: "/register",
          template: require('./views/register.php'),
          controller: 'RegisterController as Register'
        });

        $urlRouterProvider.otherwise('/login');
}

module.exports = config;
