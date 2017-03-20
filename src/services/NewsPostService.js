'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/newsPosts/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/newsPosts')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/newsPosts/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/newsPosts', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/newsPosts/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/newsPosts/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
