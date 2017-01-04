'use strict';

let siteUrl = require('../../../constants/envConfig').siteUrl;
let port = require('../../../constants/envConfig').port.chat;

socket.$inject = ['$rootScope'];
function socket($rootScope) {
    let socket = io.connect(`${siteUrl}:${port}/`, {'secure': true});

    return {
        on: function(eventName, callback) {
            socket.on(eventName, function() {
                var args = arguments;
                $rootScope.$apply(function() {
                    callback.apply(socket, args);
                });
            });
        },
        emit: function(eventName, data, callback) {
            socket.emit(eventName, data, function() {
                var args = arguments;
                $rootScope.$apply(function() {
                    if (callback) {
                        callback.apply(socket, args);
                    }
                });
            })
        }
    }
}

module.exports = socket;
