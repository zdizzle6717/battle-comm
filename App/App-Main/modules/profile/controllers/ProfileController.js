'use strict';

ProfileController.$inject = ['$rootScope', '$state', '$stateParams', 'AuthService', 'PlayerService', 'NotificationService'];
function ProfileController($rootScope, $state, $stateParams, AuthService, PlayerService, NotificationService) {
    let controller = this;

    controller.readOnly = true;
	controller.addFriend = addFriend;
	controller.isMe = false;

	init();

    ///////////////////////////////////////////

	function init() {
		if ($stateParams.playerId) {
			PlayerService.getPlayer($stateParams.playerId).then(function(response) {
				controller.currentUser = response;
				controller.readOnly = true;
				controller.isNew = false;
				if ($stateParams.playerId == AuthService.currentUser.id) {
					controller.isMe = true;
				}
				for (var i in controller.currentUser.UserFriends) {
					if (controller.currentUser.UserFriends[i].friendId == AuthService.currentUser.id) {
						controller.alreadyFriends = true;
					}
				}
			}).catch(function() {
				let config = {
					type: 'error',
					message: `Redirect: No player was found with id ${$stateParams.playerId}`
				}
				showAlert(config);
				$state.go('dashboard', {playerId: AuthService.currentUser.id});
			});
		} else {
			$state.go('login');
		}
	};

	function addFriend() {
		let config = {
			'UserId': parseFloat($stateParams.playerId),
			'fromId': AuthService.currentUser.id,
			'fromName': `${AuthService.currentUser.firstName} ${AuthService.currentUser.lastName}`,
			'type': 'friendRequest'
		}
		NotificationService.create(config).then((response) => {
			showAlert({
				type: 'success',
				message: 'Friend request sent.'
			})
		}).catch((response) => {
			if (response.data.message === 'Request already sent') {
				showAlert({
					type: 'error',
					message: 'Friend request already sent.'
				})
			};
		})
	}

	function showAlert(config) {
		$rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
	}

}

module.exports = ProfileController;
