'use strict';

import axios from 'axios';

export default {
	searchByFaction: (factionId, criteria) => {
		return axios.post('search/factionRankings/' + factionId, criteria)
			.then(function(response) {
				return response.data;
			});
	},
	searchByGameSystem: (gameSystemId, criteria) => {
		return axios.post('search/gameSystemRankings/' + gameSystemId, criteria)
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
