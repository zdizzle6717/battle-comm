'use strict';

ngcartCart.$inject = [];
function ngcartCart() {
    return {
        restrict : 'E',
        controller : 'CartController',
        scope: {},
        template: require('./templates/cart.php'),
        link:function(scope, element, attrs){
        }
    };
}

module.exports = ngcartCart;
