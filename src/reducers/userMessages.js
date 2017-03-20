'use strict';

import UserMessageConstants from '../constants/UserMessageConstants';

const userMessage = (state = {}, action) => {
	switch (action.type) {
		case UserMessageConstants.GET_USER_MESSAGE:
			return Object.assign({}, state, action.data);
		case UserMessageConstants.CREATE_USER_MESSAGE:
			return Object.assign({}, state, action.data);
		case UserMessageConstants.UPDATE_USER_MESSAGE:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const userMessages = (state = [], action) => {
	switch (action.type) {
		case UserMessageConstants.GET_USER_MESSAGES:
			return [...action.data];
		case UserMessageConstants.CREATE_USER_MESSAGE:
			return [
				...state,
				userMessage(undefined, action)
			];
		case UserMessageConstants.REMOVE_USER_MESSAGE:
			let userMessageArray = [...state];
			let index = state.findIndex((userMessage) => userMessage.id === action.data);
			if (index !== -1) {
				userMessageArray.splice(index, 1);
			}
			return userMessageArray;
		default:
			return state;
	}
}

export {
	userMessage,
	userMessages
};
