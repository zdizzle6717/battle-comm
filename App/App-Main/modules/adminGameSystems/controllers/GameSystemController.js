'use strict';

GameSystemController.$inject = ['$rootScope', '$state', '$stateParams', 'GameSystemService', 'ManufacturerService', 'AuthService'];
function GameSystemController($rootScope, $state, $stateParams, GameSystemService, ManufacturerService, AuthService) {
    let controller = this;

    controller.readOnly = true;
    controller.editGameSystem = editGameSystem;
    controller.saveGameSystem = saveGameSystem;
    controller.removeGameSystem = removeGameSystem;
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
            GameSystemService.updateGameSystem($stateParams.id, data)
            .then(function(response) {
                controller.currentGameSystem = response;
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
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }
}

module.exports = GameSystemController;
