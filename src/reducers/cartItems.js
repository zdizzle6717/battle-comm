'use strict';

import CartItemConstants from '../constants/CartItemConstants';

const calculateTotal = (cartItems) => {
	let subTotal = 0;
	cartItems.forEach((item) => {
		subTotal += parseInt(item.cartQty, 10) * parseInt(item.product.price, 10);
	});
	return subTotal;
};

const updateSessionCart = (newCartItems) => {
	sessionStorage.setItem('cartItems', JSON.stringify(newCartItems));
};

const cartItems = (state = [], action) => {
	let cartItems, newItem, index;
	switch (action.type) {
		case CartItemConstants.ADD_CART_ITEM:
			cartItems = [...state];
			newItem = action.data;
			index = state.findIndex((item) => item.product.id === action.data.product.id);
			if (index < 0) {
				cartItems.push(newItem);
			} else {
				cartItems[index].product = action.data.product;
				cartItems[index].cartQty += action.data.cartQty;
			}
			updateSessionCart(cartItems);
			return cartItems;
		case CartItemConstants.REMOVE_CART_ITEM:
			cartItems = [...state];
			index = state.findIndex((cartItem) => cartItem.product.id === action.data.id);
			if (index !== -1) {
				cartItems[index].cartQty -= action.data.cartQty;
			}
			if (cartItems[index].cartQty < 1) {
				cartItems.splice(index, 1);
			}
			updateSessionCart(cartItems);
			return cartItems;
		default:
			return state;
	}
};

const cartTotal = (state = 0, action) => {
	switch (action.type) {
		case CartItemConstants.UPDATE_CART_TOTAL:
			let newSubTotal = calculateTotal(action.data);
			return newSubTotal;
		default:
			return state;
	}
};

export {
	cartItems,
	cartTotal
};
