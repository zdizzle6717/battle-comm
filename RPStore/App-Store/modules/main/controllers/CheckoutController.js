'use strict';

CheckoutController.$inject = ['$state', '$rootScope', 'ngCart', 'StoreService', 'CheckoutService', '$scope'];
function CheckoutController($state, $rootScope, ngCart, StoreService, CheckoutService, $scope) {
    let controller = this;

    let orderDetails = CheckoutService.get();

    controller.completeOrder = completeOrder;
    controller.order = {};
    controller.player = {};
    controller.total = orderDetails.orderTotal;

    init();

    ///////////////////////////////

    function init() {
        let check = CheckoutService.get();
        StoreService.getPlayer()
            .then(function(player) {
                controller.player.id = player.id;
                controller.player.user_points = player.user_points;
                controller.order.userLoginId = player.id;
            });
        if (angular.equals({}, check)) {
            $state.go('products');
        }
    }

    function completeOrder(info) {
        CheckoutService.add(info);
        info = CheckoutService.get();
        info.status = "processing";
        info.userLoginId = +controller.player.id;
        let playerPoints = {
            user_points: controller.player.user_points - info.orderTotal
        };
        if (controller.player.user_points < info.orderTotal) {
            alert('You do not have have enough Reward Points for this purchase.');
            $state.go('cart');
        } else {
            StoreService.createOrder(info)
                .then(function(response) {
                    StoreService.updatePlayer(playerPoints, controller.player.id)
                    .then(function(response) {
                        controller.player.user_points = playerPoints.user_points;
                        $state.go('orderSuccess');
                    })
                    .catch(function(response) {
                        console.log(response);
                    });
                })
                .catch(function(response) {
                    console.log(response);
                });
        }
    }
}

module.exports = CheckoutController;
