'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/userAchievements/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/userAchievements')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/userAchievements/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/userAchievements', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/userAchievements/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/userAchievements/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
