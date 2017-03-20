'use strict';

import ProductConstants from '../constants/ProductConstants';

const product = (state = {}, action) => {
	switch (action.type) {
		case ProductConstants.GET_PRODUCT:
			return Object.assign({}, state, action.data);
		case ProductConstants.CREATE_PRODUCT:
			return Object.assign({}, state, action.data);
		case ProductConstants.UPDATE_PRODUCT:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const products = (state = [], action) => {
	switch (action.type) {
		case ProductConstants.GET_PRODUCTS:
			return [...action.data];
		case ProductConstants.CREATE_PRODUCT:
			return [
				...state,
				product(undefined, action)
			];
		case ProductConstants.REMOVE_PRODUCT:
			let productArray = [...state];
			let index = state.findIndex((product) => product.id === action.data);
			if (index !== -1) {
				productArray.splice(index, 1);
			}
			return productArray;
		default:
			return state;
	}
}

export {
	product,
	products
};
