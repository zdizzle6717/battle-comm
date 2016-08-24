'use strict';

NewsService.$inject = ['API_ROUTES', '$http'];
function NewsService(API_ROUTES, $http) {
    let service = {
        getPost: get,
        getAllNews: getAll
    };

    let routes = API_ROUTES.news;

    return service;

    ///////////////////////

    function getPost(id) {
        let args = {
            method: 'GET',
            url: routes.get
        };

        $http();
    }

    function getAllNews() {
        let args = {
            method: 'GET',
            url: routes.getAll
        };

        $http();
    }

}

module.exports = NewsService;
