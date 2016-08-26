'use strict';

NewsListController.$inject = ['$state', '$rootScope', 'NewsService', '$scope'];
function NewsListController($state, $rootScope, NewsService, $scope) {
    let controller = this;

    controller.pageSize = '20';
    controller.selectedSort = '-updatedAt';

    init();

    ///////////////////////////////

    function init() {
        NewsService.getAllPosts()
            .then(function(response) {
                controller.allPosts = response;
            });
    }

}

module.exports = NewsListController;
