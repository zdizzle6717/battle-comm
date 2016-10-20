'use strict';

RankingService.$inject = ['API_ROUTES', '$http'];
function RankingService(API_ROUTES, $http) {
    let service = {
        createOrUpdate: createOrUpdate,
		searchByGameSystem: searchByGameSystem,
		searchByFaction: searchByFaction
    };

    let routes = API_ROUTES.rankings;

    return service;

    ///////////////////////

    function createOrUpdate(data) {
        let args = {
            method: 'POST',
            url: routes.createOrUpdate,
            data: cleanData(data)
        };

        return $http(args)
            .then((response) => {
                return response.data;
            });
    }

    function searchByGameSystem(criteria) {
        let args = {
            method: 'POST',
            url: routes.searchByGameSystem,
            data: criteria
        };

        return $http(args)
            .then((response) => {
                return response.data;
            });
    }

    function searchByFaction(criteria) {
        let args = {
            method: 'POST',
            url: routes.searchByFaction,
            data: criteria
        };

        return $http(args)
            .then((response) => {
                return response.data;
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
