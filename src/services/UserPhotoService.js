'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/userPhotos/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/userPhotos')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/userPhotos/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/userPhotos', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/userPhotos/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/userPhotos/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
