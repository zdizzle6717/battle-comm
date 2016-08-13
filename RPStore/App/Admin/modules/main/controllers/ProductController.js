'use strict';

ProductController.$inject = ['$state', 'AdminService'];
function ProductController($state, AdminService) {
    let controller = this;

    controller.message = {};
    controller.submit = submit;

    function submit(data) {
        AdminService.createProduct(data)
            .then(function(response) {
                return response;
            });
        $state.go('orders');

    }
}

module.exports = ProductController;
