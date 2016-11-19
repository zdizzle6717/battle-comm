'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    $stateProvider
        .state('manufacturerList', {
          url: "/admin/manufacturers",
          template: require('./views/manufacturerList.php'),
          controller: 'ManufacturerListController as Manufacturers',
		  data: {
			  accessLevel: ['systemAdmin']
		  }
        })
        .state('manufacturer', {
          url: "/admin/manufacturers/:id",
          template: require('./views/manufacturer.php'),
          controller: 'ManufacturerController as Manufacturer',
		  data: {
			  accessLevel: ['systemAdmin']
		  }
        });

}

module.exports = config;
