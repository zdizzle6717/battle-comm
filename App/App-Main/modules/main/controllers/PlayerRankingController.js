'use strict';

PlayerRankingController.$inject = ['$rootScope', '$state', '$stateParams', 'RankingService', 'GameSystemService', 'AuthService'];
function PlayerRankingController($rootScope, $state, $stateParams, RankingService, GameSystemService, AuthService) {
    let controller = this;

	controller.getFactions = getFactions;
	controller.searchRankings = searchRankings;
	controller.results = [];
	controller.criteria = {
		maxResults: 20,
		query: ''
	}
	controller.rankingHeader = 'Overall';

	init();

    ///////////////////////////////////////////

	function init() {
		GameSystemService.getAllGameSystems().then((response) => {
			controller.gameSystems = response;
		})

		if ($stateParams.gameSystemId && $stateParams.factionId) {
			controller.GameSystemId = $stateParams.gameSystemId
			controller.FactionId = $stateParams.factionId
			let config = {
				GameSystemId: $stateParams.gameSystemId,
				FactionId: $stateParams.factionId
			}
			searchRankings();
		}
	}

	function searchRankings() {
		let config = {
			GameSystemId: controller.GameSystemId,
			FactionId: controller.FactionId
		}
		RankingService.searchRankings(config).then((response) => {
			controller.results = response;
			if (response.length > 0) {
				controller.rankingHeader = response[0].GameSystem.name + ' (' + response[0].Faction.name + ')';
			}
		}).catch((response) => {
			console.log('Invalid search criteria');
		})
	}

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
