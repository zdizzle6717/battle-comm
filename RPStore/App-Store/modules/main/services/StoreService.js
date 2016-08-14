'use strict';

StoreService.$inject =['$http', '$stateParams'];
function StoreService($http, $stateParams) {
    let Service = {};

    Service.getProduct = getProduct;
    Service.getAllProducts = getAllProducts;
    Service.createProduct = createProduct;
    Service.getPlayer = getPlayer;
    Service.updatePlayer = updatePlayer;
    Service.createOrder = createOrder;

    //////////////////////////////////////////////

    function getProduct(id) {
        let args = {
            method: 'GET',
            url: 'Connections/singleProduct.php?id=' + $stateParams.productId,
            params: {id : id}
        };

        return $http(args)
            .then((response) => {
                let product = response.data.products[0];
                return product;
            });
    }

    function getAllProducts() {
        let args = {
            method: 'GET',
            url: 'Connections/products.php'
        };

        return $http(args)
            .then((response) => {
                let products = response.data.products;
                return products;
            });
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
