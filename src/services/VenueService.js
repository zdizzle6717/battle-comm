'use strict';

import axios from 'axios';

export default {
	submitPointAssignment: (data) => {
		return axios.post('/venues/assignPoints', data)
			.then(function(response) {
				return response.data;
			});
	}
};
