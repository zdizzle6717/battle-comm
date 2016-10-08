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

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = DashboardController;
