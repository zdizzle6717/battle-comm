'use strict';
let axios = require('axios');

export default {
	getByUsername: (username) => {
		return axios.get('/users/username/' + username)
			.then(function(response) {
				return response.data;
			});
	}
};
