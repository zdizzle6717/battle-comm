'use strict';

PlayerListController.$inject = ['$state', '$rootScope', 'PlayerService', '$scope'];
function PlayerListController($state, $rootScope, PlayerService, $scope) {
    let controller = this;

    controller.pageSize = '20';
    controller.selectedSort = '-updatedAt';

    init();

    ///////////////////////////////

    function init() {
        PlayerService.getAllPlayers()
            .then(function(response) {
                controller.allPlayers = response;
            });
    }

}

module.exports = PlayerListController;
