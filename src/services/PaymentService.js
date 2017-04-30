'use strict';

import axios from 'axios';

export default {
	purchaseRP: (id, data) => {
		return axios.post('/payments/purchaseRP/' + id, data)
			.then(function(response) {
				return response.data;
			});
	}
};
