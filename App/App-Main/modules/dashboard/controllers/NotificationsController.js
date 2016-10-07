'use strict';

NotificationsController.$inject = ['$rootScope', '$state', '$stateParams', 'PlayerService', 'FriendService', 'NotificationService', 'AuthService'];
function NotificationsController($rootScope, $state, $stateParams, PlayerService, FriendService, NotificationService, AuthService) {
    let controller = this;

	controller.acceptFriend = acceptFriend;
	controller.removeNote = removeNote;
	controller.logout = logout;

    init();

    ///////////////////////////////////////////

    function init() {
		if ($stateParams.playerId != AuthService.currentUser.id) {
			$state.go('dashboard', {'playerId': AuthService.currentUser.id})
		} else {
			PlayerService.getPlayer(AuthService.currentUser.id)
			.then(function(response) {
				controller.currentPlayer = response;
				controller.notifications = response.UserNotifications;
				AuthService.totalNotifications = controller.notifications.length;
			}).catch(function() {
				let config = {
					type: 'error',
					message: `Redirect: No player was found with id ${$stateParams.playerId}`
				}
				showAlert(config);
				$state.go('login');
			});
		}
    }

	function acceptFriend(notification, index) {
		let config = {
			'UserId': parseFloat(notification.fromId),
			'fromId': AuthService.currentUser.id,
			'fromUsername': AuthService.currentUser.username,
			'fromName': `${AuthService.currentUser.firstName} ${AuthService.currentUser.lastName}`,
			'type': 'friendshipAccepted'
		}
		NotificationService.create(config).then((response) => {
			NotificationService.remove(notification.id).then((response) => {
				let friendData = {
					UserId: parseFloat(notification.fromId),
					InviteeId: controller.currentPlayer.id
				}
				FriendService.create(friendData).then(function(response) {
					controller.notifications.splice(index, 1);
					AuthService.totalNotifications = controller.notifications.length;
					let config = {
						type: 'success',
						message: `You and ${response.username} are now allies!`
					}
					showAlert(config);
				})
			});
		});
	}

	function removeNote(id, index) {
		NotificationService.remove(id).then((response) => {
			controller.notifications.splice(index, 1);
			AuthService.totalNotifications = controller.notifications.length;
		});
	}

	function logout() {
		AuthService.logout();
		$state.go('login');
	}

	function showAlert(config) {
        $rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
    }

}

module.exports = NotificationsController;
