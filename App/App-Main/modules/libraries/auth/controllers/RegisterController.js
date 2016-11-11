'use strict';

RegisterController.$inject = ['$rootScope', '$state', 'AuthService'];

function RegisterController($rootScope, $state, AuthService) {
    let controller = this;
	controller.credentials = {};

    controller.invalidUsername = false;
    controller.invalidEmail = false;
    controller.invalidPassword = false;

    controller.register = register;
	controller.checkPasswords = checkPasswords;

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

	function checkPasswords() {
		if (controller.credentials.password !== controller.passwordRepeat) {
			controller.invalidPassword = true;
			return false;
		} else {
			controller.invalidPassword = false;
			return true;
		}
	}

    function register(credentials) {
		return AuthService.register(credentials)
            .then(function(response) {
                $state.go('dashboard', {'playerId': response.data.id});
            })
            .catch(function(response) {
				if (response.data.message === "Username taken") {
					controller.invalidUsername = true;
				    controller.invalidEmail = false;
				} else if (response.data.message === 'Email taken') {
					controller.invalidUsername = false;
				    controller.invalidEmail = true;
				}
				return response;
            });
    }
}

module.exports = RegisterController;
