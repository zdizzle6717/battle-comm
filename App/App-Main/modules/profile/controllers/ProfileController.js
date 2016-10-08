'use strict';

ProfileController.$inject = ['$rootScope', '$state', '$stateParams', 'AuthService', 'PlayerService', 'FriendService', 'NotificationService'];
function ProfileController($rootScope, $state, $stateParams, AuthService, PlayerService, FriendService, NotificationService) {
    let controller = this;

    controller.readOnly = true;
	controller.addFriend = addFriend;
	controller.removeFriend = removeFriend;
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
				checkFriendship();
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

	function checkFriendship() {
		for (var i in controller.currentUser.Friends) {
			if (controller.currentUser.Friends[i].id == AuthService.currentUser.id) {
				controller.alreadyFriends = true;
			}
		}
	}

	function addFriend() {
		let config = {
			'UserId': parseFloat($stateParams.playerId),
			'fromId': AuthService.currentUser.id,
			'fromUsername': AuthService.currentUser.username,
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

	function removeFriend(username) {
		let friendData = {
			UserId: parseFloat($stateParams.playerId),
			InviteeId: AuthService.currentUser.id
		}
		FriendService.remove(friendData).then(function(response) {
			let config = {
				type: 'success',
				message: `You and ${username} are no longer allies!`
			}
			showAlert(config);
			$state.go('dashboard');
		})
	}

	function showAlert(config) {
		$rootScope.$broadcast('show:notification', {type: config.type, message: config.message});
	}

}

module.exports = ProfileController;
