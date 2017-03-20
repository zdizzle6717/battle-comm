'use strict';

import UserAchievementConstants from '../constants/UserAchievementConstants';
import UserAchievementService from '../services/UserAchievementService';

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
			dispatch(_initiateRequest(UserAchievementConstants.INITIATE_USER_ACHIEVEMENT_REQUEST, id));
			return UserAchievementService.get(id).then((userAchievement) => {
				dispatch(_returnResponse(UserAchievementConstants.GET_USER_ACHIEVEMENT, userAchievement));
				return userAchievement;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserAchievementConstants.INITIATE_USER_ACHIEVEMENT_REQUEST));
			return UserAchievementService.getAll().then((userAchievements) => {
				dispatch(_returnResponse(UserAchievementConstants.GET_USER_ACHIEVEMENTS, userAchievements));
				return userAchievements;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserAchievementConstants.INITIATE_USER_ACHIEVEMENT_REQUEST));
			return UserAchievementService.search(criteria).then((response) => {
				dispatch(_returnResponse(UserAchievementConstants.GET_USER_ACHIEVEMENTS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserAchievementConstants.INITIATE_USER_ACHIEVEMENT_REQUEST));
			return UserAchievementService.create(data).then((userAchievement) => {
				dispatch(_returnResponse(UserAchievementConstants.CREATE_USER_ACHIEVEMENT, userAchievement));
				return userAchievement;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserAchievementConstants.INITIATE_USER_ACHIEVEMENT_REQUEST));
			return UserAchievementService.update(id, data).then((userAchievement) => {
				dispatch(_returnResponse(UserAchievementConstants.UPDATE_USER_ACHIEVEMENT, userAchievement));
				return userAchievement;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserAchievementConstants.INITIATE_USER_ACHIEVEMENT_REQUEST, id));
			return UserAchievementService.remove(id).then((response) => {
				dispatch(_returnResponse(UserAchievementConstants.REMOVE_USER_ACHIEVEMENT, id));
				return response;
			});
		};
	}
};
