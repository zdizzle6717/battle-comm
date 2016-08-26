'use strict';

let routes = {
    news: {
        get: 'http://www.beta.battle-comm.net:3000/api/newsPosts/',
        getAll: 'http://www.beta.battle-comm.net:3000/api/newsPosts',
        create: 'http://www.beta.battle-comm.net:3000/api/newsPosts',
        update: 'http://www.beta.battle-comm.net:3000/api/newsPosts/',
        remove: 'http://www.beta.battle-comm.net:3000/api/newsPosts/'
    },
    files: {
        create: 'http://www.beta.battle-comm.net:3000/api/files/'
    }
};

module.exports = routes;
