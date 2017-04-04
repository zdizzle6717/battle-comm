'use strict';

import BannerSlideConstants from '../constants/BannerSlideConstants';

const bannerSlide = (state = {}, action) => {
	switch (action.type) {
		case BannerSlideConstants.GET_BANNER_SLIDE:
			return Object.assign({}, state, action.data);
		case BannerSlideConstants.CREATE_BANNER_SLIDE:
			return Object.assign({}, state, action.data);
		case BannerSlideConstants.UPDATE_BANNER_SLIDE:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const bannerSlides = (state = [], action) => {
	switch (action.type) {
		case BannerSlideConstants.GET_BANNER_SLIDES:
			return [...action.data];
		case BannerSlideConstants.CREATE_BANNER_SLIDE:
			return [
				...state,
				bannerSlide(undefined, action)
			];
		case BannerSlideConstants.REMOVE_BANNER_SLIDE:
			let bannerSlideArray = [...state];
			let index = state.findIndex((bannerSlide) => bannerSlide.id === action.data);
			if (index !== -1) {
				bannerSlideArray.splice(index, 1);
			}
			return bannerSlideArray;
		default:
			return state;
	}
}

export {
	bannerSlide,
	bannerSlides
};
