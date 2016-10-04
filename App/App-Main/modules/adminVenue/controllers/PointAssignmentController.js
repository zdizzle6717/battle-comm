'use strict';

PointAssignmentController.$inject = ['$rootScope', '$state', 'VenueService'];
function PointAssignmentController($rootScope, $state, VenueService) {
    let controller = this;

	controller.submitPoints = submitPoints;
	controller.addPlayer = addPlayer;
	controller.removePlayer = removePlayer;
	controller.players = [
		{
			fullName: '',
			email: '',
			pointsEarned: 0
		}
	];

    ///////////////////////////////////////////

	function addPlayer() {
		controller.players.push({
			fullName: '',
			email: '',
			pointsEarned: 0
		});
	}

	function removePlayer(index) {
		controller.players.splice(index, 1);
	}

	function submitPoints() {
		VenueService.assignPoints(controller.venueEvent, controller.players)
		.then(function(response) {
			showAlert({
				type: 'success',
				message: response
			});
			$state.go('dashboard');
		});
	}

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message, timeout: 4000});
    }

}

module.exports = PointAssignmentController;
