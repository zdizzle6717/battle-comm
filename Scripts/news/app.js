/* App Module */

var newsApplication = angular.module('newsApplication', [
  'ngRoute',
  'newsApp',
  'newsAnimations',
  'ngSanitize'
]);

newsApplication.config(['$routeProvider',
  function($routeProvider) {
	  'use strict';
    $routeProvider.
      when('/posts', {
        templateUrl: '/News/posts/news-list.php',
        controller: 'NewsListCtrl'
      }).
      when('/posts/:newsId', {
        templateUrl: '/News/posts/news-post.php',
        controller: 'NewsDetailCtrl'
      }).
      otherwise({
        redirectTo: '/posts'
      });
  }]);