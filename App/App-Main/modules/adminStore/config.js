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
          url: "/admin/store/all-orders",
          template: require('./views/orderList.php'),
          controller: 'OrderListController as Order'
        })
        .state('order', {
          url: "/admin/store/orders/:id",
          template: require('./views/order.php'),
          controller: 'OrderController as Order'
        })
        .state('productList', {
          url: "/admin/store/all-products",
          template: require('./views/productList.php'),
          controller: 'ProductListController as Product'
        })
        .state('product', {
          url: "/admin/store/products/:id",
          template: require('./views/product.php'),
          controller: 'ProductController as Product'
      });

}

module.exports = config;
