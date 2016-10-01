'use strict';

CheckoutController.$inject = ['$state', '$rootScope', 'ngCart', 'StoreService', 'CheckoutService', 'AuthService', '$scope'];
function CheckoutController($state, $rootScope, ngCart, StoreService, CheckoutService, AuthService, $scope) {
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
        StoreService.getPlayer(AuthService.currentUser.id)
            .then(function(player) {
                controller.player.id = player.id;
                controller.player.rewardPoints = player.rewardPoints;
                controller.order.UserId = player.id;
            });
        if (angular.equals({}, check)) {
            $state.go('store');
        }
    }

    function completeOrder(info) {
        CheckoutService.add(info);
        info = CheckoutService.get();
        info.status = "processing";
        info.UserId = +controller.player.id;
        let playerPoints = {
            rewardPoints: controller.player.rewardPoints - info.orderTotal
        };
        if (controller.player.rewardPoints < info.orderTotal) {
            alert('You do not have have enough Reward Points for this purchase.');
            $state.go('cart');
        } else {
            StoreService.createOrder(info)
                .then(function(response) {
                    StoreService.updatePlayer(playerPoints, controller.player.id)
                    .then(function(response) {
                        controller.player.rewardPoints = playerPoints.rewardPoints;
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
