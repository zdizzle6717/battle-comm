'use strict';

userDetails.$inject = ['PlayerService', 'AuthService'];
function userDetails(PlayerService, AuthService) {
	return {
		name: 'userDetails',
		template: require('./templates/userDetails.html'),
		scope: true,
		link: function(scope) {
			PlayerService.getPlayer(AuthService.currentUser.id)
			.then(function(response) {
				scope.player = response;
			})
		}
	}
}

module.exports = userDetails;
