'use strict';

import Filter from 'bad-words';
let profanityFilter = new Filter();

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
      msg.text = profanityFilter.clean(msg.text);
      io.emit('chat:addMessage', msg);
      storedMessages.push(msg);
      if (storedMessages.length > 8) {
        storedMessages = storedMessages.splice(storedMessages.length - 5, storedMessages.length);
      }
    });

    socket.on('disconnect', function() {
      console.log('User disconnected!');
      numConnections--;
      io.emit('chat:totalConnections', numConnections);
    });
  });

  next();
};

exports.register.attributes = {
  name: 'hapi-chat'
};
