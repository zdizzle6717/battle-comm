'use strict';

import FactionRankingConstants from '../constants/FactionRankingConstants';
import FactionRankingService from '../services/FactionRankingService';

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
			dispatch(_initiateRequest(FactionRankingConstants.INITIATE_FACTION_RANKING_REQUEST, id));
			return FactionRankingService.get(id).then((factionRanking) => {
				dispatch(_returnResponse(FactionRankingConstants.GET_FACTION_RANKING, factionRanking));
				return factionRanking;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionRankingConstants.INITIATE_FACTION_RANKING_REQUEST));
			return FactionRankingService.getAll().then((factionRankings) => {
				dispatch(_returnResponse(FactionRankingConstants.GET_FACTION_RANKINGS, factionRankings));
				return factionRankings;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionRankingConstants.INITIATE_FACTION_RANKING_REQUEST));
			return FactionRankingService.search(criteria).then((response) => {
				dispatch(_returnResponse(FactionRankingConstants.GET_FACTION_RANKINGS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionRankingConstants.INITIATE_FACTION_RANKING_REQUEST));
			return FactionRankingService.create(data).then((factionRanking) => {
				dispatch(_returnResponse(FactionRankingConstants.CREATE_FACTION_RANKING, factionRanking));
				return factionRanking;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionRankingConstants.INITIATE_FACTION_RANKING_REQUEST));
			return FactionRankingService.update(id, data).then((factionRanking) => {
				dispatch(_returnResponse(FactionRankingConstants.UPDATE_FACTION_RANKING, factionRanking));
				return factionRanking;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionRankingConstants.INITIATE_FACTION_RANKING_REQUEST, id));
			return FactionRankingService.remove(id).then((response) => {
				dispatch(_returnResponse(FactionRankingConstants.REMOVE_FACTION_RANKING, id));
				return response;
			});
		};
	}
};
