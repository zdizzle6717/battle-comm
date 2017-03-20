'use strict';

import ManufacturerConstants from '../constants/ManufacturerConstants';
import ManufacturerService from '../services/ManufacturerService';

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
			dispatch(_initiateRequest(ManufacturerConstants.INITIATE_MANUFACTURER_REQUEST, id));
			return ManufacturerService.get(id).then((manufacturer) => {
				dispatch(_returnResponse(ManufacturerConstants.GET_MANUFACTURER, manufacturer));
				return manufacturer;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(ManufacturerConstants.INITIATE_MANUFACTURER_REQUEST));
			return ManufacturerService.getAll().then((manufacturers) => {
				dispatch(_returnResponse(ManufacturerConstants.GET_MANUFACTURERS, manufacturers));
				return manufacturers;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ManufacturerConstants.INITIATE_MANUFACTURER_REQUEST));
			return ManufacturerService.search(criteria).then((response) => {
				dispatch(_returnResponse(ManufacturerConstants.GET_MANUFACTURERS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ManufacturerConstants.INITIATE_MANUFACTURER_REQUEST));
			return ManufacturerService.create(data).then((manufacturer) => {
				dispatch(_returnResponse(ManufacturerConstants.CREATE_MANUFACTURER, manufacturer));
				return manufacturer;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ManufacturerConstants.INITIATE_MANUFACTURER_REQUEST));
			return ManufacturerService.update(id, data).then((manufacturer) => {
				dispatch(_returnResponse(ManufacturerConstants.UPDATE_MANUFACTURER, manufacturer));
				return manufacturer;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ManufacturerConstants.INITIATE_MANUFACTURER_REQUEST, id));
			return ManufacturerService.remove(id).then((response) => {
				dispatch(_returnResponse(ManufacturerConstants.REMOVE_MANUFACTURER, id));
				return response;
			});
		};
	}
};
