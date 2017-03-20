'use strict';

import NewsPostConstants from '../constants/NewsPostConstants';

const newsPost = (state = {}, action) => {
	switch (action.type) {
		case NewsPostConstants.GET_NEWS_POST:
			return Object.assign({}, state, action.data);
		case NewsPostConstants.CREATE_NEWS_POST:
			return Object.assign({}, state, action.data);
		case NewsPostConstants.UPDATE_NEWS_POST:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const newsPosts = (state = [], action) => {
	switch (action.type) {
		case NewsPostConstants.GET_NEWS_POSTS:
			return [...action.data];
		case NewsPostConstants.CREATE_NEWS_POST:
			return [
				...state,
				newsPost(undefined, action)
			];
		case NewsPostConstants.REMOVE_NEWS_POST:
			let newsPostArray = [...state];
			let index = state.findIndex((newsPost) => newsPost.id === action.data);
			if (index !== -1) {
				newsPostArray.splice(index, 1);
			}
			return newsPostArray;
		default:
			return state;
	}
}

export {
	newsPost,
	newsPosts
};
