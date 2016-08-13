'use strict';

AdminService.$inject = ['$http', '$stateParams'];
function AdminService($http, $stateParams) {
    let service = {};

    service.getOrder = getOrder;
    service.getAllOrders = getAllOrders;
    service.updateOrder = updateOrder;

    return service;

    //////////////////////////////////////////////

    function getOrder(id) {
        let args = {
            method: 'GET',
            url: '../Connections/singleOrder.php?id=' + $stateParams.orderId,
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
            url: '../Connections/updateOrder.php?id=' + $stateParams.orderId,
            data: data,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
        };

        return $http(args)
            .then((response) => {
                let order = response.data;
                return order;
            });
    }

}

module.exports = AdminService;
