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
          url: "/order/:orderId",
          template: require('./views/order.php'),
          controller: 'OrderController as Order'
        })
        .state('addProduct', {
          url: "/add-product/:productId",
          template: require('./views/addProduct.php'),
          controller: 'ProductController as Product'
        });

    $urlRouterProvider.otherwise("/orderList");
}

module.exports = config;
