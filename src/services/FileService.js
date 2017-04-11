'use strict';
let axios = require('axios');

export default {
	create: (data) => {
		return axios.post('/files', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/files/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/files/' + id)
			.then((response) => {
				return response.data;
			});
	}
};
