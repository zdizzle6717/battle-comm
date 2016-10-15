'use strict';

ManufacturerService.$inject = ['API_ROUTES', '$http'];
function ManufacturerService(API_ROUTES, $http) {
    let service = {
        getManufacturer: get,
        getAllManufacturers: getAll,
        createManufacturer: createManufacturer,
        updateManufacturer: updateManufacturer,
        removeManufacturer: removeManufacturer
    };

    let routes = API_ROUTES.manufacturers;

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

    function createManufacturer(data) {
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

    function updateManufacturer(id, data) {
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

    function removeManufacturer(id, data) {
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

module.exports = ManufacturerService;
