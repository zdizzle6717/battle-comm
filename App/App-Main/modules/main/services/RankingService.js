'use strict';

RankingService.$inject = ['API_ROUTES', '$http'];
function RankingService(API_ROUTES, $http) {
    let service = {
        create: create,
        update: update
    };

    let routes = API_ROUTES.rankings;

    return service;

    ///////////////////////

    function create(data) {
        let args = {
            method: 'POST',
            url: routes.create,
            data: data
        };

        return $http(args)
            .then((response) => {
                return response.data;
            });
    }

    function update(id, data) {
        let args = {
            method: 'PUT',
            url: routes.update + id,
            data: cleanData(data)
        };

        return $http(args)
            .then((response) => {
                let post = response.data;
                return post;
            });
    }

    function cleanData(obj) {
        let newData = angular.copy(obj);
        delete newData.id;
        delete newData.createdAt;
        delete newData.updatedAt;
        return newData;
    }

}

module.exports = RankingService;
