'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    $stateProvider
        .state('dashboard', {
          url: "/dashboard/:playerId",
          template: require('./views/dashboard.php'),
          controller: 'DashboardController as Dashboard',
		  params: {
			  playerId: ''
		  },
		  data: {
			  accessLevel: ['member']
		  }
        })
        .state('changePassword', {
          url: "/change-password/:playerId",
          template: require('./views/changePassword.php'),
          controller: 'DashboardController as Dashboard',
		  params: {
			  playerId: ''
		  },
		  data: {
			  accessLevel: ['member']
		  }
        })
        .state('notifications', {
          url: "/notifications/:playerId",
          template: require('./views/notifications.php'),
          controller: 'NotificationsController as Notifications',
		  params: {
			  playerId: ''
		  },
		  data: {
			  accessLevel: ['member']
		  }
        });

}

module.exports = config;
