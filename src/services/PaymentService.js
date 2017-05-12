'use strict';

import axios from 'axios';

export default {
	createSubscription: (data) => {
		return axios.post('/payments/subscriptions', data)
			.then(function(response) {
				return response.data;
			});
	},
	getSubscriptionPlans: () => {
		return axios.get('/payments/subscriptions')
			.then(function(response) {
				return response.data;
			});
	},
	payShippingCost: (id, data) => {
		return axios.post('/payments/payShippingCost/' + id, data)
			.then(function(response) {
				return response.data;
			});
	},
	purchaseRP: (id, data) => {
		return axios.post('/payments/purchaseRP/' + id, data)
			.then(function(response) {
				return response.data;
			});
	}
};
