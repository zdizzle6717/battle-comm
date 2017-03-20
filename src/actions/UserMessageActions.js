'use strict';

import UserMessageConstants from '../constants/UserMessageConstants';
import UserMessageService from '../services/UserMessageService';

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
			dispatch(_initiateRequest(UserMessageConstants.INITIATE_USER_MESSAGE_REQUEST, id));
			return UserMessageService.get(id).then((userMessage) => {
				dispatch(_returnResponse(UserMessageConstants.GET_USER_MESSAGE, userMessage));
				return userMessage;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserMessageConstants.INITIATE_USER_MESSAGE_REQUEST));
			return UserMessageService.getAll().then((userMessages) => {
				dispatch(_returnResponse(UserMessageConstants.GET_USER_MESSAGES, userMessages));
				return userMessages;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserMessageConstants.INITIATE_USER_MESSAGE_REQUEST));
			return UserMessageService.search(criteria).then((response) => {
				dispatch(_returnResponse(UserMessageConstants.GET_USER_MESSAGES, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserMessageConstants.INITIATE_USER_MESSAGE_REQUEST));
			return UserMessageService.create(data).then((userMessage) => {
				dispatch(_returnResponse(UserMessageConstants.CREATE_USER_MESSAGE, userMessage));
				return userMessage;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserMessageConstants.INITIATE_USER_MESSAGE_REQUEST));
			return UserMessageService.update(id, data).then((userMessage) => {
				dispatch(_returnResponse(UserMessageConstants.UPDATE_USER_MESSAGE, userMessage));
				return userMessage;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserMessageConstants.INITIATE_USER_MESSAGE_REQUEST, id));
			return UserMessageService.remove(id).then((response) => {
				dispatch(_returnResponse(UserMessageConstants.REMOVE_USER_MESSAGE, id));
				return response;
			});
		};
	}
};
