'use strict';

FactionService.$inject = ['API_ROUTES', '$http'];
function FactionService(API_ROUTES, $http) {
    let service = {
        createFaction: createFaction,
        updateFaction: updateFaction,
        removeFaction: removeFaction
    };

    let routes = API_ROUTES.factions;

    return service;

    ///////////////////////

    function createFaction(data) {
        let args = {
            method: 'POST',
            url: routes.create,
            data: cleanData(data)
        };

        return $http(args)
            .then((response) => {
                let post = response.data;
                return post;
            });
    }

    function updateFaction(id, data) {
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

    function removeFaction(id, data) {
        let args = {
            method: 'DELETE',
            url: routes.remove + id,
            data: data
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

module.exports = FactionService;
