'use strict';

PlayerRankingController.$inject = ['$rootScope', '$state', '$stateParams', 'RankingService', 'GameSystemService', 'AuthService'];
function PlayerRankingController($rootScope, $state, $stateParams, RankingService, GameSystemService, AuthService) {
    let controller = this;

	controller.getFactionsAndSearch = getFactionsAndSearch;
	controller.searchByFaction = searchByFaction;
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
			searchByFaction();
		} else if ($stateParams.gameSystemId && !$stateParams.factionId) {
			controller.GameSystemId = $stateParams.gameSystemId
			searchByGameSystem();
		} else {
			controller.GameSystemId = 1;
			searchByGameSystem();
		}
	}

	function searchByGameSystem() {
		let config = {
			GameSystemId: controller.GameSystemId
		}
		RankingService.searchByGameSystem(config).then((response) => {
			controller.results = response;
			controller.byGameSystem = true;
			controller.byFaction = false;
			if (response.length > 0) {
				controller.rankingHeader = response[0].GameSystem.name;
			}
		}).catch((response) => {
			console.log('Invalid search criteria');
		})
	}

	function searchByFaction() {
		let config = {
			FactionId: controller.FactionId
		}
		RankingService.searchByFaction(config).then((response) => {
			controller.results = response;
			controller.byGameSystem = false;
			controller.byFaction = true;
			if (response.length > 0) {
				controller.rankingHeader = response[0].GameSystem.GameSystemRanking.name + ' / ' + response[0].Faction.name;
			}
		}).catch((response) => {
			console.log('Invalid search criteria');
		})
	}

	function getFactionsAndSearch() {
		GameSystemService.getGameSystem(controller.GameSystemId).then((response) => {
			controller.factions = response.Factions;
			searchByGameSystem()
		});
	}

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = PlayerRankingController;
