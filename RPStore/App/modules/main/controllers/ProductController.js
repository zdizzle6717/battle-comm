'use strict';

ProductController.$inject = ['ngCart', '$stateParams', 'StoreService'];

function ProductController(ngCart, $stateParams, StoreService) {
    let controller = this;

    controller.product = {};

    StoreService.getProduct($stateParams.id)
        .then(function(product) {
            controller.product = product;
        });
}

module.exports = ProductController;
