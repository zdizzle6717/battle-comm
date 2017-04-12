'use strict';

import axios from 'axios';

export default {
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
