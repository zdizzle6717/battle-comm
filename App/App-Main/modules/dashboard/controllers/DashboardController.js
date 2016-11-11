'use strict';

DashboardController.$inject = ['$rootScope', '$state', '$stateParams', 'PlayerService', 'UserPhotoService', 'AuthService'];
function DashboardController($rootScope, $state, $stateParams, PlayerService, UserPhotoService, AuthService) {
    let controller = this;

    controller.readOnly = {
		bio: true,
		links: true,
		contact: true
	};
    controller.toggleEdit = toggleEdit;
    controller.savePlayer = savePlayer;
    controller.savePhoto = savePhoto;
    controller.changePassword = changePassword;
    controller.checkPasswords = checkPasswords;
	controller.logout = logout;

    init();

    ///////////////////////////////////////////

    function init() {
		if ($stateParams.playerId != AuthService.currentUser.id) {
			$state.go('dashboard', {'playerId': AuthService.currentUser.id})
		} else {
			PlayerService.getPlayer(AuthService.currentUser.id)
			.then(function(response) {
				controller.currentUser = response;
				controller.currentUser.totalWins = 0;
				controller.currentUser.totalDraws = 0;
				controller.currentUser.totalLosses = 0;
				if (response.GameSystemRankings.length > 0) {
					for (var i in response.GameSystemRankings) {
						controller.currentUser.totalWins += response.GameSystemRankings[i].totalWins;
						controller.currentUser.totalDraws += response.GameSystemRankings[i].totalDraws;
						controller.currentUser.totalLosses += response.GameSystemRankings[i].totalLosses;
					}
					controller.currentUser.totalPointValue = controller.currentUser.totalWins + (controller.currentUser.totalDraws * .5)
				}
				AuthService.totalNotifications = controller.currentUser.UserNotifications.length;
			}).catch(function() {
				let config = {
					type: 'error',
					message: `Redirect: No player was found with id ${$stateParams.playerId}`
				}
				showAlert(config);
				$state.go('login');
			});
		}
    }

	function logout() {
		AuthService.logout();
		$state.go('login');
	}

    function toggleEdit(section) {
        controller.readOnly[section] = !controller.readOnly[section];
    }

    function savePlayer(section) {
		let data = controller.currentUser;
		if (section) {
			toggleEdit(section);
		}
		let newData = {
			bio: data.bio,
			icon: data.icon,
			facebook: data.facebook,
			twitter: data.twitter,
			instagram: data.instagram,
			googlePlus: data.googlePlus,
			twitch: data.twitch,
			website: data.website,
			firstName: data.firstName,
			lastName: data.lastName,
			mainPhone: data.mainPhone,
			streetAddress: data.streetAddress,
			aptSuite: data.aptSuite,
			city: data.city,
			state: data.state,
			zip: data.zip
		}
        PlayerService.updatePlayer(controller.currentUser.id, newData)
        .then(function(response) {
            controller.currentPlayer = response;
			AuthService.currentUser = {
				firstName: response.firstName,
				lastName: response.lastName,
				icon: response.icon,
				email: response.email
			};
            showAlert({
                type: 'success',
                message: 'Your profile was successfully updated.'
            });
        })
		.catch(function(response) {
			showAlert({
                type: 'error',
                message: 'Oops, something went wrong. Double check that all entries are valid.'
            });
		});
    }

	function savePhoto() {
		let data = {
			'UserId': controller.currentUser.id,
			'url': controller.newPhoto
		};
		UserPhotoService.create(data).then(function(response) {
			$state.go('dashboard', {'playerId': controller.currentUser.id}, {'reload': true})
		})
		.catch(function(response) {
			showAlert({
				type: 'error',
				message: 'Oops, something went wrong. Double check that all entries are valid.'
			});
		});;
	}

	function checkPasswords() {
		if (controller.currentUser.newPassword !== controller.newPasswordRepeat) {
			controller.invalidPassword = true;
			return false;
		} else {
			controller.invalidPassword = false;
			return true;
		}
	}

	function changePassword() {
		let credentials = {
			id: controller.currentUser.id,
			username: controller.currentUser.email,
			password: controller.currentUser.password,
			newPassword: controller.currentUser.newPassword
		}

		AuthService.changePassword(credentials).then((response) => {
			showAlert({
				type: 'success',
				message: 'Your password was successfully changed. Please login with the new password.'
			});
			logout();
		}).catch((response) => {
			if (response.data.message === 'Incorrect password!') {
				showAlert({
	                type: 'error',
	                message: 'Incorrect Password: Please re-enter your current password and try again.'
	            });
			}
		})
	}

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = DashboardController;
