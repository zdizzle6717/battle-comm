'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    $stateProvider
        .state('playerList', {
          url: "/admin/players/all-players",
          template: require('./views/playerList.php'),
          controller: 'PlayerListController as Player',
		  data: {
			  accessLevel: ['systemAdmin']
		  }
        })
        .state('player', {
          url: "/admin/players/:userId",
          template: require('./views/player.php'),
          controller: 'PlayerEditController as Player',
		  data: {
			  accessLevel: ['systemAdmin']
		  }
        });

}

module.exports = config;
