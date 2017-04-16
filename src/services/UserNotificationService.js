'use strict';

import axios from 'axios';

export default {
	getByUserId: (id) => {
		return axios.get('/userNotifications/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/userNotifications')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/search/userNotifications', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/userNotifications', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/userNotifications/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/userNotifications/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
