'use strict';

import axios from 'axios';

export default {
	search: (criteria) => {
		return axios.post('/gameSystemRankings/search', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	createOrUpdate: (data) => {
		return axios.post('/gameSystemRankings', data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (id) => {
		return axios.delete('/gameSystemRankings/' + id)
			.then(function(response) {
				return response.data;
			});
	}
};
