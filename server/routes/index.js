'use strict';

module.exports = [
    // Base Route
    {
        method: 'GET',
        path: '/api/test',
        handler: function(req, res) {
            res({
                'api': 'Hello world!'
            });
        }
    }
]
.concat(require('./api/files'))
.concat(require('./api/gameSystems'))
.concat(require('./api/manufacturers'))
.concat(require('./api/newsPosts'))
.concat(require('./api/productOrders'))
.concat(require('./api/products'))
.concat(require('./api/users'))
.concat(require('./api/userFriends'))
.concat(require('./api/userNotifications'))
.concat(require('./api/userPhotos'))
.concat(require('./api/userRankings'))
.concat(require('./api/venues'));
