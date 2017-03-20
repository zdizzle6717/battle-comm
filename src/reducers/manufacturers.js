'use strict';

import ManufacturerConstants from '../constants/ManufacturerConstants';

const manufacturer = (state = {}, action) => {
	switch (action.type) {
		case ManufacturerConstants.GET_MANUFACTURER:
			return Object.assign({}, state, action.data);
		case ManufacturerConstants.CREATE_MANUFACTURER:
			return Object.assign({}, state, action.data);
		case ManufacturerConstants.UPDATE_MANUFACTURER:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const manufacturers = (state = [], action) => {
	switch (action.type) {
		case ManufacturerConstants.GET_MANUFACTURERS:
			return [...action.data];
		case ManufacturerConstants.CREATE_MANUFACTURER:
			return [
				...state,
				manufacturer(undefined, action)
			];
		case ManufacturerConstants.REMOVE_MANUFACTURER:
			let manufacturerArray = [...state];
			let index = state.findIndex((manufacturer) => manufacturer.id === action.data);
			if (index !== -1) {
				manufacturerArray.splice(index, 1);
			}
			return manufacturerArray;
		default:
			return state;
	}
}

export {
	manufacturer,
	manufacturers
};
