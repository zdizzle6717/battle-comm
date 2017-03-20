'use strict';

import ProductOrderConstants from '../constants/ProductOrderConstants';
import ProductOrderService from '../services/ProductOrderService';

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
			dispatch(_initiateRequest(ProductOrderConstants.INITIATE_PRODUCT_ORDER_REQUEST, id));
			return ProductOrderService.get(id).then((productOrder) => {
				dispatch(_returnResponse(ProductOrderConstants.GET_PRODUCT_ORDER, productOrder));
				return productOrder;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductOrderConstants.INITIATE_PRODUCT_ORDER_REQUEST));
			return ProductOrderService.getAll().then((productOrders) => {
				dispatch(_returnResponse(ProductOrderConstants.GET_PRODUCT_ORDERS, productOrders));
				return productOrders;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductOrderConstants.INITIATE_PRODUCT_ORDER_REQUEST));
			return ProductOrderService.create(data).then((productOrder) => {
				dispatch(_returnResponse(ProductOrderConstants.CREATE_PRODUCT_ORDER, productOrder));
				return productOrder;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductOrderConstants.INITIATE_PRODUCT_ORDER_REQUEST));
			return ProductOrderService.update(id, data).then((productOrder) => {
				dispatch(_returnResponse(ProductOrderConstants.UPDATE_PRODUCT_ORDER, productOrder));
				return productOrder;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductOrderConstants.INITIATE_PRODUCT_ORDER_REQUEST, id));
			return ProductOrderService.remove(id).then((response) => {
				dispatch(_returnResponse(ProductOrderConstants.REMOVE_PRODUCT_ORDER, id));
				return response;
			});
		};
	}
};
