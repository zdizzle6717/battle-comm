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
        get: 'http://www.beta.battle-comm.net:3000/api/productOrders/',
        getAll: 'http://www.beta.battle-comm.net:3000/api/productOrders',
        create: 'http://www.beta.battle-comm.net:3000/api/productOrders',
        update: 'http://www.beta.battle-comm.net:3000/api/productOrders/',
        remove: 'http://www.beta.battle-comm.net:3000/api/productOrders/'
    },
    players: {
        update: 'http://www.beta.battle-comm.net:3000/api/userLogins/'
    }
};

module.exports = routes;
