'use strict';

OrderListController.$inject = ['$state', '$rootScope', 'AdminService', '$scope'];
function OrderListController($state, $rootScope, AdminService, $scope) {
    let controller = this;

    controller.pageSize = '20';
    controller.selectedSort = '-createdAt';

    init();

    ///////////////////////////////

    function init() {
        AdminService.getAllOrders()
            .then(function(orders) {
                controller.orders = orders;
                controller.order = (orders[0] ? orders[0] : {});
            });
    }
}

module.exports = OrderListController;
