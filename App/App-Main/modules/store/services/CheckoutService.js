'use strict';

CheckoutService.$inject = ['$http', '$stateParams'];
function CheckoutService($http, $stateParams) {
    let Service = {};

    Service.order = {};

    //////////////////////////////////////////////

    Service.sortItems = function(data) {
        let details = '';
        let total = 0;
        for (let i=0, len=data.length; i<len; i++) {
            details += 'ID:' + data[i]._id + ', Product:' + data[i]._name + ', RP:' + data[i]._price + ', Qty:' +data[i]._quantity;
            total = total + data[i]._price * data[i]._quantity;
            if (i<data.length - 1) {
                details += ' || ';
            }
        }
        Service.order.orderDetails = details;
        Service.order.orderTotal = total;
    };

    Service.add = function(data) {
        angular.merge(Service.order, data);
    };

    Service.get = function() {
        return Service.order;
    };

    return Service;
}

module.exports = CheckoutService;
