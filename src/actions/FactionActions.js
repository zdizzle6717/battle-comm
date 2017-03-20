'use strict';

import FactionConstants from '../constants/FactionConstants';
import FactionService from '../services/FactionService';

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
			dispatch(_initiateRequest(FactionConstants.INITIATE_FACTION_REQUEST, id));
			return FactionService.get(id).then((faction) => {
				dispatch(_returnResponse(FactionConstants.GET_FACTION, faction));
				return faction;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionConstants.INITIATE_FACTION_REQUEST));
			return FactionService.getAll().then((factions) => {
				dispatch(_returnResponse(FactionConstants.GET_FACTIONS, factions));
				return factions;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionConstants.INITIATE_FACTION_REQUEST));
			return FactionService.search(criteria).then((response) => {
				dispatch(_returnResponse(FactionConstants.GET_FACTIONS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionConstants.INITIATE_FACTION_REQUEST));
			return FactionService.create(data).then((faction) => {
				dispatch(_returnResponse(FactionConstants.CREATE_FACTION, faction));
				return faction;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionConstants.INITIATE_FACTION_REQUEST));
			return FactionService.update(id, data).then((faction) => {
				dispatch(_returnResponse(FactionConstants.UPDATE_FACTION, faction));
				return faction;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(FactionConstants.INITIATE_FACTION_REQUEST, id));
			return FactionService.remove(id).then((response) => {
				dispatch(_returnResponse(FactionConstants.REMOVE_FACTION, id));
				return response;
			});
		};
	}
};
