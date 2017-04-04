'use strict';
let axios = require('axios');

export default {
	getById: (id) => {
		return axios.get('/users/' + id)
			.then((response) => {
				return response.data;
			});
	},
	getByUsername: (username) => {
		return axios.get('/users/username/' + username)
			.then((response) => {
				return response.data;
			});
	}
};
