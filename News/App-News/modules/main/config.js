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
        .state('news', {
          url: "/",
          template: require('./views/news.php'),
          controller: 'NewsController as News'
        })
        .state('posts', {
          url: "/posts/:id",
          template: require('./views/post.php'),
          controller: 'NewsController as News'
        });

    $urlRouterProvider.otherwise("/");
}

module.exports = config;
