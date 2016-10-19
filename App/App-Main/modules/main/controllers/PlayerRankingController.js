'use strict';

PlayerRankingController.$inject = ['$rootScope', '$state', '$stateParams', 'RankingService', 'GameSystemService', 'AuthService'];
function PlayerRankingController($rootScope, $state, $stateParams, RankingService, GameSystemService, AuthService) {
    let controller = this;

	controller.getFactions = getFactions;
	controller.search = search;
	controller.results = [];
	controller.criteria = {
		maxResults: 20,
		query: ''
	}

    ///////////////////////////////////////////

	function search() {
		let config = {
			GameSystemId: controller.GameSystemId,
			FactionId: controller.FactionId
		}
		RankingService.searchRankings(config).then((response) => {
			controller.results = response;
		}).catch((response) => {
			console.log('Invalid search criteria');
		})
	}

	GameSystemService.getAllGameSystems().then((response) => {
		controller.gameSystems = response;
	})

	function getFactions() {
		GameSystemService.getGameSystem(controller.GameSystemId).then((response) => {
			controller.factions = response.Factions;
		});
	}

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = PlayerRankingController;
