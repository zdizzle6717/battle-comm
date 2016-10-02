'use strict';

PlayerService.$inject = ['API_ROUTES', '$http'];
function PlayerService(API_ROUTES, $http) {
    let service = {
        getPlayer: get,
        getAllPlayers: getAll,
        updatePlayer: update,
		searchPlayers: search
    };

    let routes = API_ROUTES.players;

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

    function update(id, data) {
        let args = {
            method: 'PATCH',
            url: routes.update + id,
            data: cleanData(data)
        };

        return $http(args)
            .then((response) => {
                let post = response.data;
                return post;
            });
    }

    function search(criteria) {
        let args = {
            method: 'POST',
            url: routes.search,
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

module.exports = PlayerService;
