'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/bannerSlides/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/bannerSlides')
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/bannerSlides', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/bannerSlides/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/bannerSlides/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
