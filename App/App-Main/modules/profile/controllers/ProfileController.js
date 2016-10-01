'use strict';

ProfileController.$inject = ['$rootScope', '$state', '$stateParams', 'AuthService', 'PlayerService'];
function ProfileController($rootScope, $state, $stateParams, AuthService, PlayerService) {
    let controller = this;

    controller.readOnly = true;

	init();

    ///////////////////////////////////////////

	function init() {
		if ($stateParams.playerId) {
			PlayerService.getPlayer($stateParams.playerId).then(function(response) {
				controller.currentUser = response;
				controller.currentUser.icon = controller.currentUser.icon ? controller.currentUser.icon : 'profile_image_default.png';
				controller.readOnly = true;
				controller.isNew = false;
			}).catch(function() {
				let config = {
					type: 'error',
					message: `Redirect: No player was found with id ${$stateParams.playerId}`
				}
				showAlert(config);
				$state.go('dashboard', {playerId: AuthService.currentUser.id});
			});
		} else {
			$state.go('login');
		}
	};

	function showAlert(config) {
		$rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
	}

}

module.exports = ProfileController;
