'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);

    $stateProvider
        .state('products', {
            url: "/products",
            template: require('./views/products.php'),
            controller: 'StoreController as Store'
        })
        .state('product', {
            url: "/products/:id",
            template: require('./views/product.php'),
            controller: 'ProductController as Product'
        })
        .state('cart', {
            url: "/cart",
            template: require('./views/cart.php'),
        })
        .state('checkout', {
            url: "/checkout",
            template: require('./views/checkout.php'),
            controller: 'CheckoutController as Checkout'
        })
        .state('orderSuccess', {
            url: "/order-success",
            template: require('./views/orderSuccess.php'),
        });

    $urlRouterProvider.otherwise("/products");
}

module.exports = config;
