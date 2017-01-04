'use strict';

run.$inject = ['$rootScope', '$state', 'AuthService', '$http'];
function run($rootScope, $state, AuthService, $http) {
	$rootScope.$on('$stateChangeStart', function(e, toState, toParams, fromState, fromParams, options) {
		$http.defaults.headers.common.Authorization = AuthService.token ? 'Bearer ' + AuthService.token : undefined;
		let authIsRequired = (toState.data && toState.data.accessLevel) ? true : false;
		let accessLevel = (toState.data && toState.data.accessLevel) ? toState.data.accessLevel : ['public'];
		let accessGranted = false;
		const checkAuth = checkAuth;


		if (authIsRequired) {
			if (AuthService.isAuthorized(accessLevel)) {
				console.log('Authorized.')
				return;
			} else if (!AuthService.isAuthenticated || !AuthService.isAuthorized(accessLevel)) {
				e.preventDefault();
				AuthService.authenticate(AuthService.currentUser)
					.then(function(response) {
						if (AuthService.isAuthorized(accessLevel)) {
							$state.go(toState.name, toParams);
						} else {
							console.log('403: Unauthorized.')
							let config = {
								type: 'info',
								message: 'Please register or login to continue.',
								timeout: '2000'
							}
							showAlert(config);
							$state.go('login', {}, {reload:true});
						}
					})
					.catch(function(response) {
						let config = {
							type: 'info',
							message: 'Please register or login to continue.',
							timeout: '3500'
						}
						showAlert(config);
						console.log(response.status + ": Unauthenticated, please log in");
						$state.go('login', {}, {reload: true});
					});
			}
		}

	});

	function showAlert(config) {
		$rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
	}
}

module.exports = run;
