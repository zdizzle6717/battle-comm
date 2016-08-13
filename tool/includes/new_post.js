(function(angular) {
  'use strict';
  
angular.module('formExample', [])
  .controller('NewsController', function($scope, $http) {
    $scope.news = {};
	$scope.submitted = false;
	$scope.news.game_system = "N/A";
	$scope.news.parent = "Miscellaneous";
	$scope.options = [
		{ code: "Yes", name: "Yes" },
		{ code: "No", name: "No" }
	];

    $scope.submitData = function (news, resultVarName) {
      var config = {
        params: {
          news: news
        }
      };

      $http.post("includes/server.php", null, config).success(function (data, status, headers, config) {
          $scope[resultVarName] = data;
        })
        .error(function (data, status, headers, config) {
          $scope[resultVarName] = "* Marks a required Field";
        });
    };
  });
  
})(window.angular);