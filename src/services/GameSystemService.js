'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/gameSystems/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/gameSystems')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/gameSystems/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/gameSystems', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/gameSystems/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/gameSystems/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
