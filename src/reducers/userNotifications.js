'use strict';

import UserNotificationConstants from '../constants/UserNotificationConstants';

const userNotification = (state = {}, action) => {
	switch (action.type) {
		case UserNotificationConstants.GET_USER_NOTIFICATION:
			return Object.assign({}, state, action.data);
		case UserNotificationConstants.CREATE_USER_NOTIFICATION:
			return Object.assign({}, state, action.data);
		case UserNotificationConstants.UPDATE_USER_NOTIFICATION:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const userNotifications = (state = [], action) => {
	switch (action.type) {
		case UserNotificationConstants.GET_USER_NOTIFICATIONS:
			return [...action.data];
		case UserNotificationConstants.CREATE_USER_NOTIFICATION:
			return [
				...state,
				userNotification(undefined, action)
			];
		case UserNotificationConstants.REMOVE_USER_NOTIFICATION:
			let userNotificationArray = [...state];
			let index = state.findIndex((userNotification) => userNotification.id === action.data);
			if (index !== -1) {
				userNotificationArray.splice(index, 1);
			}
			return userNotificationArray;
		default:
			return state;
	}
}

export {
	userNotification,
	userNotifications
};
