'use strict';

import GameSystemRankingConstants from '../constants/GameSystemRankingConstants';
import GameSystemRankingService from '../services/GameSystemRankingService';

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
			dispatch(_initiateRequest(GameSystemRankingConstants.INITIATE_GAME_SYSTEM_RANKING_REQUEST, id));
			return GameSystemRankingService.get(id).then((gameSystemRanking) => {
				dispatch(_returnResponse(GameSystemRankingConstants.GET_GAME_SYSTEM_RANKING, gameSystemRanking));
				return gameSystemRanking;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemRankingConstants.INITIATE_GAME_SYSTEM_RANKING_REQUEST));
			return GameSystemRankingService.getAll().then((gameSystemRankings) => {
				dispatch(_returnResponse(GameSystemRankingConstants.GET_GAME_SYSTEM_RANKINGS, gameSystemRankings));
				return gameSystemRankings;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemRankingConstants.INITIATE_GAME_SYSTEM_RANKING_REQUEST));
			return GameSystemRankingService.search(criteria).then((response) => {
				dispatch(_returnResponse(GameSystemRankingConstants.GET_GAME_SYSTEM_RANKINGS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemRankingConstants.INITIATE_GAME_SYSTEM_RANKING_REQUEST));
			return GameSystemRankingService.create(data).then((gameSystemRanking) => {
				dispatch(_returnResponse(GameSystemRankingConstants.CREATE_GAME_SYSTEM_RANKING, gameSystemRanking));
				return gameSystemRanking;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemRankingConstants.INITIATE_GAME_SYSTEM_RANKING_REQUEST));
			return GameSystemRankingService.update(id, data).then((gameSystemRanking) => {
				dispatch(_returnResponse(GameSystemRankingConstants.UPDATE_GAME_SYSTEM_RANKING, gameSystemRanking));
				return gameSystemRanking;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemRankingConstants.INITIATE_GAME_SYSTEM_RANKING_REQUEST, id));
			return GameSystemRankingService.remove(id).then((response) => {
				dispatch(_returnResponse(GameSystemRankingConstants.REMOVE_GAME_SYSTEM_RANKING, id));
				return response;
			});
		};
	}
};
