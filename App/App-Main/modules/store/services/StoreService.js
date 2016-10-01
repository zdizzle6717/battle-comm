'use strict';

StoreService.$inject =['$http', '$stateParams', 'API_ROUTES'];
function StoreService($http, $stateParams, API_ROUTES) {
    let Service = {};
    let routes = API_ROUTES;

    Service.getProduct = getProduct;
    Service.getAllProducts = getAllProducts;
    Service.updateProduct = updateProduct;
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


    // Players

	function getPlayer(id) {
        let args = {
            method: 'GET',
            url: routes.players.get + id
        };

        return $http(args)
            .then((response) => {
                return response.data;
            });
    }

    function updatePlayer(data, id) {
        let args = {
            method: 'PATCH',
            url: routes.players.update + id,
            data: data
        };

        return $http(args)
            .then((response) => {
                return response.data;
            });
    }


    // Orders

    function createOrder(data) {
        let args = {
            method: 'POST',
            url: routes.orders.create,
            data: cleanData(data)
        };

        return $http(args)
            .then((response) => {
                let order = response.data;
                return order;
            });
    }

    function cleanData(obj) {
        let newData = angular.copy(obj);
        delete newData.id;
        delete newData.createdAt;
        delete newData.updatedAt;
        return newData;
    }

    return Service;
}

module.exports = StoreService;
