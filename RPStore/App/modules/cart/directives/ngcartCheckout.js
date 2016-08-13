'use strict';

ngcartCheckout.$inject = [];
function ngcartCheckout() {
    return {
        restrict : 'E',
        controller : ('CartController', ['$rootScope', '$scope', 'ngCart', 'fulfilmentProvider', function($rootScope, $scope, ngCart, fulfilmentProvider) {
            $scope.ngCart = ngCart;

            $scope.checkout = function () {
                fulfilmentProvider.setService($scope.service);
                fulfilmentProvider.setSettings($scope.settings);
                fulfilmentProvider.checkout()
                    .success(function (data, status, headers, config) {
                        $rootScope.$broadcast('ngCart:checkout_succeeded', data);
                    })
                    .error(function (data, status, headers, config) {
                        $rootScope.$broadcast('ngCart:checkout_failed', {
                            statusCode: status,
                            error: data
                        });
                    });
            };
        }]),
        scope: {
            service:'@',
            settings:'='
        },
        transclude: true,
        template: require('./templates/checkout.php')
    };
}

module.exports = ngcartCheckout;
