'use strict';

import FactionRankingConstants from '../constants/FactionRankingConstants';

const factionRanking = (state = {}, action) => {
	switch (action.type) {
		case FactionRankingConstants.GET_FACTION_RANKING:
			return Object.assign({}, state, action.data);
		case FactionRankingConstants.CREATE_FACTION_RANKING:
			return Object.assign({}, state, action.data);
		case FactionRankingConstants.UPDATE_FACTION_RANKING:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const factionRankings = (state = [], action) => {
	switch (action.type) {
		case FactionRankingConstants.GET_FACTION_RANKINGS:
			return [...action.data];
		case FactionRankingConstants.CREATE_FACTION_RANKING:
			return [
				...state,
				factionRanking(undefined, action)
			];
		case FactionRankingConstants.REMOVE_FACTION_RANKING:
			let factionRankingArray = [...state];
			let index = state.findIndex((factionRanking) => factionRanking.id === action.data);
			if (index !== -1) {
				factionRankingArray.splice(index, 1);
			}
			return factionRankingArray;
		default:
			return state;
	}
}

export {
	factionRanking,
	factionRankings
};
