'use strict';

import axios from 'axios';

export default {
	create: (data) => {
		return axios.post('/userFriends', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/userFriends/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (data) => {
		return axios.delete('/userFriends/' + data)
			.then(function(response) {
				return response.data;
			});
	}
};
