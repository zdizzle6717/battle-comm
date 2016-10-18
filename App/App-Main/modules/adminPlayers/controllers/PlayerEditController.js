'use strict';

PlayerEditController.$inject = ['$rootScope', '$state', '$stateParams', 'PlayerService', 'GameSystemService', 'RankingService'];
function PlayerEditController($rootScope, $state, $stateParams, PlayerService, GameSystemService, RankingService) {
    let controller = this;

    controller.readOnly = true;
    controller.editPlayer = editPlayer;
    controller.savePlayer = savePlayer;
	controller.updateRanking = updateRanking;
	controller.getFactions = getFactions;

    init();

    ///////////////////////////////////////////

    function init() {
        if ($stateParams.userId) {
			PlayerService.getPlayer($stateParams.userId)
            .then(function(response) {
                controller.currentPlayer = response;
				controller.newRanking = {
					UserId: controller.currentPlayer.id
				};
                controller.readOnly = true;
                controller.isNew = false;
				controller.currentPlayer.rewardPoints = controller.currentPlayer.rewardPoints ? controller.currentPlayer.rewardPoints : 0;
            })
			.catch(function() {
				$state.go('playerList');
			});
			GameSystemService.getAllGameSystems().then((response) => {
				controller.gameSystems = response;
			})
        } else {
            $state.go('playerList');
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

	function updateRanking() {
		RankingService.create(controller.newRanking).then(() => {
			$state.go('player', {'userId': controller.currentPlayer.id}, {reload: true});
		});
	}

	function getFactions() {
		GameSystemService.getGameSystem(controller.newRanking.GameSystemId).then((response) => {
			controller.factions = response.Factions;
		});
	}

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = PlayerEditController;
