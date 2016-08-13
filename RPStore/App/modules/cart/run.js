'use strict';

run.$inject = ['$rootScope', 'ngCart','ngCartItem', 'store'];
function run($rootScope, ngCart, ngCartItem, store) {
    $rootScope.$on('ngCart:change', function(){
        ngCart.$save();
    });

    if (angular.isObject(store.get('cart'))) {
        ngCart.$restore(store.get('cart'));

    } else {
        ngCart.init();
    }
}

module.exports = run;
