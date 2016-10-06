<div class="full_width ">
	<h2>Player Dashboard</h2>
</div>
<div class="two_column_1">
	<h2 class="no_shadow text-center">Notifications</h2>
	<h5 ng-if="Notifications.notifications.length === 0">No new notifications.</h5>
	<div ng-if="Notifications.notifications.length > 0" class="notification-list">
		<div ng-repeat="notification in Notifications.notifications track by $index" class="group">
		  <div class="message" ng-if="notification.type === 'friendRequest'">New Friend Request from {{notification.fromUserName}}</div>
		  <div class="message" ng-if="notification.type === 'friendshipAccepted'">{{notification.fromUsername}} accepted your friend request.</div>
		  <div class="actions">
			  <span class="fa fa-check" ng-click="Notifications.acceptFriend(notification, $index)" ng-if="notification.type === 'friendRequest'"></span>
			  <span class="fa fa-check" ng-click="Notifications.removeNote(notification.id, $index)" ng-if="notification.type === 'friendshipAccepted'"></span>
			  <span class="fa fa-times" ng-click="Notifications.removeNote(notification.id, $index)"></span>
		  </div>
	  </div>
	</div>
</div>
<div class="two_column_1">
	<h2 class="no_shadow text-center">Messages</h2>
	<h5>No new messages.</h5>
</div>

<div class="full_width text-right">
	<a ng-click="Notifications.logout()">Logout?</a>
</div>
