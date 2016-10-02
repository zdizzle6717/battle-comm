'use strict';

NotificationService.$inject = ['API_ROUTES', '$http'];
function NotificationService(API_ROUTES, $http) {
    let service = {
        create: create,
        update: update,
        remove: remove
    };

    let routes = API_ROUTES.notifications;

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

	function remove(id, data) {
        let args = {
            method: 'DELETE',
            url: routes.remove + id,
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

module.exports = NotificationService;
