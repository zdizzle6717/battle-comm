'use strict';

SetNewPasswordController.$inject = ['$state', '$stateParams', '$rootScope', 'AuthService'];
function SetNewPasswordController($state, $stateParams, $rootScope, AuthService) {
	let controller = this;
	controller.setNewPassword = setNewPassword;
	controller.checkPasswords = checkPasswords;

	init();

	///////////////////////////////////

	function init() {
		controller.credentials = {};
		if ($stateParams.token) {
			AuthService.verifyResetToken($stateParams.token).then((response) => {
				controller.credentials.email = response.email;
			}).catch((response) => {
				if (response.data.message = "Invalid token") {
					$state.go('login').then(() => {
						showAlert({
							type: 'error',
							message: 'The link has either expired or is invalid.'
						});
					})
				}
			})
		} else {
			$state.go('login');
		}
	}

	function setNewPassword() {
		AuthService.setNewPassword(controller.credentials, $stateParams.token).then(() => {
			$state.go('login').then(() => {
				showAlert({
	                type: 'success',
	                message: 'Your password was successfully changed. Please login with the new password.'
	            });
			})
		})
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

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }
}

module.exports = SetNewPasswordController;
