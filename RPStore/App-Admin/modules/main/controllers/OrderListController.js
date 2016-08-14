'use strict';

OrderListController.$inject = ['$state', '$rootScope', 'AdminService', '$scope'];
function OrderListController($state, $rootScope, AdminService, $scope) {
    let controller = this;

    controller.pageSize = '20';
    controller.selectedSort = '-created';

    ///////////////////////////////

    $rootScope.$on('$stateChangeStart', function() {
        AdminService.getAllOrders()
                .then(function(orders) {
                    controller.orders = orders;
                    controller.order = (orders[0] ? orders[0] : {});
                });
        $scope.apply();
    });

    AdminService.getAllOrders()
            .then(function(orders) {
                controller.orders = orders;
                controller.order = (orders[0] ? orders[0] : {});
            });
            
    controller.viewOrder = function(id) {
        AdminService.getOrder(id)
            .then(function() {
                $state.go('order', {
                    id: id
                });
            });
    };
}

module.exports = OrderListController;
