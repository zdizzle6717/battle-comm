'use strict';

import thunkMiddleware from 'redux-thunk';
import {createLogger} from 'redux-logger';
import {applyMiddleware, compose, createStore} from 'redux';
import rootReducer from './reducers';

const loggerMiddleware = createLogger();
let store, storedUser, storedCart, cartQuantities, preLoadedState;
const composeEnhancers = typeof window === 'object' && window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__ ?
    window.__REDUX_DEVTOOLS_EXTENSION_COMPOSE__({
      // Specify extension’s options like name, actionsBlacklist, actionsCreators, serialize...
    }) : compose;

// Grab the state from a global variable injected into the server-generated HTML
function safelyParse(input) {
  var doc = new DOMParser().parseFromString(input, 'text/html');
  return JSON.parse(doc.documentElement.textContent);
}

// Get stored user details from session storage if they are already logged in
if(typeof(Storage) !== 'undefined' && typeof(window) !== 'undefined') {
	storedUser = JSON.parse(sessionStorage.getItem('user'));
	storedUser = storedUser ? storedUser : {};
	storedCart = JSON.parse(sessionStorage.getItem('cartItems'));
	storedCart = storedCart ? storedCart : [];
	cartQuantities = JSON.parse(sessionStorage.getItem('cartQuantities'));
	cartQuantities = cartQuantities ? cartQuantities : {};
	preLoadedState = Object.assign(safelyParse(window.__PRELOADED_STATE__), {'user': storedUser, 'isAuthenticated': !!storedUser.roleConfig, 'cartItems': storedCart, 'cartQtyPlaceholders': cartQuantities});
}

if (process.env.NODE_ENV === 'production') {
	// Create Store (Production)
	store = createStore(
		rootReducer,
		preLoadedState,
		applyMiddleware(
			thunkMiddleware
		)
	);
} else {
	// Create Store - Redux Development (Chrome Only)
	store = createStore(
		rootReducer,
		preLoadedState,
		composeEnhancers(applyMiddleware(
			thunkMiddleware, // let's us dispatch functions
			loggerMiddleware // middleware that logs actions (development only)
		))
	);
}

export default store;
