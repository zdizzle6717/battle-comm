'use strict';

import FactionConstants from '../constants/FactionConstants';

const faction = (state = {}, action) => {
	switch (action.type) {
		case FactionConstants.GET_FACTION:
			return Object.assign({}, state, action.data);
		case FactionConstants.CREATE_FACTION:
			return Object.assign({}, state, action.data);
		case FactionConstants.UPDATE_FACTION:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const factions = (state = [], action) => {
	switch (action.type) {
		case FactionConstants.GET_FACTIONS:
			return [...action.data];
		case FactionConstants.CREATE_FACTION:
			return [
				...state,
				faction(undefined, action)
			];
		case FactionConstants.REMOVE_FACTION:
			let factionArray = [...state];
			let index = state.findIndex((faction) => faction.id === action.data);
			if (index !== -1) {
				factionArray.splice(index, 1);
			}
			return factionArray;
		default:
			return state;
	}
}

export {
	faction,
	factions
};
