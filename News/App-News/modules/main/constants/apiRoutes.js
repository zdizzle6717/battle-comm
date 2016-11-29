'use strict';

let port = require('./port').api;

let routes = {
    news: {
        get: `https://www.battle-comm.net:${port}/api/newsPosts/`,
        getAll: `https://www.battle-comm.net:${port}/api/newsPosts`,
        create: `https://www.battle-comm.net:${port}/api/newsPosts`,
        update: `https://www.battle-comm.net:${port}/api/newsPosts/`,
        remove: `https://www.battle-comm.net:${port}/api/newsPosts/`
    },
    files: {
        create: `https://www.battle-comm.net:${port}/api/files/`
    }
};

module.exports = routes;
