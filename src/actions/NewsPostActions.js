'use strict';

import NewsPostConstants from '../constants/NewsPostConstants';
import NewsPostService from '../services/NewsPostService';

const _initiateRequest = (type, data) => {
	return {
		'type': type,
		'data': data
	};
};
const _returnResponse = (type, data) => {
	return {
		'type': type,
		'data': data,
		'receivedAt': Date.now()
	};
};

export default {
	get: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(NewsPostConstants.INITIATE_NEWS_POST_REQUEST, id));
			return NewsPostService.get(id).then((newsPost) => {
				dispatch(_returnResponse(NewsPostConstants.GET_NEWS_POST, newsPost));
				return newsPost;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(NewsPostConstants.INITIATE_NEWS_POST_REQUEST));
			return NewsPostService.getAll().then((newsPosts) => {
				dispatch(_returnResponse(NewsPostConstants.GET_NEWS_POSTS, newsPosts));
				return newsPosts;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(NewsPostConstants.INITIATE_NEWS_POST_REQUEST));
			return NewsPostService.search(criteria).then((response) => {
				dispatch(_returnResponse(NewsPostConstants.GET_NEWS_POSTS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(NewsPostConstants.INITIATE_NEWS_POST_REQUEST));
			return NewsPostService.create(data).then((newsPost) => {
				dispatch(_returnResponse(NewsPostConstants.CREATE_NEWS_POST, newsPost));
				return newsPost;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(NewsPostConstants.INITIATE_NEWS_POST_REQUEST));
			return NewsPostService.update(id, data).then((newsPost) => {
				dispatch(_returnResponse(NewsPostConstants.UPDATE_NEWS_POST, newsPost));
				return newsPost;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(NewsPostConstants.INITIATE_NEWS_POST_REQUEST, id));
			return NewsPostService.remove(id).then((response) => {
				dispatch(_returnResponse(NewsPostConstants.REMOVE_NEWS_POST, id));
				return response;
			});
		};
	}
};
