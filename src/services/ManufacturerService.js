'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/manufacturers/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/manufacturers')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/manufacturers/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/manufacturers', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/manufacturers/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/manufacturers/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
