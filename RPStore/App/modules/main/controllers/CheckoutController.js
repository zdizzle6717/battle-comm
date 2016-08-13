'use strict';

CheckoutController.$inject = ['$state', '$rootScope', 'ngCart', 'StoreService', 'CheckoutService', '$scope'];
function CheckoutController($state, $rootScope, ngCart, StoreService, CheckoutService, $scope) {
    let controller = this;

    let orderDetails = CheckoutService.get();

    controller.completeOrder = completeOrder;
    controller.order = {};
    controller.player = {};
    controller.total = orderDetails.orderTotal

    init();

    ///////////////////////////////

    function init() {
        let check = CheckoutService.get();
        StoreService.getPlayer()
            .then(function(player) {
                controller.player.id = player.id;
                controller.player.user_points = player.user_points;
                controller.order.customerId = player.id;
            });
        if (angular.equals({}, check)) {
            $state.go('products');
        }
    }

    function completeOrder(info) {
        info.status = "processing";
        CheckoutService.add(info);
        info = CheckoutService.get();
        info.customerId = controller.player.id;
        if (controller.player.user_points < info.orderTotal) {
            alert('You do not have have enough Reward Points for this purchase.');
            $state.go('cart');
        } else {
            controller.player.user_points = controller.player.user_points - info.orderTotal;
            StoreService.updatePlayer(controller.player);
            StoreService.createOrder(info)
                .then(function(response) {
                    return response;
                });
            $state.go('orderSuccess');
        }
    }
}

module.exports = CheckoutController;
