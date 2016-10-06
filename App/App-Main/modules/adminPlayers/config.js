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
        .state('playerList', {
          url: "/admin/players/all-players",
          template: require('./views/playerList.php'),
          controller: 'PlayerListController as Player'
        })
        .state('player', {
          url: "/admin/players/:userId",
          template: require('./views/player.php'),
          controller: 'PlayerEditController as Player'
        });

}

module.exports = config;
