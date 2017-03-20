'use strict';

import GameSystemRankingConstants from '../constants/GameSystemRankingConstants';

const gameSystemRanking = (state = {}, action) => {
	switch (action.type) {
		case GameSystemRankingConstants.GET_GAME_SYSTEM_RANKING:
			return Object.assign({}, state, action.data);
		case GameSystemRankingConstants.CREATE_GAME_SYSTEM_RANKING:
			return Object.assign({}, state, action.data);
		case GameSystemRankingConstants.UPDATE_GAME_SYSTEM_RANKING:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const gameSystemRankings = (state = [], action) => {
	switch (action.type) {
		case GameSystemRankingConstants.GET_GAME_SYSTEM_RANKINGS:
			return [...action.data];
		case GameSystemRankingConstants.CREATE_GAME_SYSTEM_RANKING:
			return [
				...state,
				gameSystemRanking(undefined, action)
			];
		case GameSystemRankingConstants.REMOVE_GAME_SYSTEM_RANKING:
			let gameSystemRankingArray = [...state];
			let index = state.findIndex((gameSystemRanking) => gameSystemRanking.id === action.data);
			if (index !== -1) {
				gameSystemRankingArray.splice(index, 1);
			}
			return gameSystemRankingArray;
		default:
			return state;
	}
}

export {
	gameSystemRanking,
	gameSystemRankings
};
