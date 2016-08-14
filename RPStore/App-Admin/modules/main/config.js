'use strict';

config.$inject = ['$stateProvider', '$urlRouterProvider', '$httpProvider'];

function config($stateProvider, $urlRouterProvider, $httpProvider) {
    $httpProvider.useApplyAsync(true);

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

    $urlRouterProvider.otherwise("/orderList");
}

module.exports = config;
