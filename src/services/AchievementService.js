'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/achievements/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/achievements')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/search/achievements', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/achievements', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/achievements/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/achievements/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
