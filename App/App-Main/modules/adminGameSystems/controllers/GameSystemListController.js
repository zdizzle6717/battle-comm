'use strict';

GameSystemListController.$inject = ['$state', '$rootScope', 'GameSystemService', '$scope'];
function GameSystemListController($state, $rootScope, GameSystemService, $scope) {
    let controller = this;

    controller.pageSize = '20';
    controller.selectedSort = '-updatedAt';

    init();

    ///////////////////////////////

    function init() {
        GameSystemService.getAllPosts()
            .then(function(response) {
                controller.allPosts = response;
            });
    }

}

module.exports = GameSystemListController;
