'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider', 'LoadingServiceProvider', 'AuthInterceptorProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider, LoadingServiceProvider, AuthInterceptorProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    // Loading
    $httpProvider.interceptors.push(LoadingServiceProvider.interceptor);
    $httpProvider.interceptors.push(AuthInterceptorProvider.interceptor);

    $stateProvider
        // RP Store
        .state('login', {
          url: "/login",
          template: require('./views/login.php'),
          controller: 'LoginController as Login'
        })
        .state('register', {
          url: "/register",
          template: require('./views/register.php'),
          controller: 'RegisterController as Register'
        })
		.state('forgotPassword', {
          url: "/forgot-password",
          template: require('./views/forgotPassword.php'),
          controller: 'LoginController as Forgot'
        })
		.state('resetPassword', {
          url: "/reset-password/{token}",
          template: require('./views/resetPassword.php'),
          controller: 'SetNewPasswordController as Reset',
		  params: {
			  token: ''
		  }
        })
		.state('playerSearch', {
          url: "/player-search",
          template: require('./views/playerSearch.php'),
          controller: 'PlayerSearchController as PlayerSearch',
		  data: {
			  accessLevel: ['subscriber']
		  }
        })
		.state('playerRanking', {
          url: "/player-ranking",
          template: require('./views/playerRanking.php'),
          controller: 'PlayerRankingController as PlayerRanking',
		  params: {
			  gameSystemId: null,
			  factionId: null
		  }
        });

        $urlRouterProvider.otherwise('/login');
}

module.exports = config;
