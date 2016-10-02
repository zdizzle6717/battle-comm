'use strict';

NotificationsController.$inject = ['$rootScope', '$state', '$stateParams', 'PlayerService', 'AuthService'];
function NotificationsController($rootScope, $state, $stateParams, PlayerService, AuthService) {
    let controller = this;

    init();

    ///////////////////////////////////////////

    function init() {
		if ($stateParams.playerId != AuthService.currentUser.id) {
			$state.go('dashboard', {'playerId': AuthService.currentUser.id})
		} else {
			PlayerService.getPlayer(AuthService.currentUser.id)
			.then(function(response) {
				console.log('Get Notifications')
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


	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = NotificationsController;
