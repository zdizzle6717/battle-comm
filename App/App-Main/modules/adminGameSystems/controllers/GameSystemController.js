'use strict';

GameSystemController.$inject = ['$rootScope', '$state', '$stateParams', 'GameSystemService', 'ManufacturerService', 'FactionService', 'AuthService'];
function GameSystemController($rootScope, $state, $stateParams, GameSystemService, ManufacturerService, FactionService, AuthService) {
    let controller = this;

    controller.readOnly = true;
    controller.editGameSystem = editGameSystem;
    controller.saveGameSystem = saveGameSystem;
    controller.removeGameSystem = removeGameSystem;
	controller.addFaction = addFaction;
	controller.removeFaction = removeFaction;
    controller.showDeleteModal = showDeleteModal;
    controller.hideDeleteModal = hideDeleteModal;

    init();

    ///////////////////////////////////////////

    function init() {
		ManufacturerService.getAllManufacturers().then((response) => {
			controller.manufacturers = response;
		}).then(() => {
			if ($stateParams.id) {GameSystemService.getGameSystem($stateParams.id)
	            .then(function(response) {
	                controller.currentGameSystem = response;
	                controller.readOnly = true;
	                controller.isNew = false;
					controller.manufacturer = response.Manufacturer;
	            });
	        } else {
	            controller.currentGameSystem = {};
	            controller.readOnly = false;
	            controller.isNew = true;
	        }
		});

    }

    function editGameSystem() {
        controller.readOnly = false;
    }

    function saveGameSystem(data) {
        if ($stateParams.id) {
            controller.readOnly = true;
			data.ManufacturerId = controller.manufacturer.id;
			delete data.UserRankingId;
			delete data.Manufacturer;
			delete data.Factions;
            GameSystemService.updateGameSystem($stateParams.id, data)
            .then(function(response) {
                controller.currentGameSystem = response;
				$state.go('gameSystem', {'id': controller.currentGameSystem.id}, {reload: true})
                showAlert({
                    type: 'success',
                    message: 'This Game System was successfully updated.'
                });
            });
        }
        else {
			data.ManufacturerId = controller.manufacturer.id;
            GameSystemService.createGameSystem(data)
            .then(function(response) {
                showAlert({
                    type: 'success',
                    message: 'A new Game System was successfully created.'
                });
                $state.go('gameSystem', {id: response.id});
            });
        }
    }

    function removeGameSystem(id) {
        GameSystemService.removeGameSystem(id)
        .then(function() {
            showAlert({
                type: 'success',
                message: 'Game System was successfully deleted.'
            });
            $state.go('gameSystemList');
        });
    }

	function addFaction() {
		let config = {
			GameSystemId: controller.currentGameSystem.id,
			name: controller.faction.name
		}
		FactionService.createFaction(config).then((response) => {
			controller.currentGameSystem.Factions.push(response);
			showAlert({
				type: 'success',
				message: 'A faction was successfully added to this game system.',
				timeout: 1000
			});
		})
	}

	function removeFaction(id, index) {
		FactionService.removeFaction(id).then(() => {
			controller.currentGameSystem.Factions.splice(index, 1);
			showAlert({
				type: 'success',
				message: 'A faction was successfully deleted.',
				timeout: 1000
			});
		})
	}

    function showDeleteModal(id) {
        $rootScope.$broadcast('show:modal', {
            id: id,
            toggle: true
        });
    }

    function hideDeleteModal() {
        $rootScope.$broadcast('show:modal', { toggle: false });
    }

    function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message, timeout: config.timeout});
    }
}

module.exports = GameSystemController;
