'use strict';

let routes = {
    news: {
        get: 'http://www.staging.battle-comm.net:8080/api/newsPosts/',
        getAll: 'http://www.staging.battle-comm.net:8080/api/newsPosts',
        create: 'http://www.staging.battle-comm.net:8080/api/newsPosts',
        update: 'http://www.staging.battle-comm.net:8080/api/newsPosts/',
        remove: 'http://www.staging.battle-comm.net:8080/api/newsPosts/'
    },
    files: {
        create: 'http://www.staging.battle-comm.net:8080/api/files/'
    }
};

module.exports = routes;
