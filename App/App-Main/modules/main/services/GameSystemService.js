'use strict';

GameSystemService.$inject = ['API_ROUTES', '$http'];
function GameSystemService(API_ROUTES, $http) {
    let service = {
        getGameSystem: get,
        getAllGameSystems: getAll,
        createGameSystem: createGameSystem,
        updateGameSystem: updateGameSystem,
        removeGameSystem: removeGameSystem
    };

    let routes = API_ROUTES.gameSystems;

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

    function createGameSystem(data) {
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

    function updateGameSystem(id, data) {
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

    function removeGameSystem(id, data) {
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

module.exports = GameSystemService;
