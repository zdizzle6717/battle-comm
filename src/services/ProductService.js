'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/products/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/products')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/products/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/products', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/products/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/products/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
