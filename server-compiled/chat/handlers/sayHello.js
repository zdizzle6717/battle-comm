'use strict';

function sayHello() {
	console.log('new message from client');
	this.emit('Hello, my friend.');
}

module.exports = sayHello;