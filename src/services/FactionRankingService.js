'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/factionRankings/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/factionRankings')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/factionRankings/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/factionRankings', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/factionRankings/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/factionRankings/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
