'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/productOrders/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/productOrders')
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/productOrders', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/productOrders/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/productOrders/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
