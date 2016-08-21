'use strict';

OrderController.$inject = ['$state', '$stateParams', '$rootScope', 'AdminService'];
function OrderController($state, $stateParams, $rootScope, AdminService) {
    let controller = this;

    controller.currentOrder = {};
    controller.readOnly = true;
    controller.edit = edit;
    controller.save = save;
    controller.complete = complete;

    AdminService.getOrder($stateParams.id)
        .then(function(order) {
            controller.currentOrder = order;
        });

    function edit() {
        controller.readOnly = false;
    }

    function save(data, form) {
        if (form.$valid) {
            controller.readOnly = true;
            AdminService.updateOrder($stateParams.id, data);
            showAlert({
                type: 'success',
                message: 'This order was updated successfully.'
            });
        }
        else {
            alert('Please make sure the form is valid')
        }
    }

    function complete(data) {
        data.status = 'completed'
        AdminService.updateOrder($stateParams.id, data);
        showAlert({
            type: 'success',
            message: 'The status of this order is now complete.'
        });
        $state.go('orderList');
    }

    function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }
}

module.exports = OrderController;
