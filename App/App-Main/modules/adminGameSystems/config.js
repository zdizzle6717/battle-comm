'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    $stateProvider
        .state('gameSystemList', {
          url: "/admin/gameSystems",
          template: require('./views/gameSystemList.php'),
          controller: 'GameSystemListController as GameSystems',
		  data: {
			  accessLevel: ['systemAdmin']
		  }
        })
        .state('gameSystem', {
          url: "/admin/gameSystems/:id",
          template: require('./views/gameSystem.php'),
          controller: 'GameSystemController as GameSystem',
		  data: {
			  accessLevel: ['systemAdmin']
		  }
        });

}

module.exports = config;
