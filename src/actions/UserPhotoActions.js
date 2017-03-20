'use strict';

import UserPhotoConstants from '../constants/UserPhotoConstants';
import UserPhotoService from '../services/UserPhotoService';

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
			dispatch(_initiateRequest(UserPhotoConstants.INITIATE_USER_PHOTO_REQUEST, id));
			return UserPhotoService.get(id).then((userPhoto) => {
				dispatch(_returnResponse(UserPhotoConstants.GET_USER_PHOTO, userPhoto));
				return userPhoto;
			});
		};
	},
	getAll: () => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserPhotoConstants.INITIATE_USER_PHOTO_REQUEST));
			return UserPhotoService.getAll().then((userPhotos) => {
				dispatch(_returnResponse(UserPhotoConstants.GET_USER_PHOTOS, userPhotos));
				return userPhotos;
			});
		};
	},
	search: (criteria) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserPhotoConstants.INITIATE_USER_PHOTO_REQUEST));
			return UserPhotoService.search(criteria).then((response) => {
				dispatch(_returnResponse(UserPhotoConstants.GET_USER_PHOTOS, response.results));
				return response.pagination;
			});
		};
	},
	create: (data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserPhotoConstants.INITIATE_USER_PHOTO_REQUEST));
			return UserPhotoService.create(data).then((userPhoto) => {
				dispatch(_returnResponse(UserPhotoConstants.CREATE_USER_PHOTO, userPhoto));
				return userPhoto;
			});
		};
	},
	update: (id, data) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserPhotoConstants.INITIATE_USER_PHOTO_REQUEST));
			return UserPhotoService.update(id, data).then((userPhoto) => {
				dispatch(_returnResponse(UserPhotoConstants.UPDATE_USER_PHOTO, userPhoto));
				return userPhoto;
			});
		};
	},
	remove: (id) => {
		return (dispatch) => {
			dispatch(_initiateRequest(UserPhotoConstants.INITIATE_USER_PHOTO_REQUEST, id));
			return UserPhotoService.remove(id).then((response) => {
				dispatch(_returnResponse(UserPhotoConstants.REMOVE_USER_PHOTO, id));
				return response;
			});
		};
	}
};
