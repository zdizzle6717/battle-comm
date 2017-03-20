'use strict';

import axios from 'axios';

export default {
	get: (id) => {
		return axios.get('/userMessages/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	getAll: () => {
		return axios.get('/userMessages')
			.then(function(response) {
				return response.data;
			});
	},
	search: (criteria) => {
		return axios.post('/userMessages/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/userMessages', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/userMessages/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/userMessages/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
