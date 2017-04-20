'use strict';
let axios = require('axios');

export default {
	activateAccount: (id) => {
		return axios.put('/users/' + id + '/activateAccount')
			.then((response) => {
				return response.data;
			});
	},
	blockUser: (id, data) => {
		return axios.put('/users/' + id + '/blockUser', data)
			.then((response) => {
				return response.data;
			});
	},
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
	},
	setNewPassword: (token, data) => {
		return axios.post('/users/setNewPassword/' + token, data)
			.then((response) => {
				return response.data;
			});
	},
	resetPassword: (data) => {
		return axios.post('/users/resetPassword/', data)
			.then((response) => {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.patch('/users/' + id, data)
			.then((response) => {
				return response.data;
			});
	},
	updateRole: (id, data) => {
		return axios.post('/users/' + id + '/updateRole', data)
			.then((response) => {
				return response.data;
			});
	}
};
