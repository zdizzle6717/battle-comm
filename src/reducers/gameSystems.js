'use strict';

import GameSystemConstants from '../constants/GameSystemConstants';

const gameSystem = (state = {}, action) => {
	switch (action.type) {
		case GameSystemConstants.GET_GAME_SYSTEM:
			return Object.assign({}, state, action.data);
		case GameSystemConstants.CREATE_GAME_SYSTEM:
			return Object.assign({}, state, action.data);
		case GameSystemConstants.UPDATE_GAME_SYSTEM:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const gameSystems = (state = [], action) => {
	switch (action.type) {
		case GameSystemConstants.GET_GAME_SYSTEMS:
			return [...action.data];
		case GameSystemConstants.CREATE_GAME_SYSTEM:
			return [
				...state,
				gameSystem(undefined, action)
			];
		case GameSystemConstants.REMOVE_GAME_SYSTEM:
			let gameSystemArray = [...state];
			let index = state.findIndex((gameSystem) => gameSystem.id === action.data);
			if (index !== -1) {
				gameSystemArray.splice(index, 1);
			}
			return gameSystemArray;
		default:
			return state;
	}
}

export {
	gameSystem,
	gameSystems
};
