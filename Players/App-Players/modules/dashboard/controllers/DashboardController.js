'use strict';

DashboardController.$inject = ['$rootScope', '$state', '$stateParams', 'PlayerService'];
function DashboardController($rootScope, $state, $stateParams, PlayerService) {
    let controller = this;

    controller.readOnly = true;
    controller.editPlayer = editPlayer;
    controller.savePlayer = savePlayer;

    init();

    ///////////////////////////////////////////

    function init() {
		PlayerService.getUser()
		.then(function(response) {
			controller.currentUser = response;
			controller.readOnly = true;
			controller.isNew = false;
		});
    }

    function editPlayer() {
        controller.readOnly = false;
    }

    function savePlayer(data) {
		let newData = {
			firstName: data.firstName,
			lastName: data.lastName,
			email: data.email,
			user_handle: data.user_handle,
			user_points: data.user_points,
			tourneyAdmin: data.tourneyAdmin,
			EventAdmin: data.EventAdmin,
			venueAdmin: data.venueAdmin,
			clubAdmin: data.clubAdmin,
			siteAdmin: data.siteAdmin
		}
        if ($stateParams.id) {
            controller.readOnly = true;
            PlayerService.updatePlayer($stateParams.id, newData)
            .then(function(response) {
                controller.currentPlayer = response;
                showAlert({
                    type: 'success',
                    message: 'This post was successfully updated.'
                });
            });
        }
        else {
            PlayerService.createPlayer(data)
            .then(function(response) {
                showAlert({
                    type: 'success',
                    message: 'A new post was successfully created.'
                });
                $state.go('post', {id: response.id});
            });
        }
    }

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = DashboardController;
