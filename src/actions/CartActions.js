'use strict';

import CartItemConstants from '../constants/CartItemConstants';

export default {
	updateTotal: () => {
		return (dispatch) => {
			dispatch({
				'type': CartItemConstants.UPDATE_CART_TOTAL
			});
		};
	},
	create: (cartItem) => {
		return (dispatch) => {
			dispatch({
				'type': CartItemConstants.CREATE_CART_ITEM,
				'data': cartItem
			});
		}
	},
	update: (cartItem) => {
		return (dispatch) => {
			dispatch({
				'type': CartItemConstants.UPDATE_CART_ITEM,
				'data': cartItem
			});
		}
	},
	remove: (itemId) => {
		return (dispatch) => {
			dispatch({
				'type': CartItemConstants.REMOVE_CART_ITEM,
				'data': itemId
			});
		}
	}
};
