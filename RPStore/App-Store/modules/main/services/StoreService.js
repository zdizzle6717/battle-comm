'use strict';

StoreService.$inject =['$http', '$stateParams', 'apiRoutes'];
function StoreService($http, $stateParams, apiRoutes) {
    let Service = {};
    let routes = apiRoutes;

    Service.getProduct = getProduct;
    Service.getAllProducts = getAllProducts;
    Service.createProduct = createProduct;
    Service.updateProduct = updateProduct;
    Service.removeProduct = removeProduct;
    Service.getPlayer = getPlayer;
    Service.updatePlayer = updatePlayer;
    Service.createOrder = createOrder;

    //////////////////////////////////////////////

    // Products

    function getProduct(id) {
        let args = {
            method: 'GET',
            url: routes.products.get + id
        };

        return $http(args)
            .then((response) => {
                let product = response.data;
                return product;
            });
    }

    function getAllProducts() {
        let args = {
            method: 'GET',
            url: routes.products.getAll
        };

        return $http(args)
            .then((response) => {
                let products = response.data;
                return products;
            });
    }

    function createProduct(data) {
        let args = {
            method: 'POST',
            url: routes.products.create,
            data: cleanData(data)
        };

        return $http(args)
            .then((response) => {
                let product = response.data;
                return product;
            });
    }

    function updateProduct(id, data) {
        let args = {
            method: 'PUT',
            url: routes.products.update + id,
            data: cleanData(data)
        };

        return $http(args)
            .then((response) => {
                let product = response.data;
                return product;
            });
    }

    function removeProduct(id, data) {
        let args = {
            method: 'DELETE',
            url: routes.products.remove + id,
            data: data
        };

        return $http(args)
            .then((response) => {
                let product = response.data;
                return product;
            });
    }

    function cleanData(obj) {
        let newData = angular.copy(obj);
        delete newData.id;
        delete newData.createdAt;
        delete newData.updatedAt;
        return newData;
    }

    function getPlayer() {
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

    function updatePlayer(data) {
        let args = {
            method: 'PUT',
            url: 'Connections/updatePlayer.php',
            data: data,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        };

        return $http(args)
            .then((response) => {
                let player = response.data;
                return player;
            });
    }

    function createProduct(data) {
        let args = {
            method: 'PUT',
            url: 'Connections/createProduct.php',
            data: data,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        };

        return $http(args)
            .then((response) => {
                let product = response.data;
                return product;
            });
    }

    function createOrder(data) {
        let args = {
            method: 'PUT',
            url: 'Connections/createOrder.php',
            data: data,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        };

        return $http(args)
            .then((response) => {
                let order = response.data;
                return order;
            });
    }

    return Service;
}

module.exports = StoreService;
