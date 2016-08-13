/* Controllers */

var newsApp = angular.module('newsApp', ['angularUtils.directives.dirPagination']);

newsApp.config(function($interpolateProvider) {
	"use strict";
    $interpolateProvider.startSymbol('[[');
    $interpolateProvider.endSymbol(']]');
  });

newsApp.controller('NewsListCtrl', function ($scope, $http) {
	"use strict";
  $http.get('/News/news_connect.php')
	.success(function (response) {$scope.news = response.records;
  });

  $scope.currentPage = 1;
  $scope.pageSize = '10';
  $scope.orderProp = 'Posted';
  $scope.pageChangeHandler = function(num) {
      console.log('news page changed to ' + num); 
	  
  };

});


function PageController($scope) {
	"use strict";
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}



newsApp.controller('PageController', PageController);

  
newsApp.controller('NewsDetailCtrl', ['$scope', '$sce', '$routeParams', '$http',
  function($scope, $sce, $routeParams, $http) {
	  "use strict";
	$scope.getHtml = function(html) {
		   return $sce.trustAsHtml(html);
	   };
    $http.get('/News/news_route.php?news_id=' + $routeParams.newsId).success(function(response) {
      $scope.news = response.records;

    });
  }]);