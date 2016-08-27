'use strict';

userDetails.$inject = ['StoreService'];
function userDetails(StoreService) {
	return {
		name: 'userDetails',
		template: require('./templates/userDetails.html'),
		scope: true,
		link: function(scope) {
			StoreService.getPlayer()
			.then(function(response) {
				scope.player = response;
			})
		}
	}
}

module.exports = userDetails;
