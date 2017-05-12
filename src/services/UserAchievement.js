'use strict';

import axios from 'axios';

export default {
	search: (criteria) => {
		return axios.post('/search/userAchievements', criteria)
			.then(function(response) {
				return response.data;
			});
	},
	create: (data) => {
		return axios.post('/userAchievements', data)
			.then(function(response) {
				return response.data;
			});
	},
	remove: (UserId, AchievementIdentifier) => {
		return axios.delete('/userAchievements/' + UserId + '/' + AchievementIdentifier)
			.then(function(response) {
				return response.data;
			});
	}
};
