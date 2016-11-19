'use strict';

let serverPort = require('../../../constants/port').chat;

socket.$inject = ['$rootScope'];
function socket($rootScope) {
    let socket = io.connect(`https://52.26.195.10:${serverPort}/`, {'secure': true});

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
