'use strict';

import ProductConstants from '../constants/ProductConstants';
import ProductService from '../services/ProductService';

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
			dispatch(_initiateRequest(ProductConstants.INITIATE_PRODUCT_REQUEST, id));
			return ProductService.get(id).then((product) => {
				dispatch(_returnResponse(ProductConstants.GET_PRODUCT, product));
				return product;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductConstants.INITIATE_PRODUCT_REQUEST));
			return ProductService.getAll().then((products) => {
				dispatch(_returnResponse(ProductConstants.GET_PRODUCTS, products));
				return products;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductConstants.INITIATE_PRODUCT_REQUEST));
			return ProductService.search(criteria).then((response) => {
				dispatch(_returnResponse(ProductConstants.GET_PRODUCTS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductConstants.INITIATE_PRODUCT_REQUEST));
			return ProductService.create(data).then((product) => {
				dispatch(_returnResponse(ProductConstants.CREATE_PRODUCT, product));
				return product;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductConstants.INITIATE_PRODUCT_REQUEST));
			return ProductService.update(id, data).then((product) => {
				dispatch(_returnResponse(ProductConstants.UPDATE_PRODUCT, product));
				return product;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(ProductConstants.INITIATE_PRODUCT_REQUEST, id));
			return ProductService.remove(id).then((response) => {
				dispatch(_returnResponse(ProductConstants.REMOVE_PRODUCT, id));
				return response;
			});
		};
	}
};
