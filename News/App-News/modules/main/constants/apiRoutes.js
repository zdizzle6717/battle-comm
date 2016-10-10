'use strict';

let port = require('./port').api;

let routes = {
    news: {
        get: `http://52.26.195.10:${port}/api/newsPosts/`,
        getAll: `http://52.26.195.10:${port}/api/newsPosts`,
        create: `http://52.26.195.10:${port}/api/newsPosts`,
        update: `http://52.26.195.10:${port}/api/newsPosts/`,
        remove: `http://52.26.195.10:${port}/api/newsPosts/`
    },
    files: {
        create: `http://52.26.195.10:${port}/api/files/`
    }
};

module.exports = routes;
