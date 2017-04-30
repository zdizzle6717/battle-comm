'use strict';

import axios from 'axios';

export default {
	oneTimeCharge: (data) => {
		return axios.post('/payments/oneTimeCharge', data)
			.then(function(response) {
				return response.data;
			});
	}
};
