'use strict';

FriendService.$inject = ['API_ROUTES', '$http'];
function FriendService(API_ROUTES, $http) {
    let service = {
        create: create,
        remove: remove
    };

    let routes = API_ROUTES.friends;

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

    function remove(data) {
        let args = {
            method: 'DELETE',
            url: routes.remove,
            data: data
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

module.exports = FriendService;
