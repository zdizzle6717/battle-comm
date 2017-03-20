'use strict';

import UserPhotoConstants from '../constants/UserPhotoConstants';

const userPhoto = (state = {}, action) => {
	switch (action.type) {
		case UserPhotoConstants.GET_USER_PHOTO:
			return Object.assign({}, state, action.data);
		case UserPhotoConstants.CREATE_USER_PHOTO:
			return Object.assign({}, state, action.data);
		case UserPhotoConstants.UPDATE_USER_PHOTO:
			return Object.assign({}, state, action.data);
		default:
			return state;
	}
};

const userPhotos = (state = [], action) => {
	switch (action.type) {
		case UserPhotoConstants.GET_USER_PHOTOS:
			return [...action.data];
		case UserPhotoConstants.CREATE_USER_PHOTO:
			return [
				...state,
				userPhoto(undefined, action)
			];
		case UserPhotoConstants.REMOVE_USER_PHOTO:
			let userPhotoArray = [...state];
			let index = state.findIndex((userPhoto) => userPhoto.id === action.data);
			if (index !== -1) {
				userPhotoArray.splice(index, 1);
			}
			return userPhotoArray;
		default:
			return state;
	}
}

export {
	userPhoto,
	userPhotos
};
