'use strict';

ManufacturerController.$inject = ['$rootScope', '$state', '$stateParams', 'ManufacturerService', 'AuthService'];
function ManufacturerController($rootScope, $state, $stateParams, ManufacturerService, AuthService) {
    let controller = this;

    controller.readOnly = true;
    controller.editManufacturer = editManufacturer;
    controller.saveManufacturer = saveManufacturer;
    controller.removeManufacturer = removeManufacturer;
    controller.showDeleteModal = showDeleteModal;
    controller.hideDeleteModal = hideDeleteModal;

    init();

    ///////////////////////////////////////////

    function init() {
        if ($stateParams.id) {ManufacturerService.getManufacturer($stateParams.id)
            .then(function(response) {
                controller.currentManufacturer = response;
                controller.readOnly = true;
                controller.isNew = false;
            });
        } else {
            controller.currentManufacturer = {};
            controller.readOnly = false;
            controller.isNew = true;
        }
    }

    function editManufacturer() {
        controller.readOnly = false;
    }

    function saveManufacturer(data) {
        if ($stateParams.id) {
            controller.readOnly = true;
			delete data.GameSystems;
            ManufacturerService.updateManufacturer($stateParams.id, data)
            .then(function(response) {
                controller.currentManufacturer = response;
                showAlert({
                    type: 'success',
                    message: 'This manufacturer was successfully updated.'
                });
            });
        }
        else {
            ManufacturerService.createManufacturer(data)
            .then(function(response) {
                showAlert({
                    type: 'success',
                    message: 'A new manufacturer was successfully created.'
                });
                $state.go('manufacturer', {id: response.id});
            });
        }
    }

    function removeManufacturer(id) {
        ManufacturerService.removeManufacturer(id)
        .then(function() {
            showAlert({
                type: 'success',
                message: 'Manufacturer was successfully deleted.'
            });
            $state.go('manufacturerList');
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

module.exports = ManufacturerController;
