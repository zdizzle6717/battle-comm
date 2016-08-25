'use strict';

NewsController.$inject = ['NewsService', '$stateParams'];
function NewsController(NewsService, $stateParams) {
    let controller = this;

    init();

    /////////////////////////////////

    function init() {
        if ($stateParams.id) {
            NewsService.get($stateParams.id)
            .then(function(response) {
                controller.post = response;
            })
        } else {
            NewsService.getAll()
            .then(function(response) {
                controller.allPosts = response;
            })
        }
    }


}

module.exports = NewsController;
