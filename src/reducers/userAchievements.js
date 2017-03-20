'use strict';

import UserAchievementConstants from '../constants/UserAchievementConstants';

const userAchievement = (state = {}, action) => {
	switch (action.type) {
		case UserAchievementConstants.GET_USER_ACHIEVEMENT:
			return Object.assign({}, state, action.data);
		case UserAchievementConstants.CREATE_USER_ACHIEVEMENT:
			return Object.assign({}, state, action.data);
		case UserAchievementConstants.UPDATE_USER_ACHIEVEMENT:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const userAchievements = (state = [], action) => {
	switch (action.type) {
		case UserAchievementConstants.GET_USER_ACHIEVEMENTS:
			return [...action.data];
		case UserAchievementConstants.CREATE_USER_ACHIEVEMENT:
			return [
				...state,
				userAchievement(undefined, action)
			];
		case UserAchievementConstants.REMOVE_USER_ACHIEVEMENT:
			let userAchievementArray = [...state];
			let index = state.findIndex((userAchievement) => userAchievement.id === action.data);
			if (index !== -1) {
				userAchievementArray.splice(index, 1);
			}
			return userAchievementArray;
		default:
			return state;
	}
}

export {
	userAchievement,
	userAchievements
};
