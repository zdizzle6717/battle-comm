'use strict';

import ProductOrderConstants from '../constants/ProductOrderConstants';

const productOrder = (state = {}, action) => {
	switch (action.type) {
		case ProductOrderConstants.GET_PRODUCT_ORDER:
			return Object.assign({}, state, action.data);
		case ProductOrderConstants.CREATE_PRODUCT_ORDER:
			return Object.assign({}, state, action.data);
		case ProductOrderConstants.UPDATE_PRODUCT_ORDER:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const productOrders = (state = [], action) => {
	switch (action.type) {
		case ProductOrderConstants.GET_PRODUCT_ORDERS:
			return [...action.data];
		case ProductOrderConstants.CREATE_PRODUCT_ORDER:
			return [
				...state,
				productOrder(undefined, action)
			];
		case ProductOrderConstants.REMOVE_PRODUCT_ORDER:
			let productOrderArray = [...state];
			let index = state.findIndex((productOrder) => productOrder.id === action.data);
			if (index !== -1) {
				productOrderArray.splice(index, 1);
			}
			return productOrderArray;
		default:
			return state;
	}
};

export {
	productOrder,
	productOrders
};
