'use strict';

NewsService.$inject = ['API_ROUTES', '$http'];
function NewsService(API_ROUTES, $http) {
    let service = {
        get: get,
        getAll: getAll
    };

    let routes = API_ROUTES.news;

    return service;

    ///////////////////////

    function get(id) {
        let args = {
            method: 'GET',
            url: routes.get + id
        };

        return $http(args)
        .then(function(response) {
            return response.data;
        });
    }

    function getAll() {
        let args = {
            method: 'GET',
            url: routes.getAll
        };

        return $http(args)
        .then(function(response) {
            return response.data;
        });
    }

}

module.exports = NewsService;
