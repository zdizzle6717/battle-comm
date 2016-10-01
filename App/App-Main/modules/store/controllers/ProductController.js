'use strict';

ProductController.$inject = ['ngCart', '$stateParams', 'StoreService'];

function ProductController(ngCart, $stateParams, StoreService) {
    let controller = this;

    StoreService.getProduct($stateParams.id)
        .then(function(response) {
            controller.product = response;
        });
}

module.exports = ProductController;
