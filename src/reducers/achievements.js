'use strict';

import AchievementConstants from '../constants/AchievementConstants';

const achievement = (state = {}, action) => {
	switch (action.type) {
		case AchievementConstants.GET_ACHIEVEMENT:
			return Object.assign({}, state, action.data);
		case AchievementConstants.CREATE_ACHIEVEMENT:
			return Object.assign({}, state, action.data);
		case AchievementConstants.UPDATE_ACHIEVEMENT:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const achievements = (state = [], action) => {
	switch (action.type) {
		case AchievementConstants.GET_ACHIEVEMENTS:
			return [...action.data];
		case AchievementConstants.CREATE_ACHIEVEMENT:
			return [
				...state,
				achievement(undefined, action)
			];
		case AchievementConstants.REMOVE_ACHIEVEMENT:
			let achievementArray = [...state];
			let index = state.findIndex((achievement) => achievement.id === action.data);
			if (index !== -1) {
				achievementArray.splice(index, 1);
			}
			return achievementArray;
		default:
			return state;
	}
}

export {
	achievement,
	achievements
};
