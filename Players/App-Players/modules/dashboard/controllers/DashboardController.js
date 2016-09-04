'use strict';

DashboardController.$inject = ['$rootScope', '$state', '$stateParams', 'PlayerService'];
function DashboardController($rootScope, $state, $stateParams, PlayerService) {
    let controller = this;

    controller.readOnly = {
		bio: true,
		links: true,
		contact: true
	};
    controller.toggleEdit = toggleEdit;
    controller.savePlayer = savePlayer;

    init();

    ///////////////////////////////////////////

    function init() {
		PlayerService.getUser()
		.then(function(response) {
			controller.currentUser = response;
		});
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
			user_bio: data.user_bio,
			user_icon: data.user_icon,
			user_facebook: data.user_facebook,
			user_twitter: data.user_twitter,
			user_instagram: data.user_instagram,
			user_twitch: data.user_twitch,
			user_website: data.user_website,
			user_main_phone: data.user_main_phone,
			user_street_address: data.user_street_address,
			user_apt_suite: data.user_apt_suite,
			user_city: data.user_city,
			user_state: data.user_state,
			user_zip: data.user_zip
		}
        PlayerService.updatePlayer(controller.currentUser.id, newData)
        .then(function(response) {
            controller.currentPlayer = response;
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

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = DashboardController;
