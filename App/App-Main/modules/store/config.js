'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    $stateProvider
        .state('store', {
            url: "/RP-Store",
            template: require('./views/store.php'),
            controller: 'StoreController as Store',
			data: {
  			  accessLevel: ['subscriber']
  		  }
        })
        .state('product', {
            url: "/RP-Store/products/:id",
            template: require('./views/product.php'),
            controller: 'ProductController as Product',
			data: {
  			  accessLevel: ['subscriber']
  		  }
        })
        .state('cart', {
            url: "/RP-Store/cart",
            template: require('./views/cart.php'),
			data: {
  			  accessLevel: ['subscriber']
  		  }
        })
        .state('checkout', {
            url: "/RP-Store/checkout",
            template: require('./views/checkout.php'),
            controller: 'CheckoutController as Checkout',
			data: {
  			  accessLevel: ['subscriber']
  		  }
        })
        .state('orderSuccess', {
            url: "/RP-Store/order-success",
            template: require('./views/orderSuccess.php'),
			data: {
  			  accessLevel: ['subscriber']
  		  }
        });
}

module.exports = config;
