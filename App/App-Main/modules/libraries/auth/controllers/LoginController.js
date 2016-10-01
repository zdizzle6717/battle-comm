'use strict';

LoginController.$inject = ['$rootScope', '$state', 'AuthService'];

function LoginController($rootScope, $state, AuthService) {
    let controller = this;

    controller.incorrectUsername = false;
    controller.incorrectPassword = false;

    controller.login = login;

	init();

    ////////////////////////////

	function init() {
		if (AuthService.currentUser.rememberLogin) {
			controller.credentials = AuthService.currentUser || {};
		}
		if (AuthService.currentUser.loginAuto) {
			let credentials = AuthService.currentUser || {};
			login(credentials);
		}
		if (AuthService.isAuthenticated) {
			$state.go('dashboard', {'playerId': AuthService.currentUser.id});
		}
	}

    function login(credentials) {
        return AuthService.authenticate(credentials)
            .then(function(response) {
				console.log(response.status + ': Authenticated, login success.')
                $state.go('dashboard',  {'playerId': response.data.id});
            })
            .catch(function(response) {
				if (response.data.message === "Incorrect username or email!") {
					controller.incorrectUsername = true;
				    controller.incorrectPassword = false;
				} else if (response.data.message === 'Incorrect password!') {
					controller.incorrectUsername = false;
				    controller.incorrectPassword = true;
				}
				return response;
            });
    }
}

module.exports = LoginController;
