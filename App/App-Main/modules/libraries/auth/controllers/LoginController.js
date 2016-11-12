'use strict';

LoginController.$inject = ['$rootScope', '$state', 'AuthService'];

function LoginController($rootScope, $state, AuthService) {
    let controller = this;

    controller.incorrectUsername = false;
    controller.incorrectPassword = false;
	controller.resetPassword = resetPassword;
	controller.showSuccessMessage = false;

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

	function resetPassword(email) {
		AuthService.resetPassword(email).then((response) => {
			controller.showSuccessMessage = true;
			controller.resetMessage = 'An e-mail was successfully sent to ' + controller.email
		}).catch((response) => {
			if (response.data.message = 'User not found.') {
				controller.showSuccessMessage = true;
				controller.resetMessage = 'No account was found with the provided e-mail. Please try again.'
			}
		})
	}
}

module.exports = LoginController;
