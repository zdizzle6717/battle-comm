'use strict';

let Handlers = require('./handlers');

exports.register = function(server, options, next) {
    var io = require('socket.io')(server.select('chat').listener);

    let storedMessages = [];
    let numConnections = 0;

    io.on('connection', function(socket) {
        console.log('New connection!');
        numConnections++;
		io.emit('chat:totalConnections', numConnections);
		socket.emit('chat:storedMessages', storedMessages);


        socket.on('chat:sendMessage', function(msg) {
            io.emit('chat:addMessage', msg);
			storedMessages.push(msg);
			if (storedMessages.length > 8) {
				storedMessages = storedMessages.splice(storedMessages.length - 5, storedMessages.length);
			}
        });

		socket.on('disconnect', function() {
			numConnections--;
			io.emit('chat:totalConnections', numConnections);
		})
    });

    next();
}

exports.register.attributes = {
    name: 'hapi-chat'
};
