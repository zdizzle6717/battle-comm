'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    $stateProvider
        .state('profile', {
          url: "/profile/:playerId",
          template: require('./views/profile.php'),
          controller: 'ProfileController as Profile',
		  params: {
			  playerId: ''
		  }
        })
		.state('allyList', {
          url: "/allyList/:playerId",
          template: require('./views/allyList.php'),
          controller: 'ProfileController as Profile',
		  params: {
			  playerId: ''
		  }
        });

}

module.exports = config;
