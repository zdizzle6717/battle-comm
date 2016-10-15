'use strict';

ManufacturerListController.$inject = ['$state', '$rootScope', 'ManufacturerService', '$scope'];
function ManufacturerListController($state, $rootScope, ManufacturerService, $scope) {
    let controller = this;

    controller.pageSize = '20';
    controller.selectedSort = '-updatedAt';

    init();

    ///////////////////////////////

    function init() {
        ManufacturerService.getAllPosts()
            .then(function(response) {
                controller.allPosts = response;
            });
    }

}

module.exports = ManufacturerListController;
