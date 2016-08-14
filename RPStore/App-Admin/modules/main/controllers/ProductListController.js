'use strict';

ProductListController.$inject = ['$state', '$rootScope', 'AdminService', '$scope'];
function ProductListController($state, $rootScope, AdminService, $scope) {
    let controller = this;

    controller.pageSize = '20';
    controller.selectedSort = '-updatedAt';

    init();

    ///////////////////////////////

    function init() {
        AdminService.getAllProducts()
            .then(function(response) {
                controller.products = response;
            });
    }

}

module.exports = ProductListController;
