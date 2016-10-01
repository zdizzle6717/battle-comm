'use strict';

ProfileService.$inject = ['API_ROUTES', '$http'];
function ProfileService(API_ROUTES, $http) {
    let service = {
		getUser: getUser,
        getPlayer: get,
        getAllPlayers: getAll,
        updatePlayer: updatePlayer
    };

    let routes = API_ROUTES.players;

    return service;

    ///////////////////////

	function getUser() {
        let args = {
            method: 'GET',
            url: '../dmxDatabaseSources/PlayerProfileEdit.php'
        };

        return $http(args)
            .then((response) => {
                let player = response.data.data[0];
                return player;
            });
    }

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

    function updatePlayer(id, data) {
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

    function cleanData(obj) {
        let newData = angular.copy(obj);
        delete newData.id;
        delete newData.createdAt;
        delete newData.updatedAt;
        return newData;
    }

}

module.exports = ProfileService;
