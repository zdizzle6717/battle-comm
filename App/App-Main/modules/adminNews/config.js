'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    $stateProvider
        .state('newsList', {
          url: "/admin/news/all-posts",
          template: require('./views/newsList.php'),
          controller: 'NewsListController as News'
        })
        .state('post', {
          url: "/admin/news/posts/:id",
          template: require('./views/post.php'),
          controller: 'PostController as Post'
        });

}

module.exports = config;
