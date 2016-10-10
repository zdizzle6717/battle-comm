'use strict';

chatBox.$inject = ['$compile', '$state', '$rootScope', '$timeout', 'AuthService', 'socket'];
function chatBox($compile, $state, $rootScope, $timeout, AuthService, socket) {
	return {
		'name': 'chatBox',
		'restrict': 'A',
		'replace': true,
		'scope:': {
		},
		'link': link
	}

	function link(scope, elem, attrs) {
		let template = require('./templates/chatBox.html');
		scope.user = AuthService.currentUser;
		scope.toggleChat = toggleChat;
		scope.messages = [];
		scope.newMessage = '';
		scope.sendMessage = sendMessage;
		let initialTime = new Date().getTime();
		let container;

		checkAuthentication();

		$rootScope.$on('$stateChangeStart', checkAuthentication);

		/////////////////////////////////

		function checkAuthentication() {
			scope.user = AuthService.currentUser;
			scope.showNav = false;
			if (AuthService.isAuthenticated) {
				elem.html(template);
			} else {
				elem.html('');
			}

			$compile(elem.contents())(scope);
		}

		function toggleChat() {
			scope.showChat = !scope.showChat;
		}

		function sendMessage() {
			let msg = document.querySelector('#newMessage').value;
			let theMessage = {
					username: scope.user.username,
					text: msg
			};
			let sentTime = new Date().getTime();
			let time = getTimeElapsed(sentTime - initialTime);
			time = (time[3] > 0 ? time[3] + 'h' : '') + (time[2] > 0 ? time[2] + 'm' : '') + time[1] + 's';
			theMessage.time = time;
			socket.emit('chat:sendMessage', theMessage);
		}

		// Socket Watchers

		socket.on('chat:addMessage', function(msg) {
			if (scope.messages.length > 298) {
				scope.messages = scope.messages.splice(scope.messages.length - 200, scope.messages.length)
			}
			scope.messages.push(msg);
			container = document.getElementById('messages');
			$timeout(function() {
				container.scrollTop = container.scrollHeight;
			});
			document.querySelector('#newMessage').value = '';
		});

		socket.on('chat:storedMessages', function(msgs) {
			for (var i in msgs) {
				msgs[i].time = 'recent'
			}
			scope.messages = msgs;
		});

		socket.on('chat:totalConnections', function(total) {
			scope.connections = total;
		});

		function getTimeElapsed(time) {
			let timeFractions = [1000, 60, 24];
		    time = [time];
		    for (var i = 0; i < timeFractions.length; i++) {
		        time.push(parseInt(time[i]/timeFractions[i]));
		        time[i] = time[i] % timeFractions[i];
		    };
			return time;
		};

	}
}

module.exports = chatBox;
