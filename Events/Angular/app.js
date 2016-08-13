'use strict';

/* App Module */

var newsApplication = angular.module('newsApplication', [
  'ngRoute',
  'newsApp',
  'newsAnimations'
]);

newsApplication.config(['$routeProvider',
  function($routeProvider) {
    $routeProvider.
      when('/posts', {
        templateUrl: 'posts/news-list.php',
        controller: 'NewsListCtrl'
      }).
      when('/posts/:newsId', {
        templateUrl: 'posts/news-post.php',
        controller: 'NewsDetailCtrl'
      }).
      otherwise({
        redirectTo: '/posts'
      });
  }]);