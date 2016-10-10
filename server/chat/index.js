'use strict';

let Handlers = require('./handlers');

exports.register = function (server, options, next) {
	var io = require('socket.io')(server.select('chat').listener);

	io.on('connection', function(socket) {
		console.log('New connection!');
		socket.on('chat:sendMessage', function(msg) {
			io.emit('chat:addMessage', msg);
		});

		socket.on('new:message', function(msg){
		    console.log('new:message: ' + msg);
		  });
	});

	next();
}

exports.register.attributes = {
    name: 'hapi-chat'
};
