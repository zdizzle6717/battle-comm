'use strict';

import AchievementConstants from '../constants/AchievementConstants';
import AchievementService from '../services/AchievementService';

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
			dispatch(_initiateRequest(AchievementConstants.INITIATE_ACHIEVEMENT_REQUEST, id));
			return AchievementService.get(id).then((achievement) => {
				dispatch(_returnResponse(AchievementConstants.GET_ACHIEVEMENT, achievement));
				return achievement;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(AchievementConstants.INITIATE_ACHIEVEMENT_REQUEST));
			return AchievementService.getAll().then((achievements) => {
				dispatch(_returnResponse(AchievementConstants.GET_ACHIEVEMENTS, achievements));
				return achievements;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(AchievementConstants.INITIATE_ACHIEVEMENT_REQUEST));
			return AchievementService.search(criteria).then((response) => {
				dispatch(_returnResponse(AchievementConstants.GET_ACHIEVEMENTS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(AchievementConstants.INITIATE_ACHIEVEMENT_REQUEST));
			return AchievementService.create(data).then((achievement) => {
				dispatch(_returnResponse(AchievementConstants.CREATE_ACHIEVEMENT, achievement));
				return achievement;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(AchievementConstants.INITIATE_ACHIEVEMENT_REQUEST));
			return AchievementService.update(id, data).then((achievement) => {
				dispatch(_returnResponse(AchievementConstants.UPDATE_ACHIEVEMENT, achievement));
				return achievement;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(AchievementConstants.INITIATE_ACHIEVEMENT_REQUEST, id));
			return AchievementService.remove(id).then((response) => {
				dispatch(_returnResponse(AchievementConstants.REMOVE_ACHIEVEMENT, id));
				return response;
			});
		};
	}
};
