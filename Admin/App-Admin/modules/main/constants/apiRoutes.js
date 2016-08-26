'use strict';

let routes = {
    products: {
        get: 'http://www.staging.battle-comm.net:8080/api/products/',
        getAll: 'http://www.staging.battle-comm.net:8080/api/products',
        create: 'http://www.staging.battle-comm.net:8080/api/products',
        update: 'http://www.staging.battle-comm.net:8080/api/products/',
        remove: 'http://www.staging.battle-comm.net:8080/api/products/'
    },
    orders: {
        get: 'http://www.staging.battle-comm.net:8080/api/productOrders/',
        getAll: 'http://www.staging.battle-comm.net:8080/api/productOrders',
        create: 'http://www.staging.battle-comm.net:8080/api/productOrders',
        update: 'http://www.staging.battle-comm.net:8080/api/productOrders/',
        remove: 'http://www.staging.battle-comm.net:8080/api/productOrders/'
    },
    files: {
        create: 'http://www.staging.battle-comm.net:8080/api/files/'
    }
};

module.exports = routes;
