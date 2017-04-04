'use strict';

import BannerSlideConstants from '../constants/BannerSlideConstants';
import BannerSlideService from '../services/BannerSlideService';

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
			dispatch(_initiateRequest(BannerSlideConstants.INITIATE_BANNER_SLIDE_REQUEST, id));
			return BannerSlideService.get(id).then((bannerSlide) => {
				dispatch(_returnResponse(BannerSlideConstants.GET_BANNER_SLIDE, bannerSlide));
				return bannerSlide;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(BannerSlideConstants.INITIATE_BANNER_SLIDE_REQUEST));
			return BannerSlideService.getAll().then((bannerSlides) => {
				dispatch(_returnResponse(BannerSlideConstants.GET_BANNER_SLIDES, bannerSlides));
				return bannerSlides;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(BannerSlideConstants.INITIATE_BANNER_SLIDE_REQUEST));
			return BannerSlideService.create(data).then((bannerSlide) => {
				dispatch(_returnResponse(BannerSlideConstants.CREATE_BANNER_SLIDE, bannerSlide));
				return bannerSlide;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(BannerSlideConstants.INITIATE_BANNER_SLIDE_REQUEST));
			return BannerSlideService.update(id, data).then((bannerSlide) => {
				dispatch(_returnResponse(BannerSlideConstants.UPDATE_BANNER_SLIDE, bannerSlide));
				return bannerSlide;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(BannerSlideConstants.INITIATE_BANNER_SLIDE_REQUEST, id));
			return BannerSlideService.remove(id).then((response) => {
				dispatch(_returnResponse(BannerSlideConstants.REMOVE_BANNER_SLIDE, id));
				return response;
			});
		};
	}
};
