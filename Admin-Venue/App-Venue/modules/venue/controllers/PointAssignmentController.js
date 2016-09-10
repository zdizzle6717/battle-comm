'use strict';

PointAssignmentController.$inject = ['$rootScope', '$state', 'VenueService'];
function PointAssignmentController($rootScope, $state, VenueService) {
    let controller = this;

	controller.submitPoints = submitPoints;
	controller.players = [];

    ///////////////////////////////////////////

	function submitPoints() {
		VenueService.assignPoints(controller.venueEvent, controller.players)
		.then(function(response) {
			showAlert({
				type: 'success',
				message: response
			});
			$state.go('venueAdmin');
		});
	}

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message, timeout: 4000});
    }

}

module.exports = PointAssignmentController;
