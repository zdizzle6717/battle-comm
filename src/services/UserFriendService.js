'use strict';

import axios from 'axios';

export default {
	searchByUserId: (id) => {
		return axios.post('/search/friends/' + id)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/friends', data)
			.then(function(response) {
				return response.data;
			});
	},
	update: (id, data) => {
		return axios.put('/friends/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (UserId, InviteeId) => {
		return axios.delete('/friends/' + UserId + '/' + InviteeId)
			.then(function(response) {
				return response.data;
			});
	}
};
