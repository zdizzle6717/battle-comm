var newsApp = angular.module('newsApp', ['angularUtils.directives.dirPagination']);

newsApp.controller('NewsListCtrl', function ($scope, $http) {
  $http.get("Angular/news_connect.php")
	.success(function (response) {$scope.news = response.records;
  });

  $scope.currentPage = 1;
  $scope.pageSize = '10';
  $scope.orderProp = 'Posted';
  $scope.orderProp.reverse = true;
  
  
  $scope.pageChangeHandler = function(num) {
      console.log('meals page changed to ' + num);
  };
});


function PageController($scope) {
  $scope.pageChangeHandler = function(num) {
    console.log('going to page ' + num);
  };
}


newsApp.controller('PageController', PageController);
  
newsApp.controller('NewsDetailCtrl', ['$scope', '$routeParams', '$http',
  function($scope, $routeParams, $http) {
    $http.get('Angular/news_route.php?news_id=' + $routeParams.newsId).success(function(response) {
      $scope.news = response.records;
    });
  }]);