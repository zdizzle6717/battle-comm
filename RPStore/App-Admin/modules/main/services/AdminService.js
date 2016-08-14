'use strict';

AdminService.$inject = ['$http', '$stateParams'];
function AdminService($http, $stateParams) {
    let service = {};

    service.getOrder = getOrder;
    service.getAllOrders = getAllOrders;
    service.updateOrder = updateOrder;
    service.getProduct = getProduct;
    service.getAllProducts = getAllProducts;
    service.createProduct = createProduct;
    service.updateProduct = updateProduct;
    service.removeProduct = removeProduct;

    return service;

    //////////////////////////////////////////////

    // Orders

    function getOrder(id) {
        let args = {
            method: 'GET',
            url: '../Connections/singleOrder.php',
            params: {id : id}
        };

        return $http(args)
            .then((response) => {
                let product = response.data.orders[0];
                return product;
            });
    }

    function getAllOrders() {
        let args = {
            method: 'GET',
            url: '../Connections/orders.php'
        };

        return $http(args)
            .then((response) => {
                let products = response.data.orders;
                return products;
            });
    }

    function updateOrder(id, data) {
        let args = {
            method: 'PUT',
            url: '../Connections/updateOrder.php?id=' + id,
            data: data,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
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
            url: 'http://www.battle-comm.net:8080/api/products/' + id
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
            url: 'http://www.battle-comm.net:8080/api/products'
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
            url: 'http://www.battle-comm.net:8080/api/products',
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
            url: 'http://www.battle-comm.net:8080/api/products/' + id,
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
            url: 'http://www.battle-comm.net:8080/api/products/' + id,
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
