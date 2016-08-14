'use strict';

OrderController.$inject = ['$state', '$stateParams', 'AdminService'];
function OrderController($state, $stateParams, AdminService) {
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
        }
        else {
            alert('Please make sure the form is valid')
        }
    }

    function complete(data) {
        data.status = 'completed'
        AdminService.updateOrder($stateParams.id, data);
        $state.go('orderList');
    }
}

module.exports = OrderController;
