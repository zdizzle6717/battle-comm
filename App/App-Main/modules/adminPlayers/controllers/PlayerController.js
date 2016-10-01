'use strict';

PlayerController.$inject = ['$rootScope', '$state', '$stateParams', 'PlayerService'];
function PlayerController($rootScope, $state, $stateParams, PlayerService) {
    let controller = this;

    controller.readOnly = true;
    controller.editPlayer = editPlayer;
    controller.savePlayer = savePlayer;

    init();

    ///////////////////////////////////////////

    function init() {
        if ($stateParams.userId) {PlayerService.getPlayer($stateParams.userId)
            .then(function(response) {
                controller.currentPlayer = response;
                controller.readOnly = true;
                controller.isNew = false;
            })
			.catch(function() {
				$state.go('playerList');
			});
        } else {
            controller.readOnly = false;
            controller.isNew = true;
        }
    }

    function editPlayer() {
        controller.readOnly = false;
    }

    function savePlayer(data) {
		let newData = {
			firstName: data.firstName,
			lastName: data.lastName,
			email: data.email,
			username: data.username,
			rewardPoints: data.rewardPoints,
			subscriber: data.subscriber,
			tourneyAdmin: data.tourneyAdmin,
			eventAdmin: data.eventAdmin,
			venueAdmin: data.venueAdmin,
			clubAdmin: data.clubAdmin,
			systemAdmin: data.systemAdmin
		}
        if ($stateParams.userId) {
            controller.readOnly = true;
            PlayerService.updatePlayer($stateParams.userId, newData)
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
                $state.go('player', {'userId': response.id}, {reload: true});
            });
        }
    }

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = PlayerController;
