'use strict';

CartController.$inject = ['$scope', '$state', 'ngCart', 'StoreService', 'CheckoutService'];
function CartController($scope, $state, ngCart, StoreService, CheckoutService) {
    $scope.ngCart = ngCart;
    $scope.goToCheckout = goToCheckout;

    function goToCheckout(data) {
        CheckoutService.sortItems(data);
        $state.go('checkout');
    }
}

module.exports = CartController;
