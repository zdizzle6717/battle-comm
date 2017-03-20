'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/factions/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/factions')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/factions/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/factions', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/factions/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/factions/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
