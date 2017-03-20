'use strict';

import UserNotificationConstants from '../constants/UserNotificationConstants';
import UserNotificationService from '../services/UserNotificationService';

const _initiateRequest = (type, data) => {
	return {
		'type': type,
		'data': data
	};
};
const _returnResponse = (type, data) => {
	return {
		'type': type,
		'data': data,
		'receivedAt': Date.now()
	};
};

export default {
	get: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserNotificationConstants.INITIATE_USER_NOTIFICATION_REQUEST, id));
			return UserNotificationService.get(id).then((userNotification) => {
				dispatch(_returnResponse(UserNotificationConstants.GET_USER_NOTIFICATION, userNotification));
				return userNotification;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserNotificationConstants.INITIATE_USER_NOTIFICATION_REQUEST));
			return UserNotificationService.getAll().then((userNotifications) => {
				dispatch(_returnResponse(UserNotificationConstants.GET_USER_NOTIFICATIONS, userNotifications));
				return userNotifications;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserNotificationConstants.INITIATE_USER_NOTIFICATION_REQUEST));
			return UserNotificationService.search(criteria).then((response) => {
				dispatch(_returnResponse(UserNotificationConstants.GET_USER_NOTIFICATIONS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserNotificationConstants.INITIATE_USER_NOTIFICATION_REQUEST));
			return UserNotificationService.create(data).then((userNotification) => {
				dispatch(_returnResponse(UserNotificationConstants.CREATE_USER_NOTIFICATION, userNotification));
				return userNotification;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserNotificationConstants.INITIATE_USER_NOTIFICATION_REQUEST));
			return UserNotificationService.update(id, data).then((userNotification) => {
				dispatch(_returnResponse(UserNotificationConstants.UPDATE_USER_NOTIFICATION, userNotification));
				return userNotification;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserNotificationConstants.INITIATE_USER_NOTIFICATION_REQUEST, id));
			return UserNotificationService.remove(id).then((response) => {
				dispatch(_returnResponse(UserNotificationConstants.REMOVE_USER_NOTIFICATION, id));
				return response;
			});
		};
	}
};
