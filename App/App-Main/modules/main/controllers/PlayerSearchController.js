'use strict';

PlayerSearchController.$inject = ['$rootScope', '$state', '$stateParams', 'PlayerService', 'AuthService'];
function PlayerSearchController($rootScope, $state, $stateParams, PlayerService, AuthService) {
    let controller = this;

	controller.search = search;
	controller.results = [];
	controller.criteria = {
		maxResults: 20,
		query: ''
	}

    ///////////////////////////////////////////

	function search() {
		PlayerService.searchPlayers(controller.criteria).then((response) => {
			controller.results = response;
		}).catch((response) => {
			console.log('Invalid search criteria');
		})
	}

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = PlayerSearchController;
