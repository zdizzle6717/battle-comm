'use strict';

import GameSystemConstants from '../constants/GameSystemConstants';
import GameSystemService from '../services/GameSystemService';

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
			dispatch(_initiateRequest(GameSystemConstants.INITIATE_GAME_SYSTEM_REQUEST, id));
			return GameSystemService.get(id).then((gameSystem) => {
				dispatch(_returnResponse(GameSystemConstants.GET_GAME_SYSTEM, gameSystem));
				return gameSystem;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemConstants.INITIATE_GAME_SYSTEM_REQUEST));
			return GameSystemService.getAll().then((gameSystems) => {
				dispatch(_returnResponse(GameSystemConstants.GET_GAME_SYSTEMS, gameSystems));
				return gameSystems;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemConstants.INITIATE_GAME_SYSTEM_REQUEST));
			return GameSystemService.search(criteria).then((response) => {
				dispatch(_returnResponse(GameSystemConstants.GET_GAME_SYSTEMS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemConstants.INITIATE_GAME_SYSTEM_REQUEST));
			return GameSystemService.create(data).then((gameSystem) => {
				dispatch(_returnResponse(GameSystemConstants.CREATE_GAME_SYSTEM, gameSystem));
				return gameSystem;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemConstants.INITIATE_GAME_SYSTEM_REQUEST));
			return GameSystemService.update(id, data).then((gameSystem) => {
				dispatch(_returnResponse(GameSystemConstants.UPDATE_GAME_SYSTEM, gameSystem));
				return gameSystem;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(GameSystemConstants.INITIATE_GAME_SYSTEM_REQUEST, id));
			return GameSystemService.remove(id).then((response) => {
				dispatch(_returnResponse(GameSystemConstants.REMOVE_GAME_SYSTEM, id));
				return response;
			});
		};
	}
};
