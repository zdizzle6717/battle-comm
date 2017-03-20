'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/gameSystemRankings/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/gameSystemRankings')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/gameSystemRankings/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/gameSystemRankings', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/gameSystemRankings/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/gameSystemRankings/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
