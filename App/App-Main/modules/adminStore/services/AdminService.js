'use strict';

AdminService.$inject = ['$http', '$stateParams', 'API_ROUTES'];
function AdminService($http, $stateParams, API_ROUTES) {
    let service = {};
    let routes = API_ROUTES;

    service.getProduct = getProduct;
    service.getAllProducts = getAllProducts;
    service.createProduct = createProduct;
    service.updateProduct = updateProduct;
    service.removeProduct = removeProduct;
    service.getOrder = getOrder;
    service.getAllOrders = getAllOrders;
    service.createOrder = createOrder;
    service.updateOrder = updateOrder;
    service.removeOrder = removeOrder;


    return service;

    //////////////////////////////////////////////

    // Orders

    function getOrder(id) {
        let args = {
            method: 'GET',
            url: routes.orders.get + id
        };

        return $http(args)
            .then((response) => {
                let order = response.data;
                return order;
            });
    }

    function getAllOrders() {
        let args = {
            method: 'GET',
            url: routes.orders.getAll
        };

        return $http(args)
            .then((response) => {
                let orders = response.data;
                return orders;
            });
    }

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

    function updateOrder(id, data) {
        let args = {
            method: 'PUT',
            url: routes.orders.update + id,
            data: cleanData(data)
        };

        return $http(args)
            .then((response) => {
                let order = response.data;
                return order;
            });
    }

    function removeOrder(id, data) {
        let args = {
            method: 'DELETE',
            url: routes.orders.remove + id,
            data: data
        };

        return $http(args)
            .then((response) => {
                let order = response.data;
                return order;
            });
    }



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

}

module.exports = AdminService;
