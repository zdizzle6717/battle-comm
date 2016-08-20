'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider', 'LoadingServiceProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider, LoadingServiceProvider) {
    $httpProvider.useApplyAsync(true);
    $httpProvider.defaults.useXDomain = true;
    $httpProvider.defaults.cache = false;
    $httpProvider.defaults.headers.post['Content-Type'] = 'application/json';
    // $httpProvider.defaults.withCredentials = true;

    // Loading
    $httpProvider.interceptors.push(LoadingServiceProvider.interceptor);

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
