'use strict';

let siteUrl = require('./envConfig').siteUrl;
let port = require('./envConfig').port.api;

let routes = {
    news: {
        get: `${siteUrl}:${port}/api/newsPosts/`,
        getAll: `${siteUrl}:${port}/api/newsPosts`,
        create: `${siteUrl}:${port}/api/newsPosts`,
        update: `${siteUrl}:${port}/api/newsPosts/`,
        remove: `${siteUrl}:${port}/api/newsPosts/`
    },
    files: {
        create: `${siteUrl}:${port}/api/files/`
    }
};

module.exports = routes;
