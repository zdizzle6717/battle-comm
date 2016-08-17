'use strict';

let routes = {
    products: {
        get: 'http://www.beta.battle-comm.net:3000/api/products/',
        getAll: 'http://www.beta.battle-comm.net:3000/api/products',
        create: 'http://www.beta.battle-comm.net:3000/api/products',
        update: 'http://www.beta.battle-comm.net:3000/api/products/',
        remove: 'http://www.beta.battle-comm.net:3000/api/products/'
    },
    orders: {
        get: 'http://www.beta.battle-comm.net:3000/api/orders/',
        getAll: 'http://www.beta.battle-comm.net:3000/api/orders',
        create: 'http://www.beta.battle-comm.net:3000/api/orders',
        update: 'http://www.beta.battle-comm.net:3000/api/orders/',
        remove: 'http://www.beta.battle-comm.net:3000/api/orders/'
    }
};

module.exports = routes;
