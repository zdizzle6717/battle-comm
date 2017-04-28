'use strict';

var _badWords = require('bad-words');

var _badWords2 = _interopRequireDefault(_badWords);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var profanityFilter = new _badWords2.default();

exports.register = function (server, options, next) {
  var io = require('socket.io')(server.select('chat').listener);

  var storedMessages = [];
  var numConnections = 0;

  io.on('connection', function (socket) {
    console.log('New connection!');
    numConnections++;
    io.emit('chat:totalConnections', numConnections);
    socket.emit('chat:storedMessages', storedMessages);

    socket.on('chat:sendMessage', function (msg) {
      msg.text = profanityFilter.clean(msg.text);
      io.emit('chat:addMessage', msg);
      storedMessages.push(msg);
      if (storedMessages.length > 8) {
        storedMessages = storedMessages.splice(storedMessages.length - 5, storedMessages.length);
      }
    });

    socket.on('disconnect', function () {
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