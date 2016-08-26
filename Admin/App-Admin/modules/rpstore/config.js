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
        .state('orderList', {
          url: "/orderList",
          template: require('./views/orderList.php'),
          controller: 'OrderListController as Order'
        })
        .state('order', {
          url: "/order/:id",
          template: require('./views/order.php'),
          controller: 'OrderController as Order'
        })
        .state('productList', {
          url: "/productList",
          template: require('./views/productList.php'),
          controller: 'ProductListController as Product'
        })
        .state('product', {
          url: "/product/:id",
          template: require('./views/product.php'),
          controller: 'ProductController as Product'
      });

}

module.exports = config;
